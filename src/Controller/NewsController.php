<?php

namespace App\Controller;

use App\Entity\Post;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/news")
 */

class NewsController extends AbstractController
{
    /**
     * @Route("/", name="news")
     */
    public function index(PostRepository $repo)
    {
        $posts=$repo->findAll();
        return $this->render('news/index.html.twig', [
            'posts' => $posts,
        ]);
    }

    // /**
    //  * @Route("/shownews", name="news_show", methods={"GET"})
    //  */
    // public function show(PostRepository $postrepo)
    // {
    //     $posts=$postrepo->findAll();
    //     return $this->render('news/index.html.twig', [
    //         'posts' => $posts,
    //     ]);
    // }

    
}
