<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\UserSearch;
use App\Form\UserSearchType;
use App\Form\UserType;
use App\Repository\UserRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin/user")
 *@IsGranted("ROLE_ADMIN")
 */
class UserController extends AbstractController
{
     /**
     * @Route("/showuser", name="admin_showUser") 
     * @IsGranted("ROLE_ADMIN")
     */
    public function showUser(UserRepository $repo, Request $request, PaginatorInterface $paginator)
    {

        $search = new UserSearch();
        $form = $this->createForm(UserSearchType::class, $search);
        $form->handleRequest($request);

        $users=$repo->findBy(array(), array('nom' => 'ASC')); 
        $users = $paginator->paginate(
            
            $users, // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            8 // Nombre de résultats par page
        );
        
        return $this->render('user/showuser.html.twig', [
            'users' => $users,
            'pagination' => $paginator,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/{id}", name="user_show", methods={"GET"})
     */
    public function show(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
        
    }

    /**
     * @Route("/{id}/edit", name="user_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, User $user): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->addFlash(
                'success',
                'Lutilisateur a bien été modifié(e)'
            );
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_showUser');
        }

        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_delete", methods={"DELETE"})
     */
    public function delete(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $this->addFlash(
                'success',
                'Lutilisateur a bien été supprimé(e)'
            );
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_showUser');
    }



}
