<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TblSexo
 *
 * @ORM\Table(name="tbl_sexo", uniqueConstraints={@ORM\UniqueConstraint(name="id", columns={"id"})})
 * @ORM\Entity
 */
class TblSexo
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


}
