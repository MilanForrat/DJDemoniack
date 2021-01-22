<?php

namespace App\Controller\Admin;

use App\Entity\Genre;
use App\Entity\Song;
use App\Entity\Admin;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\CrudUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminDashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
         // redirect to some CRUD controller
         $routeBuilder = $this->get(CrudUrlGenerator::class)->build();

        return $this->redirect($routeBuilder->setController(SongCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('DJDemoniackMusic Database');
    }

    public function configureMenuItems(): iterable
    {
        return[
        
            MenuItem::linktoDashboard('Accueil', 'fa fa-home'),

            MenuItem::linkToCrud('Songs / Mixes', 'fas fa-music', Song::class),
            MenuItem::linkToCrud('Genre', 'fas fa-tag', Genre::class),
            MenuItem::linkToCrud('Admin', 'fas fa-user', Admin::class),
        ];
    }
}
