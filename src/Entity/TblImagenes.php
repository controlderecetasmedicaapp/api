<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * TblImagenes
 *
 * @ORM\Table(name="tbl_imagenes", uniqueConstraints={@ORM\UniqueConstraint(name="id", columns={"id"})})
 * @ORM\Entity
 */
class TblImagenes implements \JsonSerializable
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
     * @ORM\Column(name="file0", type="string", length=255, nullable=false)
     */
    private $file0;

    /**
     * @ORM\OneToMany(targetEntity="TblEstablecimientos", mappedBy="idImagen")
     */
    private $establecimiento;

    /**
     * @ORM\OneToMany(targetEntity="TblFarmacias", mappedBy="idImagen")
     */
    private $farmacia;

    public function __construct()
    {
        $this->establecimiento = new ArrayCollection();
        $this->farmacia = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFile0(): ?string
    {
        return $this->file0;
    }

    public function setFile0(string $file0): self
    {
        $this->file0 = $file0;

        return $this;
    }

    /**
     * @return Collection|TblEstablecimientos[]
     */
    public function getEstablecimiento(): Collection
    {
        return $this->establecimiento;
    }

    /**
     * @return Collection|TblFarmacias[]
     */
    public function getFarmacia(): Collection
    {
        return $this->farmacia;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'file0' => $this->getFile0(),
            'establecimiento' => $this->getEstablecimiento(),
            'farmacia' => $this->getFarmacia()
        ];
    }

}
