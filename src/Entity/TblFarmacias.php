<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TblFarmacias
 *
 * @ORM\Table(name="tbl_farmacias", uniqueConstraints={@ORM\UniqueConstraint(name="id", columns={"id"})}, indexes={@ORM\Index(name="fk_tblfarmacias_tblcomunas", columns={"id_comuna"}), @ORM\Index(name="fk_tblfarmacias_tblimagenes", columns={"id_imagen"}), @ORM\Index(name="fk_tblfarmacias_tblusuarios", columns={"id_farmacia"})})
 * @ORM\Entity
 */
class TblFarmacias
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
     * @ORM\Column(name="nombre_farmacia", type="string", length=255, nullable=false)
     */
    private $nombreFarmacia;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion_farmacia", type="string", length=255, nullable=false)
     */
    private $direccionFarmacia;

    /**
     * @var string
     *
     * @ORM\Column(name="fono_farmacia", type="string", length=255, nullable=false)
     */
    private $fonoFarmacia;

    /**
     * @var string
     *
     * @ORM\Column(name="email_farmacia", type="string", length=255, nullable=false)
     */
    private $emailFarmacia;

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
     * @var \TblImagenes
     *
     * @ORM\ManyToOne(targetEntity="TblImagenes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_imagen", referencedColumnName="id")
     * })
     */
    private $idImagen;

    /**
     * @var \TblUsuarios
     *
     * @ORM\ManyToOne(targetEntity="TblUsuarios")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_farmacia", referencedColumnName="id")
     * })
     */
    private $idFarmacia;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombreFarmacia(): ?string
    {
        return $this->nombreFarmacia;
    }

    public function setNombreFarmacia(string $nombreFarmacia): self
    {
        $this->nombreFarmacia = $nombreFarmacia;

        return $this;
    }

    public function getDireccionFarmacia(): ?string
    {
        return $this->direccionFarmacia;
    }

    public function setDireccionFarmacia(string $direccionFarmacia): self
    {
        $this->direccionFarmacia = $direccionFarmacia;

        return $this;
    }

    public function getFonoFarmacia(): ?string
    {
        return $this->fonoFarmacia;
    }

    public function setFonoFarmacia(string $fonoFarmacia): self
    {
        $this->fonoFarmacia = $fonoFarmacia;

        return $this;
    }

    public function getEmailFarmacia(): ?string
    {
        return $this->emailFarmacia;
    }

    public function setEmailFarmacia(string $emailFarmacia): self
    {
        $this->emailFarmacia = $emailFarmacia;

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

    public function getIdFarmacia(): ?TblUsuarios
    {
        return $this->idFarmacia;
    }

    public function setIdFarmacia(?TblUsuarios $idFarmacia): self
    {
        $this->idFarmacia = $idFarmacia;

        return $this;
    }


}
