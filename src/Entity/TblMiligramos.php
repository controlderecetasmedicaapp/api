<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TblMiligramos
 *
 * @ORM\Table(name="tbl_miligramos", uniqueConstraints={@ORM\UniqueConstraint(name="id", columns={"id"})}, indexes={@ORM\Index(name="fk_tblmiligramos_tblfarmacos", columns={"id_farmaco"})})
 * @ORM\Entity
 */
class TblMiligramos
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
     * @ORM\Column(name="miligramo", type="string", length=255, nullable=false)
     */
    private $miligramo;

    /**
     * @var \TblFarmacos
     *
     * @ORM\ManyToOne(targetEntity="TblFarmacos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_farmaco", referencedColumnName="id")
     * })
     */
    private $idFarmaco;


}
