<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * TblEstablecimiento
 *
 * @ORM\Table(name="tbl_establecimientos", uniqueConstraints={@ORM\UniqueConstraint(name="id", columns={"id"}), @ORM\UniqueConstraint(name="rut_establecimiento", columns={"rut_establecimiento"})}, indexes={@ORM\Index(name="fk_tblestablecimientos_tblcomunas", columns={"id_comuna"}), @ORM\Index(name="fk_tblestablecimientos_tblimagenes", columns={"id_imagen"})})
 * @ORM\Entity
 */
class TblEstablecimientos implements \JsonSerializable
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
     * @ORM\Column(name="rut_establecimiento", type="string", length=255, nullable=false)
     */
    private $rutEstablecimiento;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_establecimiento", type="string", length=255, nullable=false)
     */
    private $nombreEstablecimiento;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion_establecimiento", type="string", length=255, nullable=false)
     */
    private $direccionEstablecimiento;

    /**
     * @var string
     *
     * @ORM\Column(name="fono_establecimiento", type="string", length=15, nullable=false)
     */
    private $fonoEstablecimiento;

    /**
     * @var string
     *
     * @ORM\Column(name="email_establecimiento", type="string", length=100, nullable=false)
     */
    private $emailEstablecimiento;

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
     * @ORM\ManyToOne(targetEntity="TblComunas", inversedBy="establecimiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_comuna", referencedColumnName="id")
     * })
     */
    private $idComuna;

    /**
     * @var \TblImagenes
     *
     * @ORM\ManyToOne(targetEntity="TblImagenes", inversedBy="establecimiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_imagen", referencedColumnName="id")
     * })
     */
    private $idImagen;

    /**
     * @ORM\OneToMany(targetEntity="TblMedicos", mappedBy="idEstablecimiento")
     */
    private $medico;

    public function __construct()
    {
        $this->medico = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRutEstablecimiento(): ?string
    {
        return $this->rutEstablecimiento;
    }

    public function setRutEstablecimiento(string $rutEstablecimiento): self
    {
        $this->rutEstablecimiento = $rutEstablecimiento;

        return $this;
    }

    public function getNombreEstablecimiento(): ?string
    {
        return $this->nombreEstablecimiento;
    }

    public function setNombreEstablecimiento(string $nombreEstablecimiento): self
    {
        $this->nombreEstablecimiento = $nombreEstablecimiento;

        return $this;
    }

    public function getDireccionEstablecimiento(): ?string
    {
        return $this->direccionEstablecimiento;
    }

    public function setDireccionEstablecimiento(string $direccionEstablecimiento): self
    {
        $this->direccionEstablecimiento = $direccionEstablecimiento;

        return $this;
    }

    public function getFonoEstablecimiento(): ?string
    {
        return $this->fonoEstablecimiento;
    }

    public function setFonoEstablecimiento(string $fonoEstablecimiento): self
    {
        $this->fonoEstablecimiento = $fonoEstablecimiento;

        return $this;
    }

    public function getEmailEstablecimiento(): ?string
    {
        return $this->emailEstablecimiento;
    }

    public function setEmailEstablecimiento(string $emailEstablecimiento): self
    {
        $this->emailEstablecimiento = $emailEstablecimiento;

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

    public function getIdImagen(): ?TblImagenes
    {
        return $this->idImagen;
    }

    public function setIdImagen(?TblImagenes $idImagen): self
    {
        $this->idImagen = $idImagen;

        return $this;
    }

    /**
     * @return Collection|TblMedicos[]
     */
    public function getMedico(): Collection
    {
        return $this->medico;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'rut_establecimiento' => $this->getRutEstablecimiento(),
            'nombre_establecimiento' => $this->getNombreEstablecimiento(),
            'direccion_establecimiento' => $this->getDireccionEstablecimiento(),
            'id_comuna' => $this->getIdComuna(),
            'fono_establecimiento' => $this->getFonoEstablecimiento(),
            'email_establecimiento' => $this->getEmailEstablecimiento(),
            'id_imagen' => $this->getIdImagen(),
            'created_at' => $this->getCreatedAt(),
            'updated_at' => $this->getUpdatedAt(),
            'medico' => $this->getMedico()
        ];
    }

}
