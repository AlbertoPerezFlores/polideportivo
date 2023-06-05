<?php
// src/Command/UpdateCapacidadVarCommand.php

namespace App\command;

use App\Entity\Horario;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UpdateCapacidadVarCommand extends Command
{
    protected static $defaultName = 'app:update-capacidad-var';
    protected static $defaultDescription = 'Actualiza la propiedad capacidadVar en los horarios.';

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription(self::$defaultDescription);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // Obtener los horarios a actualizar
        $horarios = $this->entityManager->getRepository(Horario::class)->findAll();

        // Actualizar la propiedad capacidadVar
        foreach ($horarios as $horario) {
            $horario->setCapacidadVar($horario->getCapacidad());
        }

        // Guardar los cambios en la base de datos
        $this->entityManager->flush();

        $output->writeln('La propiedad capacidadVar se ha actualizado en todos los horarios.');

        return Command::SUCCESS;
    }
}
// Ejecutar este comando "php bin/console app:update-capacidad-var" para que se actualice la capacidad del horario