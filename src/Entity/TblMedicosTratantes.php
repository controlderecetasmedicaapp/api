<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TblMedicosTratantes
 *
 * @ORM\Table(name="tbl_medicos_tratantes", uniqueConstraints={@ORM\UniqueConstraint(name="id", columns={"id"})}, indexes={@ORM\Index(name="fk_tblmedicostratantes_tblmedicos", columns={"id_medico"}), @ORM\Index(name="fk_tblmedicostratantes_tblpacientes", columns={"id_paciente"})})
 * @ORM\Entity
 */
class TblMedicosTratantes
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


}
