<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * TblMedicos
 *
 * @ORM\Table(name="tbl_medicos", uniqueConstraints={@ORM\UniqueConstraint(name="id", columns={"id"})}, indexes={@ORM\Index(name="fk_tblmedicos_tblcomunas", columns={"id_comuna"}), @ORM\Index(name="fk_tblmedicos_tblespecialidades", columns={"id_especialidad"}), @ORM\Index(name="fk_tblmedicos_tblestablecimiento", columns={"id_establecimiento"}), @ORM\Index(name="fk_tblmedicos_tblusuarios", columns={"id_medico"})})
 * @ORM\Entity
 */
class TblMedicos implements \JsonSerializable
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
     * @Assert\NotBlank
     * @Assert\NotNull
     * @Assert\Regex(
     *     pattern="#^[A-Za-zÃ€-Ã¿ ,.'-]+$#",
     *     match=true,
     *     message="Tu nombre solo puede tener caracteres, no números"
     * )
     * @Assert\Length(
     *      min = 3,
     *      max = 20,
     *      minMessage = "Su nombre debe tener al menos {{ limit }} caracteres de longitud",
     *      maxMessage = "Su nombre no puede tener más de {{ limit }} caracteres"
     * )
     */
    private $nombreMedico;

    /**
     * @var string
     *
     * @ORM\Column(name="apellidos_medico", type="string", length=255, nullable=false)
     * @Assert\NotBlank
     * @Assert\NotNull
     * @Assert\Regex(
     *     pattern="#^[A-Za-zÃ€-Ã¿ ,.'-]+$#",
     *     match=true,
     *     message="Tus apellidos solo puede tener caracteres, no números"
     * )
     * @Assert\Length(
     *      min = 3,
     *      max = 20,
     *      minMessage = "Sus apellidos debe tener al menos {{ limit }} caracteres de longitud",
     *      maxMessage = "Sus apellidos no puede tener más de {{ limit }} caracteres"
     * )

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
     * @Assert\NotBlank
     * @Assert\NotNull
     * @Assert\Email(
     *     message = "El email '{{ value }}' no es un email valido"
     * )
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
     * @ORM\ManyToOne(targetEntity="TblComunas", inversedBy="medico")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_comuna", referencedColumnName="id")
     * })
     */
    private $idComuna;

    /**
     * @var \TblEspecialidades
     *
     * @ORM\ManyToOne(targetEntity="TblEspecialidades", inversedBy="medico")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_especialidad", referencedColumnName="id")
     * })
     */
    private $idEspecialidad;

    /**
     * @var \TblEstablecimientos
     *
     * @ORM\ManyToOne(targetEntity="TblEstablecimientos", inversedBy="medico")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_establecimiento", referencedColumnName="id")
     * })
     */
    private $idEstablecimiento;

    /**
     * @var \TblUsuarios
     *
     * @ORM\ManyToOne(targetEntity="TblUsuarios", inversedBy="medico")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_medico", referencedColumnName="id")
     * })
     */
    private $idMedico;

    /**
     * @ORM\OneToMany(targetEntity="TblMedicosTratantes", mappedBy="idMedico")
     */
    private $medicoTratante;

    /**
     * @ORM\OneToMany(targetEntity="TblPrescripciones", mappedBy="idMedico")
     */
    private $prescripcion;

    public function __construct()
    {
        $this->medicoTratante = new ArrayCollection();
        $this->prescripcion = new ArrayCollection();
    }

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

    /**
     * @return Collection|TblMedicosTratantes[]
     */
    public function getMedicoTratante(): Collection
    {
        return $this->medicoTratante;
    }

    /**
     * @return Collection|TblPrescripciones[]
     */
    public function getPrescripcion(): Collection
    {
        return $this->prescripcion;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'id_medico' => $this->getIdMedico(),
            'rcm' => $this->getRcmMedico(),
            'nombre_medico' => $this->getNombreMedico(),
            'apellido_medico' => $this->getApellidosMedico(),
            'direccion_medico' => $this->getDireccionMedico(),
            'fono_medico' => $this->getFonoMedico(),
            'email_medico' => $this->getEmailMedico(),
            'id_comuna' => $this->getIdComuna(),
            'id_establecimiento' => $this->getIdEstablecimiento(),
            'id_especialidad' => $this->getIdEspecialidad(),
            'firma' => $this->getFirmaMedico(),
            'MedicoTratante' => $this->getMedicoTratante(),
            'prescripcion' => $this->getPrescripcion()
        ];
    }
}
