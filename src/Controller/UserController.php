<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\PerfilUsuario;
use App\Form\UserType;
use App\Repository\HistoricoClasesRepository;
use App\Repository\PerfilUsuarioRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Knp\Component\Pager\PaginatorInterface;



/**
 * @Route("/user")
 */
class UserController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    /**
     * @Route("/", name="app_user_index", methods={"GET"})
     */
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_user_new", methods={"GET", "POST"})
     */
    public function new(Request $request, UserRepository $userRepository): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->add($user, true);

            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}/view", name="app_user_edit", methods={"GET"})
     */
    public function show(User $user, HistoricoClasesRepository $HistoricoClasesRepository, PerfilUsuarioRepository $perfilUsuarioRepository, UserRepository $userRepository): Response
    {
        $hoy = new \DateTime();

        $userId = $user->getId();
        $perfil = $user->getPerfil();

        if($perfil == null)
        {
            $perfil = new PerfilUsuario();

            $perfilUsuarioRepository->add($perfil, true);
            
            $user->setPerfil($perfil);
            $userRepository->add($user, true);
        }

        $historicoClases = $HistoricoClasesRepository->createQueryBuilder('hc')
        ->where('hc.usuario = :userId')
        ->setParameter('userId', $userId)
        ->orderBy('hc.fecha_Actividad', 'DESC')
        ->getQuery()
        ->getResult();

        return $this->render('user/show.html.twig', [
            'user' => $user,
            'historicoclases' => $historicoClases,
            'hoy' => $hoy,
        ]);
    }

    /**
     * @Route("/{id}", name="app_user_show", methods={"GET", "POST"})
     */
    public function edit(Request $request, User $user, UserRepository $userRepository, PerfilUsuarioRepository $perfilUsuarioRepository, HistoricoClasesRepository $HistoricoClasesRepository, PaginatorInterface $paginator): Response
    {
        $hoy = new \DateTime();

        $userId = $user->getId();
        $perfil = $user->getPerfil();

        if($perfil == null)
        {
            $perfil = new PerfilUsuario();

            $perfilUsuarioRepository->add($perfil, true);
            
            $user->setPerfil($perfil);
            $userRepository->add($user, true);
        }


        $pagination = $paginator->paginate(
            $HistoricoClasesRepository->findOneById($userId), /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            5 /*limit per page*/
        );


        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->add($user, true);

            // return $this->redirectToRoute('app_user_show', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
            'historicoclases' => $pagination,
            'hoy' => $hoy,
        ]);
    }

    /**
     * @Route("/{id}", name="app_user_delete", methods={"POST"})
     */
    public function delete(Request $request, User $user, UserRepository $userRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $userRepository->remove($user, true);
        }

        return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
    }
}
