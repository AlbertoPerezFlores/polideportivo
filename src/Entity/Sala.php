<?php

namespace App\Entity;

use App\Repository\SalaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SalaRepository::class)
 */
class Sala
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
    private $nombre_sala;

    /**
     * @ORM\OneToMany(targetEntity=Horario::class, mappedBy="Sala")
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

    public function getNombreSala(): ?string
    {
        return $this->nombre_sala;
    }

    public function setNombreSala(string $nombre_sala): self
    {
        $this->nombre_sala = $nombre_sala;

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
            $horario->setSala($this);
        }

        return $this;
    }

    public function removeHorario(Horario $horario): self
    {
        if ($this->horarios->removeElement($horario)) {
            // set the owning side to null (unless already changed)
            if ($horario->getSala() === $this) {
                $horario->setSala(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->nombre_sala;
    }
}
