<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TblTiposUsuarios
 *
 * @ORM\Table(name="tbl_tipos_usuarios", uniqueConstraints={@ORM\UniqueConstraint(name="id", columns={"id"})})
 * @ORM\Entity
 */
class TblTiposUsuarios
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


}
