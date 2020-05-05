<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TblIsp
 *
 * @ORM\Table(name="tbl_isp", uniqueConstraints={@ORM\UniqueConstraint(name="id", columns={"id"})}, indexes={@ORM\Index(name="fk_tblIsp_tblcomunas", columns={"id_comuna"}), @ORM\Index(name="fk_tblIsp_tblusuarios", columns={"id_isp"})})
 * @ORM\Entity
 */
class TblIsp
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
     * @ORM\Column(name="nombre_isp", type="string", length=255, nullable=false)
     */
    private $nombreIsp;

    /**
     * @var string
     *
     * @ORM\Column(name="apellido_isp", type="string", length=255, nullable=false)
     */
    private $apellidoIsp;

    /**
     * @var string
     *
     * @ORM\Column(name="direcicon_isp", type="string", length=255, nullable=false)
     */
    private $direciconIsp;

    /**
     * @var string
     *
     * @ORM\Column(name="fono_isp", type="string", length=255, nullable=false)
     */
    private $fonoIsp;

    /**
     * @var string
     *
     * @ORM\Column(name="email_isp", type="string", length=255, nullable=false)
     */
    private $emailIsp;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=false)
     */
    private $updatedAt;

    /**
     * @var \TblComunas
     *
     * @ORM\ManyToOne(targetEntity="TblComunas")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_comuna", referencedColumnName="id")
     * })
     */
    private $idComuna;

    /**
     * @var \TblUsuarios
     *
     * @ORM\ManyToOne(targetEntity="TblUsuarios")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_isp", referencedColumnName="id")
     * })
     */
    private $idIsp;


}
