<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TblEstadoPrescripcion
 *
 * @ORM\Table(name="tbl_estado_prescripcion", uniqueConstraints={@ORM\UniqueConstraint(name="estado", columns={"estado"}), @ORM\UniqueConstraint(name="id", columns={"id"})})
 * @ORM\Entity
 */
class TblEstadoPrescripcion
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
     * @ORM\Column(name="estado", type="string", length=255, nullable=false)
     */
    private $estado;


}
