<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * TblEstadoPrescripcion
 *
 * @ORM\Table(name="tbl_estado_prescripcion", uniqueConstraints={@ORM\UniqueConstraint(name="estado", columns={"estado"}), @ORM\UniqueConstraint(name="id", columns={"id"})})
 * @ORM\Entity
 */
class TblEstadoPrescripcion implements \JsonSerializable
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=255, nullable=false)
     */
    private $estado;

    /**
     * @ORM\OneToMany(targetEntity="TblPrescripciones", mappedBy="idEstado")
     */
    private $prescripcion;

    public function __construct()
    {
        $this->prescripcion = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEstado(): ?string
    {
        return $this->estado;
    }

    public function setEstado(string $estado): self
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * @return Collection|TblPrescripciones[]
     */
    public function getPrescripcion(): Collection
    {
        return $this->prescripcion;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'estado' => $this->getEstado(),
            'prescripcion' => $this->getPrescripcion()
        ];
    }
}
