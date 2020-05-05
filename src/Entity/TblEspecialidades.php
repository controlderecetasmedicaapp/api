<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * TblEspecialidades
 *
 * @ORM\Table(name="tbl_especialidades", uniqueConstraints={@ORM\UniqueConstraint(name="id", columns={"id"})})
 * @ORM\Entity
 */
class TblEspecialidades implements \JsonSerializable
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

    /**
     * @ORM\OneToMany(targetEntity="TblMedicos", mappedBy="idEspecialidad")
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

    public function getEspecialidad(): ?string
    {
        return $this->especialidad;
    }

    public function setEspecialidad(string $especialidad): self
    {
        $this->especialidad = $especialidad;

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
            'especialidad' => $this->getEspecialidad(),
            'medico' => $this->getMedico()
        ];
    }
}
