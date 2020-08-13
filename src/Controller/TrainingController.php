<?php

namespace App\Controller;

use App\Entity\Training;
use App\Form\TrainingType;
use App\Repository\TrainingRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


/**
 * @Route("/admin/coach")
 */
class TrainingController extends AbstractController
{
    /**
     * @Route("/training", name="training_index", methods={"GET"})
     */
    public function index(TrainingRepository $trainingRepository, PaginatorInterface $paginator, Request $request): Response
    {


        // $trainings=$trainingRepository->findBy(array(), array('startedAt' => 'ASC')); 
        // $trainings = $paginator->paginate(
            
        //     $trainings, // Requête contenant les données à paginer (ici nos articles)
        //     $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
        //     1 // Nombre de résultats par page
        // );
        return $this->render('training/index.html.twig', [
            'trainings' => $trainingRepository->findAll()
            // 'pagination' => $paginator,
        ]);
    }

    
    /**
     * @Route("/calendar", name="training_calendar", methods={"GET"})
     */
    public function calendar(): Response
    {
        return $this->render('training/calendar.html.twig');
    }


    /**
     * @Route("/new", name="training_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $training = new Training();
        $form = $this->createForm(TrainingType::class, $training);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($training);
            $entityManager->flush();

            return $this->redirectToRoute('training_index');
        }

        return $this->render('training/new.html.twig', [
            'training' => $training,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("training/{id}", name="training_show", methods={"GET"})
     */
    public function show(Training $training): Response
    {
        return $this->render('training/show.html.twig', [
            'training' => $training,
        ]);
    }

    /**
     * @Route("training/{id}/edit", name="training_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Training $training): Response
    {
        $form = $this->createForm(TrainingType::class, $training);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('training_index');
        }

        return $this->render('training/edit.html.twig', [
            'training' => $training,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("training/{id}", name="training_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Training $training): Response
    {
        if ($this->isCsrfTokenValid('delete'.$training->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($training);
            $entityManager->flush();
        }

        return $this->redirectToRoute('training_index');
    }
}
