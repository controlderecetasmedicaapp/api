<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * TblFarmacos
 *
 * @ORM\Table(name="tbl_farmacos", uniqueConstraints={@ORM\UniqueConstraint(name="id", columns={"id"})}, indexes={@ORM\Index(name="fk_tblfarmacos_tbltiposprescripciones", columns={"id_tipo_prescripcion"})})
 * @ORM\Entity
 */
class TblFarmacos implements \JsonSerializable
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
     * @ORM\Column(name="nombre_farmaco", type="string", length=255, nullable=false)
     */
    private $nombreFarmaco;

    /**
     * @var \TblTiposPrescripciones
     *
     * @ORM\ManyToOne(targetEntity="TblTiposPrescripciones", inversedBy="farmaco")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_tipo_prescripcion", referencedColumnName="id")
     * })
     */
    private $idTipoPrescripcion;

    /**
     * @ORM\OneToMany(targetEntity="TblMiligramos", mappedBy="idFarmaco")
     */
    private $miligramo;

    public function __construct()
    {
        $this->miligramo = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombreFarmaco(): ?string
    {
        return $this->nombreFarmaco;
    }

    public function setNombreFarmaco(string $nombreFarmaco): self
    {
        $this->nombreFarmaco = $nombreFarmaco;

        return $this;
    }

    public function getIdTipoPrescripcion(): ?TblTiposPrescripciones
    {
        return $this->idTipoPrescripcion;
    }

    public function setIdTipoPrescripcion(?TblTiposPrescripciones $idTipoPrescripcion): self
    {
        $this->idTipoPrescripcion = $idTipoPrescripcion;

        return $this;
    }

    /**
     * @return Collection|TblMiligramos[]
     */
    public function getMiligramo(): Collection
    {
        return $this->miligramo;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'nombre_farmaco' => $this->getNombreFarmaco(),
            'id_tipo_prescripcion' => $this->getIdTipoPrescripcion(),
            'miligramo' => $this->getMiligramo()
        ];
    }

}
