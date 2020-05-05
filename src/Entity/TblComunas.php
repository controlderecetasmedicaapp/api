<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * TblComunas
 *
 * @ORM\Table(name="tbl_comunas", uniqueConstraints={@ORM\UniqueConstraint(name="id", columns={"id"})}, indexes={@ORM\Index(name="fk_tblcomunas_tblprovincias", columns={"id_provincia"})})
 * @ORM\Entity
 */
class TblComunas implements \JsonSerializable
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
     * @ORM\Column(name="comuna", type="string", length=255, nullable=false)
     */
    private $comuna;

    /**
     * @var \TblProvincias
     *
     * @ORM\ManyToOne(targetEntity="TblProvincias", inversedBy="comuna")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_provincia", referencedColumnName="id")
     * })
     */
    private $idProvincia;

    /**
     * @ORM\OneToMany(targetEntity="TblEstablecimientos", mappedBy="idComuna")
     */
    private $establecimiento;

    /**
     * @ORM\OneToMany(targetEntity="TblFarmacias", mappedBy="idFarmacia")
     */
    private $farmacia;

    /**
     * @ORM\OneToMany(targetEntity="TblIsp", mappedBy="idComuna")
     */
    private $isp;

    /**
     * @ORM\OneToMany(targetEntity="TblMedicos", mappedBy="idComuna")
     */
    private $medico;

    /**
     * @ORM\OneToMany(targetEntity="TblPacientes", mappedBy="idComuna")
     */
    private $paciente;

    public function __construct()
    {
        $this->establecimiento = new ArrayCollection();
        $this->farmacia = new ArrayCollection();
        $this->isp = new ArrayCollection();
        $this->medico = new ArrayCollection();
        $this->paciente = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getComuna(): ?string
    {
        return $this->comuna;
    }

    public function setComuna(string $comuna): self
    {
        $this->comuna = $comuna;

        return $this;
    }

    public function getIdProvincia(): ?TblProvincias
    {
        return $this->idProvincia;
    }

    public function setIdProvincia(?TblProvincias $idProvincia): self
    {
        $this->idProvincia = $idProvincia;

        return $this;
    }

    /**
     * @return Collection|TblEstablecimientos[]
     */
    public function getEstablecimiento(): Collection
    {
        return $this->establecimiento;
    }

    /**
     * @return Collection|TblFarmacias[]
     */
    public function getFarmacia(): Collection
    {
        return $this->farmacia;
    }

    /**
     * @return Collection|TblIsp[]
     */
    public function getIsp(): Collection
    {
        return $this->isp;
    }

    /**
     * @return Collection|TblMedicos[]
     */
    public function getMedico(): Collection
    {
        return $this->medico;
    }

    /**
     * @return Collection|TblPacientes[]
     */
    public function getPaciente(): Collection
    {
        return $this->paciente;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'comuna' => $this->getComuna(),
            'id_provincia' => $this->getIdProvincia(),
            'establecimiento' => $this->getEstablecimiento(),
            'farmacia' => $this->getFarmacia(),
            'isp' => $this->getIsp(),
            'medico' => $this->getMedico(),
            'paciente' => $this->getPaciente()
        ];
    }
}
