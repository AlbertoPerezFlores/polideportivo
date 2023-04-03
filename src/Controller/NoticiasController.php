<?php

namespace App\Controller;

use App\Entity\Noticias;
use App\Form\NoticiasType;
use App\Repository\NoticiasRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/noticias")
 */
class NoticiasController extends AbstractController
{
    /**
     * @Route("/", name="app_noticias_index", methods={"GET"})
     */
    public function index(NoticiasRepository $noticiasRepository): Response
    {
        return $this->render('noticias/index.html.twig', [
            'noticias' => $noticiasRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_noticias_new", methods={"GET", "POST"})
     */
    public function new(Request $request, NoticiasRepository $noticiasRepository): Response
    {
        $noticia = new Noticias();
        $form = $this->createForm(NoticiasType::class, $noticia);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $noticiasRepository->add($noticia, true);

            return $this->redirectToRoute('app_noticias_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('noticias/new.html.twig', [
            'noticia' => $noticia,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_noticias_show", methods={"GET"})
     */
    public function show(Noticias $noticia): Response
    {
        return $this->render('noticias/show.html.twig', [
            'noticia' => $noticia,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_noticias_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Noticias $noticia, NoticiasRepository $noticiasRepository): Response
    {
        $form = $this->createForm(NoticiasType::class, $noticia);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $noticiasRepository->add($noticia, true);

            return $this->redirectToRoute('app_noticias_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('noticias/edit.html.twig', [
            'noticia' => $noticia,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_noticias_delete", methods={"POST"})
     */
    public function delete(Request $request, Noticias $noticia, NoticiasRepository $noticiasRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$noticia->getId(), $request->request->get('_token'))) {
            $noticiasRepository->remove($noticia, true);
        }

        return $this->redirectToRoute('app_noticias_index', [], Response::HTTP_SEE_OTHER);
    }
}
