<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Categorie;
use App\Entity\Question;
use App\Entity\Reponse;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController 
{
    public function __construct(
        private AdminUrlGenerator $adminUrlGenerator
    )
    {
        
    }
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {

        if ($this->container->get('security.authorization_checker')->isGranted('ROLE_ADMIN') == true) {

        $url = $this->adminUrlGenerator
                ->setController(UserCrudController::class)
                ->generateUrl();
                
        return $this->redirect($url);
        }else{
            return $this->redirectToRoute('app_main');
        }
        // return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Easy Admin');
    }

    public function configureMenuItems(): iterable
    {

        yield MenuItem::linktoRoute('My_Quiz', 'fa fa-home' , 'app_main');
        yield MenuItem::subMenu('user', 'fas fa-bars')->setSubItems([
             MenuItem::linkToCrud('Create User', 'fas fa-plus', User::class)->setAction(Crud::PAGE_NEW),
             MenuItem::linkToCrud('Show User', 'fas fa-eye', User::class)
        ]);
        yield MenuItem::subMenu('categorie', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Create Categorie', 'fas fa-plus', Categorie::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Show Categorie', 'fas fa-eye', Categorie::class)
       ]);
        yield MenuItem::subMenu('question', 'fas fa-bars')->setSubItems([
        MenuItem::linkToCrud('Create Question', 'fas fa-plus', Question::class)->setAction(Crud::PAGE_NEW),
        MenuItem::linkToCrud('Show Question', 'fas fa-eye', Question::class)
   ]);
        yield MenuItem::subMenu('reponse', 'fas fa-bars')->setSubItems([
        MenuItem::linkToCrud('Create Reponse', 'fas fa-plus', Reponse::class)->setAction(Crud::PAGE_NEW),
        MenuItem::linkToCrud('Show Reponse', 'fas fa-eye', Reponse::class)
    ]);

    }
}
