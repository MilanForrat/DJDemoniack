<?php

namespace App\Controller;

use App\Form\FilterMixType;
use App\Form\SearchMixType;
use App\Repository\GenreRepository;
use App\Repository\SongRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/navBar", name="navBar")
    */
    public function navBar(SongRepository $song_repository, Request $request): Response
    {
    
        $results = [];

        $searchMixForm = $this->createForm(SearchMixType::class);

        if($searchMixForm->handleRequest($request)->isSubmitted() && $searchMixForm->isValid()) {
            $title = $searchMixForm->getData();

            $results = $song_repository->searchMix($title);

            if ($results == null) {
                $this->addFlash('erreur', 'Aucun mix contenant ce mot clé dans le titre n\'a été trouvé, essayez en un autre.');
                }
        } 

        return $this->render('default/_nav.html.twig', [
            "search_form" => $searchMixForm->createView(),
            "results" => $results,
        ]);
    }

    /**
     * @Route("/filter", name="filter")
    */
    public function filter(GenreRepository $genre_repository, SongRepository $song_repository, Request $request): Response
    {

  
    
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

        return $this->render('default/_filter.html.twig', [
            "genre" => $genre,
            "filter_form" => $filterMixForm->createView(),
            "resultsFilter" => $resultsFilter,
        ]);
    }
}