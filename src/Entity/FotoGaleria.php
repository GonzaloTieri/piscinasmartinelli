<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FotoGaleriaRepository")
 *  @ORM\Table(name="foto_galeria")
 */
class FotoGaleria
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=500)
     */
    private $nombre_foto;

    /**
     * @ORM\Column(type="integer", name="id_galeria")
     */
    private $idGaleria;

    /**
     * @ORM\Column(type="string", length=500)
     */
    private $url_foto;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombreFoto(): ?string
    {
        return $this->nombre_foto;
    }

    public function setNombreFoto(string $nombre_foto): self
    {
        $this->nombre_foto = $nombre_foto;

        return $this;
    }

    public function getIdGaleria(): ?int
    {
        return $this->idGaleria;
    }

    public function setIdGaleria(int $id_galeria): self
    {
        $this->idGaleria = $id_galeria;

        return $this;
    }

    public function getUrlFoto(): ?string
    {
        return $this->url_foto;
    }

    public function setUrlFoto(string $url_foto): self
    {
        $this->url_foto = $url_foto;

        return $this;
    }
}
