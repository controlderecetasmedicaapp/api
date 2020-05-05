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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombrePaciente(): ?string
    {
        return $this->nombrePaciente;
    }

    public function setNombrePaciente(string $nombrePaciente): self
    {
        $this->nombrePaciente = $nombrePaciente;

        return $this;
    }

    public function getApellidoPaciente(): ?string
    {
        return $this->apellidoPaciente;
    }

    public function setApellidoPaciente(string $apellidoPaciente): self
    {
        $this->apellidoPaciente = $apellidoPaciente;

        return $this;
    }

    public function getDireccionPaciente(): ?string
    {
        return $this->direccionPaciente;
    }

    public function setDireccionPaciente(string $direccionPaciente): self
    {
        $this->direccionPaciente = $direccionPaciente;

        return $this;
    }

    public function getFonoPaciente(): ?string
    {
        return $this->fonoPaciente;
    }

    public function setFonoPaciente(string $fonoPaciente): self
    {
        $this->fonoPaciente = $fonoPaciente;

        return $this;
    }

    public function getEmailPaciente(): ?string
    {
        return $this->emailPaciente;
    }

    public function setEmailPaciente(?string $emailPaciente): self
    {
        $this->emailPaciente = $emailPaciente;

        return $this;
    }

    public function getFechaNacimiento(): ?\DateTimeInterface
    {
        return $this->fechaNacimiento;
    }

    public function setFechaNacimiento(\DateTimeInterface $fechaNacimiento): self
    {
        $this->fechaNacimiento = $fechaNacimiento;

        return $this;
    }

    public function getPeso(): ?int
    {
        return $this->peso;
    }

    public function setPeso(int $peso): self
    {
        $this->peso = $peso;

        return $this;
    }

    public function getAltura(): ?int
    {
        return $this->altura;
    }

    public function setAltura(int $altura): self
    {
        $this->altura = $altura;

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

    public function getIdComuna(): ?TblComunas
    {
        return $this->idComuna;
    }

    public function setIdComuna(?TblComunas $idComuna): self
    {
        $this->idComuna = $idComuna;

        return $this;
    }

    public function getIdSexo(): ?TblSexo
    {
        return $this->idSexo;
    }

    public function setIdSexo(?TblSexo $idSexo): self
    {
        $this->idSexo = $idSexo;

        return $this;
    }

    public function getIdPaciente(): ?TblUsuarios
    {
        return $this->idPaciente;
    }

    public function setIdPaciente(?TblUsuarios $idPaciente): self
    {
        $this->idPaciente = $idPaciente;

        return $this;
    }


}