<?php

namespace App\Controller;

use App\Entity\PerfilUsuario;
use App\Form\PerfilUsuarioType;
use App\Repository\PerfilUsuarioRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/perfil/usuario")
 */
class PerfilUsuarioController extends AbstractController
{
    /**
     * @Route("/", name="app_perfil_usuario_index", methods={"GET"})
     */
    public function index(PerfilUsuarioRepository $perfilUsuarioRepository): Response
    {
        return $this->render('perfil_usuario/index.html.twig', [
            'perfil_usuarios' => $perfilUsuarioRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_perfil_usuario_new", methods={"GET", "POST"})
     */
    public function new(Request $request, PerfilUsuarioRepository $perfilUsuarioRepository): Response
    {
        $perfilUsuario = new PerfilUsuario();
        $form = $this->createForm(PerfilUsuarioType::class, $perfilUsuario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $perfilUsuarioRepository->add($perfilUsuario, true);

            return $this->redirectToRoute('app_perfil_usuario_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('perfil_usuario/new.html.twig', [
            'perfil_usuario' => $perfilUsuario,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_perfil_usuario_show", methods={"GET"})
     */
    public function show(PerfilUsuario $perfilUsuario): Response
    {
        return $this->render('perfil_usuario/show.html.twig', [
            'perfil_usuario' => $perfilUsuario,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_perfil_usuario_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, PerfilUsuario $perfilUsuario, PerfilUsuarioRepository $perfilUsuarioRepository): Response
    {
        $form = $this->createForm(PerfilUsuarioType::class, $perfilUsuario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $perfilUsuarioRepository->add($perfilUsuario, true);

            return $this->redirectToRoute('app_perfil_usuario_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('perfil_usuario/edit.html.twig', [
            'perfil_usuario' => $perfilUsuario,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_perfil_usuario_delete", methods={"POST"})
     */
    public function delete(Request $request, PerfilUsuario $perfilUsuario, PerfilUsuarioRepository $perfilUsuarioRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$perfilUsuario->getId(), $request->request->get('_token'))) {
            $perfilUsuarioRepository->remove($perfilUsuario, true);
        }

        return $this->redirectToRoute('app_perfil_usuario_index', [], Response::HTTP_SEE_OTHER);
    }
}
