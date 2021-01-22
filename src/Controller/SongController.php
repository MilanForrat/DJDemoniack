<?php

namespace App\Controller;

use App\Form\SearchMixType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\SongRepository;
use Symfony\Component\HttpFoundation\Request;

class SongController extends AbstractController
{
    /**
     * @Route("/mixes/{id}", name="mix_page", requirements={"id"="\d+"}))
     */
    public function mixById($id, SongRepository $song_repository, Request $request)
    {

        $results = [];

        $searchMixForm = $this->createForm(SearchMixType::class);
    
            if($searchMixForm->handleRequest($request)->isSubmitted() && $searchMixForm->isValid()) {
                $title = $searchMixForm->getData();
                $results = $song_repository->searchMix($title);
            }

        $songById = $song_repository->viewById($id);
        return $this->render('song/mix.html.twig', [
            "songById" => $songById,
            "results" => $results,
        ]);
    }
}
