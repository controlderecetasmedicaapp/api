<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TblMedicos
 *
 * @ORM\Table(name="tbl_medicos", uniqueConstraints={@ORM\UniqueConstraint(name="id", columns={"id"})}, indexes={@ORM\Index(name="fk_tblmedicos_tblcomunas", columns={"id_comuna"}), @ORM\Index(name="fk_tblmedicos_tblespecialidades", columns={"id_especialidad"}), @ORM\Index(name="fk_tblmedicos_tblestablecimiento", columns={"id_establecimiento"}), @ORM\Index(name="fk_tblmedicos_tblusuarios", columns={"id_medico"})})
 * @ORM\Entity
 */
class TblMedicos
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
     * @ORM\Column(name="rcm_medico", type="string", length=255, nullable=false)
     */
    private $rcmMedico;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_medico", type="string", length=255, nullable=false)
     */
    private $nombreMedico;

    /**
     * @var string
     *
     * @ORM\Column(name="apellidos_medico", type="string", length=255, nullable=false)
     */
    private $apellidosMedico;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion_medico", type="string", length=255, nullable=false)
     */
    private $direccionMedico;

    /**
     * @var string
     *
     * @ORM\Column(name="email_medico", type="string", length=255, nullable=false)
     */
    private $emailMedico;

    /**
     * @var string
     *
     * @ORM\Column(name="fono_medico", type="string", length=15, nullable=false)
     */
    private $fonoMedico;

    /**
     * @var string
     *
     * @ORM\Column(name="firma_medico", type="string", length=255, nullable=false)
     */
    private $firmaMedico;

    /**
     * @var \TblComunas
     *
     * @ORM\ManyToOne(targetEntity="TblComunas")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_comuna", referencedColumnName="id")
     * })
     */
    private $idComuna;

    /**
     * @var \TblEspecialidades
     *
     * @ORM\ManyToOne(targetEntity="TblEspecialidades")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_especialidad", referencedColumnName="id")
     * })
     */
    private $idEspecialidad;

    /**
     * @var \TblEstablecimientos
     *
     * @ORM\ManyToOne(targetEntity="TblEstablecimientos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_establecimiento", referencedColumnName="id")
     * })
     */
    private $idEstablecimiento;

    /**
     * @var \TblUsuarios
     *
     * @ORM\ManyToOne(targetEntity="TblUsuarios")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_medico", referencedColumnName="id")
     * })
     */
    private $idMedico;


}
