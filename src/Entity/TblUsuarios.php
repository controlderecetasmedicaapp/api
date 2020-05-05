<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TblUsuarios
 *
 * @ORM\Table(name="tbl_usuarios", uniqueConstraints={@ORM\UniqueConstraint(name="id", columns={"id"})}, indexes={@ORM\Index(name="fk_tblusuarios_tbltipousuarios", columns={"id_tipo_usuario"})})
 * @ORM\Entity
 */
class TblUsuarios
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
     * @ORM\Column(name="rut_usuario", type="string", length=255, nullable=false)
     */
    private $rutUsuario;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=false)
     */
    private $password;

    /**
     * @var \TblTiposUsuarios
     *
     * @ORM\ManyToOne(targetEntity="TblTiposUsuarios")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_tipo_usuario", referencedColumnName="id")
     * })
     */
    private $idTipoUsuario;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRutUsuario(): ?string
    {
        return $this->rutUsuario;
    }

    public function setRutUsuario(string $rutUsuario): self
    {
        $this->rutUsuario = $rutUsuario;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getIdTipoUsuario(): ?TblTiposUsuarios
    {
        return $this->idTipoUsuario;
    }

    public function setIdTipoUsuario(?TblTiposUsuarios $idTipoUsuario): self
    {
        $this->idTipoUsuario = $idTipoUsuario;

        return $this;
    }


}