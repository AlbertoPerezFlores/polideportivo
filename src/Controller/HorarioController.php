<?php

namespace App\Controller;

use App\Entity\Horario;
use App\Form\HorarioType;
use App\Repository\HorarioRepository;
use App\Repository\DiasRepository;
use App\Repository\HoraHorarioRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/horario")
 */
class HorarioController extends AbstractController
{
    /**
     * @Route("/", name="app_horario_index", methods={"GET"})
     */
    public function index(HorarioRepository $horarioRepository, DiasRepository $diasRepository, HoraHorarioRepository $horahorarioRepository): Response
    {
        $hoy = new \DateTime();

        $fechasSemana = array();
    
        $diasSemana = array(
            'Monday',
            'Tuesday',
            'Wednesday',
            'Thursday',
            'Friday',
            'Saturday',
            'Sunday'
        );

        foreach ($diasSemana as $dia) {
            $fecha = clone $hoy;
            $fecha->modify('next ' . $dia);
            $fechasSemana[$dia] = $fecha;
        }

        return $this->render('horario/index.html.twig', [
            'horarios' => $horarioRepository->findAll(),
            'dias' => $diasRepository->findAll(),
            'horas' => $horahorarioRepository->findAll(),
            'hoy' => $hoy,
            'fechasSemana' => $fechasSemana,

        ]);
    }

    /**
     * @Route("/new", name="app_horario_new", methods={"GET", "POST"})
     */
    public function new(Request $request, HorarioRepository $horarioRepository): Response
    {
        $horario = new Horario();
        $form = $this->createForm(HorarioType::class, $horario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $horario->setCapacidadVar($horario->getCapacidad());

                
            $horarioRepository->add($horario, true);

            return $this->redirectToRoute('app_horario_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('horario/new.html.twig', [
            'horario' => $horario,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_horario_show", methods={"GET"})
     */
    public function show(Horario $horario): Response
    {
        return $this->render('horario/show.html.twig', [
            'horario' => $horario,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_horario_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Horario $horario, HorarioRepository $horarioRepository): Response
    {
        $form = $this->createForm(HorarioType::class, $horario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $horario->setCapacidadVar($horario->getCapacidad());

            $horarioRepository->add($horario, true);

            return $this->redirectToRoute('app_horario_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('horario/edit.html.twig', [
            'horario' => $horario,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_horario_delete", methods={"POST"})
     */
    public function delete(Request $request, Horario $horario, HorarioRepository $horarioRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$horario->getId(), $request->request->get('_token'))) {
            $horarioRepository->remove($horario, true);
        }

        return $this->redirectToRoute('app_horario_index', [], Response::HTTP_SEE_OTHER);
    }
}
