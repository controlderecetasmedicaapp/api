<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TblPacientes
 *
 * @ORM\Table(name="tbl_pacientes", uniqueConstraints={@ORM\UniqueConstraint(name="id", columns={"id"})}, indexes={@ORM\Index(name="fk_tblpacientes_tblcomunas", columns={"id_comuna"}), @ORM\Index(name="fk_tblpacientes_tblsexo", columns={"id_sexo"}), @ORM\Index(name="fk_tblpacientes_tblusuarios", columns={"id_paciente"})})
 * @ORM\Entity
 */
class TblPacientes
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
     * @ORM\Column(name="nombre_paciente", type="string", length=255, nullable=false)
     */
    private $nombrePaciente;

    /**
     * @var string
     *
     * @ORM\Column(name="apellido_paciente", type="string", length=255, nullable=false)
     */
    private $apellidoPaciente;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion_paciente", type="string", length=255, nullable=false)
     */
    private $direccionPaciente;

    /**
     * @var string
     *
     * @ORM\Column(name="fono_paciente", type="string", length=255, nullable=false)
     */
    private $fonoPaciente;

    /**
     * @var string|null
     *
     * @ORM\Column(name="email_paciente", type="string", length=255, nullable=true)
     */
    private $emailPaciente;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_nacimiento", type="datetime", nullable=false)
     */
    private $fechaNacimiento;

    /**
     * @var int
     *
     * @ORM\Column(name="peso", type="integer", nullable=false)
     */
    private $peso;

    /**
     * @var int
     *
     * @ORM\Column(name="altura", type="integer", nullable=false)
     */
    private $altura;

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
     * @var \TblComunas
     *
     * @ORM\ManyToOne(targetEntity="TblComunas")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_comuna", referencedColumnName="id")
     * })
     */
    private $idComuna;

    /**
     * @var \TblSexo
     *
     * @ORM\ManyToOne(targetEntity="TblSexo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_sexo", referencedColumnName="id")
     * })
     */
    private $idSexo;

    /**
     * @var \TblUsuarios
     *
     * @ORM\ManyToOne(targetEntity="TblUsuarios")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_paciente", referencedColumnName="id")
     * })
     */
    private $idPaciente;


}
