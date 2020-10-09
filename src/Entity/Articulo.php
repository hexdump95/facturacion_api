<?php

namespace App\Entity;

use App\Repository\ArticuloRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArticuloRepository::class)
 */
class Articulo
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $cantidad;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $denominacion;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $precio;

    /**
     * @ORM\ManyToMany(targetEntity=Categoria::class)
     */
    private $categorias;

    public function __construct()
    {
        $this->categorias = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCantidad(): ?int
    {
        return $this->cantidad;
    }

    public function setCantidad(?int $cantidad): self
    {
        $this->cantidad = $cantidad;

        return $this;
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

    public function getPrecio(): ?int
    {
        return $this->precio;
    }

    public function setPrecio(?int $precio): self
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * @return Collection|Categoria[]
     */
    public function getCategorias(): Collection
    {
        return $this->categorias;
    }

    public function addCategoria(Categoria $categoria): self
    {
        if (!$this->categorias->contains($categoria)) {
            $this->categorias[] = $categoria;
        }

        return $this;
    }

    public function removeCategoria(Categoria $categoria): self
    {
        if ($this->categorias->contains($categoria)) {
            $this->categorias->removeElement($categoria);
        }

        return $this;
    }
}
