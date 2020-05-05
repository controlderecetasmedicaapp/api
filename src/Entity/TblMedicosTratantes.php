<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TblMedicosTratantes
 *
 * @ORM\Table(name="tbl_medicos_tratantes", uniqueConstraints={@ORM\UniqueConstraint(name="id", columns={"id"})}, indexes={@ORM\Index(name="fk_tblmedicostratantes_tblmedicos", columns={"id_medico"}), @ORM\Index(name="fk_tblmedicostratantes_tblpacientes", columns={"id_paciente"})})
 * @ORM\Entity
 */
class TblMedicosTratantes implements \JsonSerializable
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
     * @var \TblMedicos
     *
     * @ORM\ManyToOne(targetEntity="TblMedicos", inversedBy="medicoTratante")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_medico", referencedColumnName="id")
     * })
     */
    private $idMedico;

    /**
     * @var \TblPacientes
     *
     * @ORM\ManyToOne(targetEntity="TblPacientes", inversedBy="medicoTratante")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_paciente", referencedColumnName="id")
     * })
     */
    private $idPaciente;

    public function getId(): ?int
    {
        return $this->id;
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

    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'id_paciente' => $this->getIdPaciente(),
            'id_medico' => $this->getIdMedico()
        ];
    }
}
