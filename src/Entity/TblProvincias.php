<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * TblProvincias
 *
 * @ORM\Table(name="tbl_provincias", uniqueConstraints={@ORM\UniqueConstraint(name="id", columns={"id"})})
 * @ORM\Entity
 */
class TblProvincias implements \JsonSerializable
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
     * @ORM\Column(name="provincia", type="string", length=255, nullable=false)
     */
    private $provincia;

    /**
     * @ORM\OneToMany(targetEntity="TblComunas", mappedBy="idProvincia")
     */
    private $comuna;

    public function __construct()
    {
        $this->comuna = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProvincia(): ?string
    {
        return $this->provincia;
    }

    public function setProvincia(string $provincia): self
    {
        $this->provincia = $provincia;

        return $this;
    }

    /**
     * @return Collection|TblComunas[]
     */
    public function getComuna(): Collection
    {
        return $this->comuna;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'provincia' => $this->getProvincia(),
            'comuna' => $this->getComuna()
        ];
    }

}
