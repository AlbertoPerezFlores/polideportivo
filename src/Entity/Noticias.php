<?php

namespace App\Entity;

use App\Repository\NoticiasRepository;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass=NoticiasRepository::class)
 */
class Noticias
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
    private $titulo;

    /**
     * @ORM\Column(type="text")
     */
    private $descrip;

    /**
     * @ORM\Column(type="text")
     */
    private $descripExtend;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $organizador;

    /**
     * @ORM\Column(type="blob", nullable=true)
     */
    private $imagen;

    /**
     * @ORM\Column(type="datetime")
     */
    private $Fecha_publicacion;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): self
    {
        $this->titulo = $titulo;

        return $this;
    }

    public function getDescrip(): ?string
    {
        return $this->descrip;
    }

    public function setDescrip(string $descrip): self
    {
        $this->descrip = $descrip;

        return $this;
    }

    public function getDescripExtend(): ?string
    {
        return $this->descripExtend;
    }

    public function setDescripExtend(string $descripExtend): self
    {
        $this->descripExtend = $descripExtend;

        return $this;
    }

    public function getOrganizador(): ?string
    {
        return $this->organizador;
    }

    public function setOrganizador(string $organizador): self
    {
        $this->organizador = $organizador;

        return $this;
    }

    public function getImagen()
    {
        return $this->imagen;
    }

    public function setImagen($imagen): self
    {
        $this->imagen = $imagen;

        return $this;
    }

    public function getFechaPublicacion(): ?\DateTimeInterface
    {
        return $this->Fecha_publicacion;
    }

    public function setFechaPublicacion(\DateTimeInterface $Fecha_publicacion): self
    {
        $this->Fecha_publicacion = $Fecha_publicacion;

        return $this;
    }
}
