<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TblFarmacias
 *
 * @ORM\Table(name="tbl_farmacias", uniqueConstraints={@ORM\UniqueConstraint(name="id", columns={"id"})}, indexes={@ORM\Index(name="fk_tblfarmacias_tblcomunas", columns={"id_comuna"}), @ORM\Index(name="fk_tblfarmacias_tblimagenes", columns={"id_imagen"}), @ORM\Index(name="fk_tblfarmacias_tblusuarios", columns={"id_farmacia"})})
 * @ORM\Entity
 */
class TblFarmacias
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
     * @ORM\Column(name="nombre_farmacia", type="string", length=255, nullable=false)
     */
    private $nombreFarmacia;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion_farmacia", type="string", length=255, nullable=false)
     */
    private $direccionFarmacia;

    /**
     * @var string
     *
     * @ORM\Column(name="fono_farmacia", type="string", length=255, nullable=false)
     */
    private $fonoFarmacia;

    /**
     * @var string
     *
     * @ORM\Column(name="email_farmacia", type="string", length=255, nullable=false)
     */
    private $emailFarmacia;

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
     * @var \TblImagenes
     *
     * @ORM\ManyToOne(targetEntity="TblImagenes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_imagen", referencedColumnName="id")
     * })
     */
    private $idImagen;

    /**
     * @var \TblUsuarios
     *
     * @ORM\ManyToOne(targetEntity="TblUsuarios")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_farmacia", referencedColumnName="id")
     * })
     */
    private $idFarmacia;


}
