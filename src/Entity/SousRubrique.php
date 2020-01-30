<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SousRubrique
 *
 * @ORM\Table(name="sous_rubrique", indexes={@ORM\Index(name="fk_sous_rubrique_rubrique1_idx", columns={"id_rubrique"})})
 * @ORM\Entity
 */
class SousRubrique
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_sous_rubrique", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idSousRubrique;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_sous_rubrique", type="string", length=30, nullable=false)
     */
    private $nomSousRubrique;

    /**
     * @var \Rubrique
     *
     * @ORM\ManyToOne(targetEntity="Rubrique")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_rubrique", referencedColumnName="id_rubrique")
     * })
     */
    private $idRubrique;

    public function getIdSousRubrique(): ?int
    {
        return $this->idSousRubrique;
    }

    public function getNomSousRubrique(): ?string
    {
        return $this->nomSousRubrique;
    }

    public function setNomSousRubrique(string $nomSousRubrique): self
    {
        $this->nomSousRubrique = $nomSousRubrique;

        return $this;
    }

    public function getIdRubrique(): ?Rubrique
    {
        return $this->idRubrique;
    }

    public function setIdRubrique(?Rubrique $idRubrique): self
    {
        $this->idRubrique = $idRubrique;

        return $this;
    }

    public function __toString()
    {
        return $this->nomSousRubrique;
    }

}
