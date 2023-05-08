<?php

namespace App\Entity;

use App\Repository\ActividadesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ActividadesRepository::class)
 */
class Actividades
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Actividad;

    /**
     * @ORM\OneToMany(targetEntity=Horario::class, mappedBy="Actividad")
     */
    private $horarios;

    public function __construct()
    {
        $this->horarios = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getActividad(): ?string
    {
        return $this->Actividad;
    }

    public function setActividad(string $Actividad): self
    {
        $this->Actividad = $Actividad;

        return $this;
    }

    /**
     * @return Collection<int, Horario>
     */
    public function getHorarios(): Collection
    {
        return $this->horarios;
    }

    public function addHorario(Horario $horario): self
    {
        if (!$this->horarios->contains($horario)) {
            $this->horarios[] = $horario;
            $horario->setActividad($this);
        }

        return $this;
    }

    public function removeHorario(Horario $horario): self
    {
        if ($this->horarios->removeElement($horario)) {
            // set the owning side to null (unless already changed)
            if ($horario->getActividad() === $this) {
                $horario->setActividad(null);
            }
        }

        return $this;
    }
}
