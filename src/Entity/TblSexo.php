<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * TblSexo
 *
 * @ORM\Table(name="tbl_sexo", uniqueConstraints={@ORM\UniqueConstraint(name="id", columns={"id"})})
 * @ORM\Entity
 */
class TblSexo implements \JsonSerializable
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
     * @ORM\Column(name="sexo", type="string", length=255, nullable=false)
     */
    private $sexo;

    /**
     * @ORM\OneToMany(targetEntity="TblPacientes", mappedBy="idSexo")
     */
    private $paciente;

    public function __construct()
    {
        $this->paciente = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSexo(): ?string
    {
        return $this->sexo;
    }

    public function setSexo(string $sexo): self
    {
        $this->sexo = $sexo;

        return $this;
    }

    /**
     * @return Collection|TblPacientes[]
     */
    public function getPaciente(): Collection
    {
        return $this->paciente;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'sexo' => $this->getSexo(),
            'paciente' => $this->getPaciente()
        ];
    }

}
