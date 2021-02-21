<?php

namespace App\Controller\Admin;

use App\Entity\Ubigeo;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return $this->render('dashboard/dashboard.html.twig');
    }

    /**
     * @return Dashboard
     */
    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Dtodoaqui Dashboard');
    }

    /**
     * @return iterable
     */
    public function configureMenuItems(): iterable
    {
        return [
            //MenuItem::linkToDashboard('Dashboard', 'fa fa-home'),
            MenuItem::section('Usuarios'),
            MenuItem::linkToCrud('Users', 'fa fa-tags', User::class),
            MenuItem::section('Ubigeo'),
            MenuItem::linkToCrud('Ubigeo', 'fa fa-tags', Ubigeo::class),

        ];
    }
}
