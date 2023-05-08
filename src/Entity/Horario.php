<?php

namespace App\Entity;

use App\Repository\HorarioRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HorarioRepository::class)
 */
class Horario
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Actividades::class, inversedBy="horarios")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Actividad;

    /**
     * @ORM\ManyToOne(targetEntity=Sala::class, inversedBy="horarios")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Sala;

    /**
     * @ORM\ManyToOne(targetEntity=Horahorario::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $Hora;

    /**
     * @ORM\Column(type="integer")
     */
    private $Capacidad;

    /**
     * @ORM\ManyToOne(targetEntity=Dias::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $Dia;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getActividad(): ?Actividades
    {
        return $this->Actividad;
    }

    public function setActividad(?Actividades $Actividad): self
    {
        $this->Actividad = $Actividad;

        return $this;
    }

    public function getSala(): ?Sala
    {
        return $this->Sala;
    }

    public function setSala(?Sala $Sala): self
    {
        $this->Sala = $Sala;

        return $this;
    }

    public function getHora(): ?Horahorario
    {
        return $this->Hora;
    }

    public function setHora(?Horahorario $Hora): self
    {
        $this->Hora = $Hora;

        return $this;
    }

    public function getCapacidad(): ?int
    {
        return $this->Capacidad;
    }

    public function setCapacidad(int $Capacidad): self
    {
        $this->Capacidad = $Capacidad;

        return $this;
    }

    public function getDia(): ?Dias
    {
        return $this->Dia;
    }

    public function setDia(?Dias $Dia): self
    {
        $this->Dia = $Dia;

        return $this;
    }
}
