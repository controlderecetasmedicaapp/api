<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * TblTiposUsuarios
 *
 * @ORM\Table(name="tbl_tipos_usuarios", uniqueConstraints={@ORM\UniqueConstraint(name="id", columns={"id"})})
 * @ORM\Entity
 */
class TblTiposUsuarios implements \JsonSerializable
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
     * @ORM\Column(name="tipo_usuario", type="string", length=255, nullable=false)
     */
    private $tipoUsuario;

    /**
     * @ORM\OneToMany(targetEntity="TblUsuarios", mappedBy="idTipoUsuario")
     */
    private $usuario;

    public function __construct()
    {
        $this->usuario = new  ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTipoUsuario(): ?string
    {
        return $this->tipoUsuario;
    }

    public function setTipoUsuario(string $tipoUsuario): self
    {
        $this->tipoUsuario = $tipoUsuario;

        return $this;
    }

    /**
     * @return Collection|TblUsuarios[]
     */
    public function getUsuario(): Collection
    {
        return $this->usuario;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'tipo_usuario' => $this->getTipoUsuario(),
            'usuario' => $this->getUsuario()
        ];
    }
}
