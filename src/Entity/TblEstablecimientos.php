<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TblEstablecimientos
 *
 * @ORM\Table(name="tbl_establecimientos", uniqueConstraints={@ORM\UniqueConstraint(name="id", columns={"id"}), @ORM\UniqueConstraint(name="rut_establecimiento", columns={"rut_establecimiento"})}, indexes={@ORM\Index(name="fk_tblestablecimientos_tblcomunas", columns={"id_comuna"}), @ORM\Index(name="fk_tblestablecimientos_tblimagenes", columns={"id_imagen"})})
 * @ORM\Entity
 */
class TblEstablecimientos
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
     * @ORM\Column(name="rut_establecimiento", type="string", length=255, nullable=false)
     */
    private $rutEstablecimiento;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_establecimiento", type="string", length=255, nullable=false)
     */
    private $nombreEstablecimiento;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion_establecimiento", type="string", length=255, nullable=false)
     */
    private $direccionEstablecimiento;

    /**
     * @var string
     *
     * @ORM\Column(name="fono_establecimiento", type="string", length=15, nullable=false)
     */
    private $fonoEstablecimiento;

    /**
     * @var string
     *
     * @ORM\Column(name="email_establecimiento", type="string", length=100, nullable=false)
     */
    private $emailEstablecimiento;

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


}
