<?php

namespace App\Entity;

use App\Repository\DomicilioRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DomicilioRepository::class)
 */
class Domicilio
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nombreCalle;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $numero;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombreCalle(): ?string
    {
        return $this->nombreCalle;
    }

    public function setNombreCalle(?string $nombreCalle): self
    {
        $this->nombreCalle = $nombreCalle;

        return $this;
    }

    public function getNumero(): ?int
    {
        return $this->numero;
    }

    public function setNumero(?int $numero): self
    {
        $this->numero = $numero;

        return $this;
    }
}
