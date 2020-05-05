<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TblEspecialidades
 *
 * @ORM\Table(name="tbl_especialidades", uniqueConstraints={@ORM\UniqueConstraint(name="id", columns={"id"})})
 * @ORM\Entity
 */
class TblEspecialidades
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
     * @ORM\Column(name="especialidad", type="string", length=255, nullable=false)
     */
    private $especialidad;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEspecialidad(): ?string
    {
        return $this->especialidad;
    }

    public function setEspecialidad(string $especialidad): self
    {
        $this->especialidad = $especialidad;

        return $this;
    }


}
