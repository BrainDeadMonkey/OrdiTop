<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fabricant
 *
 * @ORM\Table(name="fabricant")
 * @ORM\Entity
 */
class Fabricant
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_fabricant", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idFabricant;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_fabricant", type="string", length=45, nullable=false)
     */
    private $nomFabricant;

    public function getIdFabricant(): ?int
    {
        return $this->idFabricant;
    }

    public function getNomFabricant(): ?string
    {
        return $this->nomFabricant;
    }

    public function setNomFabricant(string $nomFabricant): self
    {
        $this->nomFabricant = $nomFabricant;

        return $this;
    }

    public function __toString()
    {
        return $this->nomFabricant;
    }
    
}
