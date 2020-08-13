<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;



/**
 * @Route("/presentation")
 */

class PresentationController extends AbstractController {
    /**
     * @Route("/", name="presentation")
     */
    public function index() {
        return $this->render('presentation/index.html.twig', [
            'controller_name' => 'PresentationController',
        ]);
    }
    /**
     * @Route("/coach", name="presentation_coach")
     */
    public function coach() {
        return $this->render('presentation/coach.html.twig', [
            'controller_name' => 'PresentationController',
        ]);
    }
    /**
     * @Route("/", name="presentation_cours")
     */
    public function cours() {
        return $this->render('presentation/index.html.twig', [
            'controller_name' => 'PresentationController',
        ]);
    }
     /**
     * @Route("/", name="presentation_salles")
     */
    public function salles() {
        return $this->render('presentation/index.html.twig', [
            'controller_name' => 'PresentationController',
        ]);
    }


}
