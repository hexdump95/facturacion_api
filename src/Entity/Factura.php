<?php

namespace App\Entity;

use App\Repository\FacturaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FacturaRepository::class)
 */
class Factura
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $fecha;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $numero;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $total;

    /**
     * @ORM\ManyToOne(targetEntity=Cliente::class)
     */
    private $cliente;

    /**
     * @ORM\ManyToMany(targetEntity=DetalleFactura::class)
     * @ORM\JoinTable(name="factura_detalle_factura",
     *      joinColumns={@ORM\JoinColumn(name="factura_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="detalles_id", referencedColumnName="id", unique=true)}
     * )
     */
    private $detalles;

    public function __construct()
    {
        $this->detalles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(?\DateTimeInterface $fecha): self
    {
        $this->fecha = $fecha;

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

    public function getTotal(): ?int
    {
        return $this->total;
    }

    public function setTotal(?int $total): self
    {
        $this->total = $total;

        return $this;
    }

    public function getCliente(): ?Cliente
    {
        return $this->cliente;
    }

    public function setCliente(?Cliente $cliente): self
    {
        $this->cliente = $cliente;

        return $this;
    }

    /**
     * @return Collection|DetalleFactura[]
     */
    public function getDetalles(): Collection
    {
        return $this->detalles;
    }

    public function addDetalle(DetalleFactura $detalle): self
    {
        if (!$this->detalles->contains($detalle)) {
            $this->detalles[] = $detalle;
            $detalle->setFactura($this);
        }

        return $this;
    }

    public function removeDetalle(DetalleFactura $detalle): self
    {
        if ($this->detalles->contains($detalle)) {
            $this->detalles->removeElement($detalle);
            // set the owning side to null (unless already changed)
            if ($detalle->getFactura() === $this) {
                $detalle->setFactura(null);
            }
        }

        return $this;
    }
}
