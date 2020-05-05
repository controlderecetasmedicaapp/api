<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TblFarmacos
 *
 * @ORM\Table(name="tbl_farmacos", uniqueConstraints={@ORM\UniqueConstraint(name="id", columns={"id"})}, indexes={@ORM\Index(name="fk_tblfarmacos_tbltiposprescripciones", columns={"id_tipo_prescripcion"})})
 * @ORM\Entity
 */
class TblFarmacos
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
     * @ORM\Column(name="nombre_farmaco", type="string", length=255, nullable=false)
     */
    private $nombreFarmaco;

    /**
     * @var \TblTiposPrescripciones
     *
     * @ORM\ManyToOne(targetEntity="TblTiposPrescripciones")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_tipo_prescripcion", referencedColumnName="id")
     * })
     */
    private $idTipoPrescripcion;


}
