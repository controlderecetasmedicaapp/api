<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * TblTiposPrescripciones
 *
 * @ORM\Table(name="tbl_tipos_prescripciones", uniqueConstraints={@ORM\UniqueConstraint(name="id", columns={"id"})})
 * @ORM\Entity
 */
class TblTiposPrescripciones implements \JsonSerializable
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
     * @ORM\Column(name="tipo_prescripcion", type="string", length=255, nullable=false)
     */
    private $tipoPrescripcion;

    /**
     * @ORM\OneToMany(targetEntity="TblPrescripciones", mappedBy="idTipoPrescripcion")
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

    public function getTipoPrescripcion(): ?string
    {
        return $this->tipoPrescripcion;
    }

    public function setTipoPrescripcion(string $tipoPrescripcion): self
    {
        $this->tipoPrescripcion = $tipoPrescripcion;

        return $this;
    }

    /**
     * @return Collection|TblTiposPrescripciones[]
     */
    public function getPrescripcion(): Collection
    {
        return $this->prescripcion;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'tipoPrescripcion' => $this->getTipoPrescripcion(),
            'prescripcion' => $this->getPrescripcion()
        ];
    }
}
