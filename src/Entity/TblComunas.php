<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TblComunas
 *
 * @ORM\Table(name="tbl_comunas", uniqueConstraints={@ORM\UniqueConstraint(name="id", columns={"id"})}, indexes={@ORM\Index(name="fk_tblcomunas_tblprovincias", columns={"id_provincia"})})
 * @ORM\Entity
 */
class TblComunas
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
     * @ORM\Column(name="comuna", type="string", length=255, nullable=false)
     */
    private $comuna;

    /**
     * @var \TblProvincias
     *
     * @ORM\ManyToOne(targetEntity="TblProvincias")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_provincia", referencedColumnName="id")
     * })
     */
    private $idProvincia;


}
