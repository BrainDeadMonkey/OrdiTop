<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rubrique
 *
 * @ORM\Table(name="rubrique")
 * @ORM\Entity
 */
class Rubrique
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_rubrique", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idRubrique;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_rubrique", type="string", length=30, nullable=false)
     */
    private $nomRubrique;

    public function getIdRubrique(): ?int
    {
        return $this->idRubrique;
    }

    public function getNomRubrique(): ?string
    {
        return $this->nomRubrique;
    }

    public function setNomRubrique(string $nomRubrique): self
    {
        $this->nomRubrique = $nomRubrique;

        return $this;
    }


}
