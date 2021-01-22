<?php

namespace App\Controller;

use App\Form\FilterMixType;
use App\Repository\SongRepository;
use App\Repository\GenreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\SearchMixType;
use Symfony\Component\Validator\Constraints\IsbnValidator;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function homepage(SongRepository $song_repository, Request $request, GenreRepository $genre_repository): Response
    {
        $results = [];
        $searchMixForm = $this->createForm(SearchMixType::class);
            if($searchMixForm->handleRequest($request)->isSubmitted() && $searchMixForm->isValid()) {
                $title = $searchMixForm->getData();
                $results = $song_repository->searchMix($title);

            }
    
        $resultsFilter = [];
        $genre = $genre_repository->findAll();

        $filterMixForm = $this->createForm(FilterMixType::class);
            if($filterMixForm->handleRequest($request)->isSubmitted() && $filterMixForm->isValid()){
                $searchDuration = $filterMixForm->getData();
                if($searchDuration == true){
                    $resultsFilter = $song_repository->findAllByLongDuration();
                }
                else{
                    $resultsFilter = $song_repository->findAllByShortDuration();
                }
            }

            dump($resultsFilter);
    
            $song = $song_repository->findAll();
        
        return $this->render('home/homepage.html.twig', [
            "song" => $song,
            "results" => $results,
            "genre" => $genre,
            "resultsFilter" => $resultsFilter,
        ]);
    }
}
