<?php

namespace App\Entity;

use App\Repository\CssclassRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CssclassRepository::class)
 */
class Cssclass
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
    private $Cssclass;

    /**
     * @ORM\OneToMany(targetEntity=Actividades::class, mappedBy="Cssclass")
     */
    private $actividades;

    public function __construct()
    {
        $this->actividades = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCssclass(): ?string
    {
        return $this->Cssclass;
    }

    public function setCssclass(string $Cssclass): self
    {
        $this->Cssclass = $Cssclass;

        return $this;
    }

    /**
     * @return Collection<int, Actividades>
     */
    public function getActividades(): Collection
    {
        return $this->actividades;
    }

    public function addActividade(Actividades $actividade): self
    {
        if (!$this->actividades->contains($actividade)) {
            $this->actividades[] = $actividade;
            $actividade->setCssclass($this);
        }

        return $this;
    }

    public function removeActividade(Actividades $actividade): self
    {
        if ($this->actividades->removeElement($actividade)) {
            // set the owning side to null (unless already changed)
            if ($actividade->getCssclass() === $this) {
                $actividade->setCssclass(null);
            }
        }

        return $this;
    }
}
