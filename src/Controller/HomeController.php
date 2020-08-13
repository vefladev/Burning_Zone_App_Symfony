<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        return $this->render('home/index.html.twig', [
            // 'controller_name' => 'HomeController',
        ]);
    }

       /**
     * @Route("/admin/index", name="home_admin_index")
     * @IsGranted("ROLE_USER")
     */
    public function adminIndex()
    {

        if($this->isGranted('ROLE_ADMIN')){
            return $this->redirectToRoute('home_admin');
        }else if($this->isGranted('ROLE_COACH')){
            return $this->redirectToRoute('home_coach');
        }else if($this->isGranted('ROLE_USER')){
            return $this->redirectToRoute('home_adherent');

        }
    }

     /**
     * @Route("/admin", name="home_admin")
     * @IsGranted("ROLE_ADMIN")
     */
    public function admin(UserRepository $repo)
    {
        return $this->render('home/admin.html.twig', [
            'users' => $repo->findAll()

        ]);
    }

     /**
     * @Route("/admin/coach", name="home_coach")
     * @IsGranted("ROLE_COACH")
     */
    public function coach()
    {
        return $this->render('home/coach.html.twig', [
           
        ]);
    }


    /**
     * @Route("/admin/adherent", name="home_adherent")
     * @IsGranted("ROLE_USER")
     */
    public function adherent()
    {
        return $this->render('home/adherent.html.twig', [
           
        ]);
    }




}
