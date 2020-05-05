<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TblIsp
 *
 * @ORM\Table(name="tbl_isp", uniqueConstraints={@ORM\UniqueConstraint(name="id", columns={"id"})}, indexes={@ORM\Index(name="fk_tblIsp_tblcomunas", columns={"id_comuna"}), @ORM\Index(name="fk_tblIsp_tblusuarios", columns={"id_isp"})})
 * @ORM\Entity
 */
class TblIsp
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
     */
    private $nombreIsp;

    /**
     * @var string
     *
     * @ORM\Column(name="apellido_isp", type="string", length=255, nullable=false)
     */
    private $apellidoIsp;

    /**
     * @var string
     *
     * @ORM\Column(name="direcicon_isp", type="string", length=255, nullable=false)
     */
    private $direciconIsp;

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
     * @ORM\ManyToOne(targetEntity="TblComunas")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_comuna", referencedColumnName="id")
     * })
     */
    private $idComuna;

    /**
     * @var \TblUsuarios
     *
     * @ORM\ManyToOne(targetEntity="TblUsuarios")
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

    public function getDireciconIsp(): ?string
    {
        return $this->direciconIsp;
    }

    public function setDireciconIsp(string $direciconIsp): self
    {
        $this->direciconIsp = $direciconIsp;

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


}
