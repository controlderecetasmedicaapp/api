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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRcmMedico(): ?string
    {
        return $this->rcmMedico;
    }

    public function setRcmMedico(string $rcmMedico): self
    {
        $this->rcmMedico = $rcmMedico;

        return $this;
    }

    public function getNombreMedico(): ?string
    {
        return $this->nombreMedico;
    }

    public function setNombreMedico(string $nombreMedico): self
    {
        $this->nombreMedico = $nombreMedico;

        return $this;
    }

    public function getApellidosMedico(): ?string
    {
        return $this->apellidosMedico;
    }

    public function setApellidosMedico(string $apellidosMedico): self
    {
        $this->apellidosMedico = $apellidosMedico;

        return $this;
    }

    public function getDireccionMedico(): ?string
    {
        return $this->direccionMedico;
    }

    public function setDireccionMedico(string $direccionMedico): self
    {
        $this->direccionMedico = $direccionMedico;

        return $this;
    }

    public function getEmailMedico(): ?string
    {
        return $this->emailMedico;
    }

    public function setEmailMedico(string $emailMedico): self
    {
        $this->emailMedico = $emailMedico;

        return $this;
    }

    public function getFonoMedico(): ?string
    {
        return $this->fonoMedico;
    }

    public function setFonoMedico(string $fonoMedico): self
    {
        $this->fonoMedico = $fonoMedico;

        return $this;
    }

    public function getFirmaMedico(): ?string
    {
        return $this->firmaMedico;
    }

    public function setFirmaMedico(string $firmaMedico): self
    {
        $this->firmaMedico = $firmaMedico;

        return $this;
    }

    public function getIdComuna(): ?TblComunas
    {
        return $this->idComuna;
    }

    public function setIdComuna(?TblComunas $idComuna): self
    {
        $this->idComuna = $idComuna;

        return $this;
    }

    public function getIdEspecialidad(): ?TblEspecialidades
    {
        return $this->idEspecialidad;
    }

    public function setIdEspecialidad(?TblEspecialidades $idEspecialidad): self
    {
        $this->idEspecialidad = $idEspecialidad;

        return $this;
    }

    public function getIdEstablecimiento(): ?TblEstablecimientos
    {
        return $this->idEstablecimiento;
    }

    public function setIdEstablecimiento(?TblEstablecimientos $idEstablecimiento): self
    {
        $this->idEstablecimiento = $idEstablecimiento;

        return $this;
    }

    public function getIdMedico(): ?TblUsuarios
    {
        return $this->idMedico;
    }

    public function setIdMedico(?TblUsuarios $idMedico): self
    {
        $this->idMedico = $idMedico;

        return $this;
    }


}
