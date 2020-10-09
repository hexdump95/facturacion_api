<?php

namespace App\Entity;

use App\Repository\CategoriaRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoriaRepository::class)
 */
class Categoria
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
    private $denominacion;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDenominacion(): ?string
    {
        return $this->denominacion;
    }

    public function setDenominacion(?string $denominacion): self
    {
        $this->denominacion = $denominacion;

        return $this;
    }
}
