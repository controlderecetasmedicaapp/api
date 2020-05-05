<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TblProvincias
 *
 * @ORM\Table(name="tbl_provincias", uniqueConstraints={@ORM\UniqueConstraint(name="id", columns={"id"})})
 * @ORM\Entity
 */
class TblProvincias
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


}
