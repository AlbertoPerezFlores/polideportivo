<?php

namespace App\Entity;

use App\Repository\HistoricoClasesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HistoricoClasesRepository::class)
 */
class HistoricoClases
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Actividades::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $actividad;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $usuario;

    /**
     * @ORM\Column(type="date")
     */
    private $fecha_Actividad;

    public function __construct()
    {
        $this->actividad = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Actividades>
     */
    public function getActividad(): Collection
    {
        return $this->actividad;
    }

    public function addActividad(Actividades $actividad): self
    {
        if (!$this->actividad->contains($actividad)) {
            $this->actividad[] = $actividad;
        }

        return $this;
    }

    public function removeActividad(Actividades $actividad): self
    {
        $this->actividad->removeElement($actividad);

        return $this;
    }

    public function getUsuario(): ?User
    {
        return $this->usuario;
    }

    public function setUsuario(?User $usuario): self
    {
        $this->usuario = $usuario;

        return $this;
    }

    public function getFechaActividad(): ?\DateTimeInterface
    {
        return $this->fecha_Actividad;
    }

    public function setFechaActividad(\DateTimeInterface $fecha_Actividad): self
    {
        $this->fecha_Actividad = $fecha_Actividad;

        return $this;
    }
}
