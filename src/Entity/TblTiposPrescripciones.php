<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TblTiposPrescripciones
 *
 * @ORM\Table(name="tbl_tipos_prescripciones", uniqueConstraints={@ORM\UniqueConstraint(name="id", columns={"id"})})
 * @ORM\Entity
 */
class TblTiposPrescripciones
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


}
