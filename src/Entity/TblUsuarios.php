<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * TblUsuarios
 *
 * @ORM\Table(name="tbl_usuarios", uniqueConstraints={@ORM\UniqueConstraint(name="id", columns={"id"})}, indexes={@ORM\Index(name="fk_tblusuarios_tbltipousuarios", columns={"id_tipo_usuario"})})
 * @ORM\Entity
 */
class TblUsuarios implements \JsonSerializable
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
     * @ORM\Column(name="rut_usuario", type="string", length=255, nullable=false)
     * @Assert\NotBlank
     * @Assert\NotNull
     * @Assert\Length(
     *      min = 3,
     *      max = 20,
     *      minMessage = "Su rut debe tener al menos {{ limit }} caracteres de longitud",
     *      maxMessage = "Su rut no puede tener más de {{ limit }} caracteres"
     * )
     * @Assert\Regex(
     *     pattern="#\d{3,8}-[\d|kK]{1}#",
     *     match=true,
     *     message="El formato del rut es incorrecto"
     * )
     */
    private $rutUsuario;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=false)
     * @Assert\NotBlank
     * @Assert\NotNull
     * @Assert\Regex(
     *     pattern="((?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[-@#$.%]).{6,20})",
     *     match=true,
     *     message="Tu contraseña no cumple con la seguridad apropiada, letras mayucula, letras minuscula, caracteres espaciales, numero y minimo 8 caracteres"
     * )
     */
    private $password;

    /**
     * @var \TblTiposUsuarios
     *
     * @ORM\ManyToOne(targetEntity="TblTiposUsuarios", inversedBy="usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_tipo_usuario", referencedColumnName="id")
     * })
     */
    private $idTipoUsuario;

    /**
     * @ORM\OneToMany(targetEntity="TblFarmacias", mappedBy="idFarmacia")
     */
    private $farmacia;

    /**
     * @ORM\OneToMany(targetEntity="TblIsp", mappedBy="idIsp")
     */
    private $isp;

    /**
     * @ORM\OneToMany(targetEntity="TblMedicos", mappedBy="idMedico")
     */
    private $medico;

    /**
     * @ORM\OneToMany(targetEntity="TblPacientes", mappedBy="idPaciente")
     */
    private $paciente;

    public function __construct()
    {
        $this->farmacia = new ArrayCollection();
        $this->isp = new ArrayCollection();
        $this->medico = new ArrayCollection();
        $this->paciente = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRutUsuario(): ?string
    {
        return $this->rutUsuario;
    }

    public function setRutUsuario(string $rutUsuario): self
    {
        $this->rutUsuario = $rutUsuario;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getIdTipoUsuario(): ?TblTiposUsuarios
    {
        return $this->idTipoUsuario;
    }

    public function setIdTipoUsuario(?TblTiposUsuarios $idTipoUsuario): self
    {
        $this->idTipoUsuario = $idTipoUsuario;

        return $this;
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
            'rut_usuario' => $this->getRutUsuario(),
            'id_tipo_usuario' => $this->getIdTipoUsuario(),
            'farmacia' => $this->getFarmacia(),
            'isp' => $this->getIsp(),
            'medico' => $this->getMedico(),
            'paciente' => $this->getPaciente()
        ];
    }

}
