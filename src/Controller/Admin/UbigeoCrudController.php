<?php

namespace App\Controller\Admin;

use App\Entity\Ubigeo;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\RedirectResponse;

class UbigeoCrudController extends AbstractCrudController
{
    /**
     * @return string
     */
    public static function getEntityFqcn(): string
    {
        return Ubigeo::class;
    }


    /**
     * @return RedirectResponse
     */
    public function someMethod()
    {

        $adminUrlGenerator = $this->get(AdminUrlGenerator::class);
        $url = $adminUrlGenerator->unsetAll()->set('foo', 'someValue')->generateUrl();

        return  new RedirectResponse($url);

    }
}
