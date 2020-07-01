<?php
namespace App\Entity;

/*
    is not mapped entity
*/

class ConsultaMail 
{
    private $nombre;
    private $email;
    private $telefono;
    private  $mensaje;

    public function getNombre() : ?string {
        return $this->nombre;
    } 

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getEmail() : ?string {
        return $this->email;
    } 

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getTelefono() : ?string {
        return $this->telefono;
    } 

    public function setTelefono(string $telefono): self
    {
        $this->telefono = $telefono;

        return $this;
    }

    public function getMensaje() : ?string {
        return $this->mensaje;
    } 

    public function setMensaje(string $mensaje): self
    {
        $this->mensaje = $mensaje;

        return $this;
    }

}