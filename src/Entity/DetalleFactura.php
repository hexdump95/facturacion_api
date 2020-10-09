<?php

namespace App\Entity;

use App\Repository\DetalleFacturaRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DetalleFacturaRepository::class)
 */
class DetalleFactura
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
     * @ORM\Column(type="integer", nullable=true)
     */
    private $subtotal;

    /**
     * @ORM\ManyToOne(targetEntity=Articulo::class)
     */
    private $articulo;

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

    public function getSubtotal(): ?int
    {
        return $this->subtotal;
    }

    public function setSubtotal(?int $subtotal): self
    {
        $this->subtotal = $subtotal;

        return $this;
    }

    public function getArticulo(): ?Articulo
    {
        return $this->articulo;
    }

    public function setArticulo(?Articulo $articulo): self
    {
        $this->articulo = $articulo;

        return $this;
    }

    public function getFactura(): ?Factura
    {
        return $this->factura;
    }

    public function setFactura(?Factura $factura): self
    {
        $this->factura = $factura;

        return $this;
    }
}
