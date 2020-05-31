<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GaleryRepository")
 * @ORM\Table(name="galeria")
 */
class Galery
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=5000)
     */
    private $nombre_galeria;

    /**
     * @ORM\Column(type="string", length=5000)
     */
    private $url_foto_portada;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombreGaleria(): ?string
    {
        return $this->nombre_galeria;
    }

    public function setNombreGaleria(string $nombre_galeria): self
    {
        $this->nombre_galeria = $nombre_galeria;

        return $this;
    }

    public function getUrlFotoPortada(): ?string
    {
        return $this->url_foto_portada;
    }

    public function setUrlFotoPortada(string $url_foto_portada): self
    {
        $this->url_foto_portada = $url_foto_portada;

        return $this;
    }
}
