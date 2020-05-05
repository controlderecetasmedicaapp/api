<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TblImagenes
 *
 * @ORM\Table(name="tbl_imagenes", uniqueConstraints={@ORM\UniqueConstraint(name="id", columns={"id"})})
 * @ORM\Entity
 */
class TblImagenes
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
     * @ORM\Column(name="file0", type="string", length=255, nullable=false)
     */
    private $file0;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFile0(): ?string
    {
        return $this->file0;
    }

    public function setFile0(string $file0): self
    {
        $this->file0 = $file0;

        return $this;
    }


}
