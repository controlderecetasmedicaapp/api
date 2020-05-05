<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * TblIsp
 *
 * @ORM\Table(name="tbl_isp", uniqueConstraints={@ORM\UniqueConstraint(name="id", columns={"id"})}, indexes={@ORM\Index(name="fk_tblIsp_tblcomunas", columns={"id_comuna"}), @ORM\Index(name="fk_tblIsp_tblusuarios", columns={"id_isp"})})
 * @ORM\Entity
 */
class TblIsp implements \JsonSerializable
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
     * @ORM\Column(name="nombre_isp", type="string", length=255, nullable=false)
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
    private $nombreIsp;

    /**
     * @var string
     *
     * @ORM\Column(name="apellido_isp", type="string", length=255, nullable=false)
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
    private $apellidoIsp;

    /**
     * @var string
     *
     * @ORM\Column(name="direcicon_isp", type="string", length=255, nullable=false)
     */
    private $direccionIsp;

    /**
     * @var string
     *
     * @ORM\Column(name="fono_isp", type="string", length=255, nullable=false)
     */
    private $fonoIsp;

    /**
     * @var string
     *
     * @ORM\Column(name="email_isp", type="string", length=255, nullable=false)
     * @Assert\NotBlank
     * @Assert\NotNull
     * @Assert\Email(
     *     message = "El email '{{ value }}' no es un email valido"
     * )
     */
    private $emailIsp;

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
     * @ORM\ManyToOne(targetEntity="TblComunas", inversedBy="isp")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_comuna", referencedColumnName="id")
     * })
     */
    private $idComuna;

    /**
     * @var \TblUsuarios
     *
     * @ORM\ManyToOne(targetEntity="TblUsuarios", inversedBy="isp")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_isp", referencedColumnName="id")
     * })
     */
    private $idIsp;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombreIsp(): ?string
    {
        return $this->nombreIsp;
    }

    public function setNombreIsp(string $nombreIsp): self
    {
        $this->nombreIsp = $nombreIsp;

        return $this;
    }

    public function getApellidoIsp(): ?string
    {
        return $this->apellidoIsp;
    }

    public function setApellidoIsp(string $apellidoIsp): self
    {
        $this->apellidoIsp = $apellidoIsp;

        return $this;
    }

    public function getDireccionIsp(): ?string
    {
        return $this->direccionIsp;
    }

    public function setDireccionIsp(string $direccionIsp): self
    {
        $this->direccionIsp = $direccionIsp;

        return $this;
    }

    public function getFonoIsp(): ?string
    {
        return $this->fonoIsp;
    }

    public function setFonoIsp(string $fonoIsp): self
    {
        $this->fonoIsp = $fonoIsp;

        return $this;
    }

    public function getEmailIsp(): ?string
    {
        return $this->emailIsp;
    }

    public function setEmailIsp(string $emailIsp): self
    {
        $this->emailIsp = $emailIsp;

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

    public function getIdIsp(): ?TblUsuarios
    {
        return $this->idIsp;
    }

    public function setIdIsp(?TblUsuarios $idIsp): self
    {
        $this->idIsp = $idIsp;

        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'id_isp' => $this->getIdIsp(),
            'nombre_isp' => $this->getNombreIsp(),
            'apellido_isp' => $this->getApellidoIsp(),
            'direccion_isp' => $this->getdireccionIsp(),
            'fono_isp' => $this->getFonoIsp(),
            'email_isp' => $this->getEmailIsp(),
            'id_comuna' => $this->getIdComuna(),
            'created_at' => $this->getCreatedAt(),
            'updated_at' => $this->getUpdatedAt()
        ];
    }
}
