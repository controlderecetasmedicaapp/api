<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TblPrescripciones
 *
 * @ORM\Table(name="tbl_prescripciones", uniqueConstraints={@ORM\UniqueConstraint(name="id", columns={"id"})}, indexes={@ORM\Index(name="fk_tblprescripciones_tblEstadoPrescripcion", columns={"id_estado"}), @ORM\Index(name="fk_tblprescripciones_tblmedicos", columns={"id_medico"}), @ORM\Index(name="fk_tblprescripciones_tblpacientes", columns={"id_paciente"}), @ORM\Index(name="fk_tblprescripciones_tbltiposprescripcion", columns={"id_tipo_prescripcion"})})
 * @ORM\Entity
 */
class TblPrescripciones
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
     * @ORM\Column(name="prescripcion_code", type="string", length=255, nullable=false)
     */
    private $prescripcionCode;

    /**
     * @var int
     *
     * @ORM\Column(name="duracion_tratamiento", type="integer", nullable=false)
     */
    private $duracionTratamiento;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=false)
     */
    private $updatedAt;

    /**
     * @var \TblEstadoPrescripcion
     *
     * @ORM\ManyToOne(targetEntity="TblEstadoPrescripcion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_estado", referencedColumnName="id")
     * })
     */
    private $idEstado;

    /**
     * @var \TblMedicos
     *
     * @ORM\ManyToOne(targetEntity="TblMedicos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_medico", referencedColumnName="id")
     * })
     */
    private $idMedico;

    /**
     * @var \TblPacientes
     *
     * @ORM\ManyToOne(targetEntity="TblPacientes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_paciente", referencedColumnName="id")
     * })
     */
    private $idPaciente;

    /**
     * @var \TblTiposPrescripciones
     *
     * @ORM\ManyToOne(targetEntity="TblTiposPrescripciones")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_tipo_prescripcion", referencedColumnName="id")
     * })
     */
    private $idTipoPrescripcion;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrescripcionCode(): ?string
    {
        return $this->prescripcionCode;
    }

    public function setPrescripcionCode(string $prescripcionCode): self
    {
        $this->prescripcionCode = $prescripcionCode;

        return $this;
    }

    public function getDuracionTratamiento(): ?int
    {
        return $this->duracionTratamiento;
    }

    public function setDuracionTratamiento(int $duracionTratamiento): self
    {
        $this->duracionTratamiento = $duracionTratamiento;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getIdEstado(): ?TblEstadoPrescripcion
    {
        return $this->idEstado;
    }

    public function setIdEstado(?TblEstadoPrescripcion $idEstado): self
    {
        $this->idEstado = $idEstado;

        return $this;
    }

    public function getIdMedico(): ?TblMedicos
    {
        return $this->idMedico;
    }

    public function setIdMedico(?TblMedicos $idMedico): self
    {
        $this->idMedico = $idMedico;

        return $this;
    }

    public function getIdPaciente(): ?TblPacientes
    {
        return $this->idPaciente;
    }

    public function setIdPaciente(?TblPacientes $idPaciente): self
    {
        $this->idPaciente = $idPaciente;

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


}
