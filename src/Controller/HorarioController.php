<?php

namespace App\Controller;

use App\Entity\HistoricoClases;
use App\Entity\Horario;

use App\Form\HorarioType;
use App\Form\HistoricoClasesType;
use App\Repository\HorarioRepository;
use App\Repository\DiasRepository;
use App\Repository\HoraHorarioRepository;
use App\Repository\HistoricoClasesRepository;
use App\Controller\HistoricoClasesController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use DateTime;


/**
 * @Route("/horario")
 */
class HorarioController extends AbstractController
{
    private $HistoricoClasesController;
    private $security;

    public function __construct(HistoricoClasesController $HistoricoClasesController, Security $security)
    {
        $this->HistoricoClasesController = $HistoricoClasesController;
        $this->security = $security;
    }

    /**
     * @Route("/", name="app_horario_index", methods={"GET", "POST"})
     */
    public function index(Request $request,HorarioRepository $horarioRepository, DiasRepository $diasRepository, HoraHorarioRepository $horahorarioRepository, HistoricoClasesRepository $HistoricoClasesRepository): Response
    {
        $token = $this->security->getToken();

        // Verificar si hay un token y si el usuario está autenticado
        if ($token && $this->isGranted('IS_AUTHENTICATED_FULLY')) {
            // Obtener el usuario actual
            $user = $token->getUser();

            // Obtener el ID del usuario
            $userId = $user->getId();

        }

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

        $historicoClase = new HistoricoClases();
        $form = $this->createForm(HistoricoClasesType::class, $historicoClase);
        $form->handleRequest($request);


       if ($form->isSubmitted() && $form->isValid()) {
        $HistoricoClasesRepository->add($historicoClase, true);

        
            return $this->redirectToRoute('app_horario_index', [], Response::HTTP_SEE_OTHER);
       }

    
        return $this->render('horario/index.html.twig', [
            'horarios' => $horarioRepository->findAll(),
            'dias' => $diasRepository->findAll(),
            'horas' => $horahorarioRepository->findAll(),
            'hoy' => $hoy,
            'form' => $form->createview(),
            'fechasSemana' => $fechasSemana,
            'userid'=> $userId, 
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

    public function capacidadReserva($request,$horarioRepository)
    {
        $horario = new Horario();
        $form = $this->createForm(HorarioType::class, $horario);
        $form->handleRequest($request);
        $horario->setCapacidadVar($horario->getCapacidadVar()-1);

        $horarioRepository->add($horario, true);

    }
}
