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


}
