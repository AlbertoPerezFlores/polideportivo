<?php

namespace App\Controller;

use App\Entity\HistoricoClases;
use App\Form\HistoricoClasesType;
use App\Repository\HistoricoClasesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/historico/clases")
 */
class HistoricoClasesController extends AbstractController
{
    /**
     * @Route("/", name="app_historico_clases_index", methods={"GET"})
     */
    public function index(HistoricoClasesRepository $historicoClasesRepository): Response
    {
        return $this->render('historico_clases/index.html.twig', [
            'historico_clases' => $historicoClasesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_historico_clases_new", methods={"GET", "POST"})
     */
    public function new(Request $request, HistoricoClasesRepository $historicoClasesRepository): Response
    {
        $historicoClase = new HistoricoClases();
        $form = $this->createForm(HistoricoClasesType::class, $historicoClase);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $historicoClasesRepository->add($historicoClase, true);

            return $this->redirectToRoute('app_historico_clases_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('historico_clases/new.html.twig', [
            'historico_clase' => $historicoClase,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_historico_clases_show", methods={"GET"})
     */
    public function show(HistoricoClases $historicoClase): Response
    {
        return $this->render('historico_clases/show.html.twig', [
            'historico_clase' => $historicoClase,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_historico_clases_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, HistoricoClases $historicoClase, HistoricoClasesRepository $historicoClasesRepository): Response
    {
        $form = $this->createForm(HistoricoClasesType::class, $historicoClase);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $historicoClasesRepository->add($historicoClase, true);

            return $this->redirectToRoute('app_historico_clases_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('historico_clases/edit.html.twig', [
            'historico_clase' => $historicoClase,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_historico_clases_delete", methods={"POST"})
     */
    public function delete(Request $request, HistoricoClases $historicoClase, HistoricoClasesRepository $historicoClasesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$historicoClase->getId(), $request->request->get('_token'))) {
            $historicoClasesRepository->remove($historicoClase, true);
        }

        return $this->redirectToRoute('app_historico_clases_index', [], Response::HTTP_SEE_OTHER);
    }


    public function AddReserva($request ,$historicoClase, historicoClasesRepository $historicoClasesRepository): Response
    {
           $fechaActividad = \DateTime::createFromFormat('d-m-Y', $request->request->get('fechaactividad'));
           $horaActividad = \DateTime::createFromFormat('H:i', $request->request->get('horaactividad'));
           $Usuario = $request->request->get('user');
           $actividad = $request->request->get('actividad');

           // Asignar los valores al objeto HistoricoClases
           $historicoClase->setFechaActividad($fechaActividad);
           $historicoClase->setHoraActividad($horaActividad);
           $historicoClase->setusuario($Usuario);
           $historicoClase->setActividad($actividad);

           $historicoClasesRepository->add($historicoClase, true);

           //resta 1 a la capacidad
           //$this->capacidadReserva($request, $horarioRepository);

           return $this->redirectToRoute('app_horario_index', [], Response::HTTP_SEE_OTHER);
    
       
    }

    public function creaForm($historicoClase, $request)
    {
        $form = $this->createForm(HistoricoClasesType::class, $historicoClase);
        $form->handleRequest($request);

        return $form;
    }
}
