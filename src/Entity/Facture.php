<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Facture
 *
 * @ORM\Table(name="facture", indexes={@ORM\Index(name="fk_facture_commande1_idx", columns={"id_commande"})})
 * @ORM\Entity
 */
class Facture
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_facture", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idFacture;

    /**
     * @var int|null
     *
     * @ORM\Column(name="tva_facture", type="integer", nullable=true)
     */
    private $tvaFacture;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ht_facture", type="decimal", precision=19, scale=4, nullable=true)
     */
    private $htFacture;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ttc_facture", type="decimal", precision=19, scale=4, nullable=true)
     */
    private $ttcFacture;

    /**
     * @var string|null
     *
     * @ORM\Column(name="reduction_facture", type="string", length=45, nullable=true)
     */
    private $reductionFacture;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date_facture", type="datetime", nullable=true)
     */
    private $dateFacture;

    /**
     * @var \Commande
     *
     * @ORM\ManyToOne(targetEntity="Commande")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_commande", referencedColumnName="id_commande")
     * })
     */
    private $idCommande;

    public function getIdFacture(): ?int
    {
        return $this->idFacture;
    }

    public function getTvaFacture(): ?int
    {
        return $this->tvaFacture;
    }

    public function setTvaFacture(?int $tvaFacture): self
    {
        $this->tvaFacture = $tvaFacture;

        return $this;
    }

    public function getHtFacture(): ?string
    {
        return $this->htFacture;
    }

    public function setHtFacture(?string $htFacture): self
    {
        $this->htFacture = $htFacture;

        return $this;
    }

    public function getTtcFacture(): ?string
    {
        return $this->ttcFacture;
    }

    public function setTtcFacture(?string $ttcFacture): self
    {
        $this->ttcFacture = $ttcFacture;

        return $this;
    }

    public function getReductionFacture(): ?string
    {
        return $this->reductionFacture;
    }

    public function setReductionFacture(?string $reductionFacture): self
    {
        $this->reductionFacture = $reductionFacture;

        return $this;
    }

    public function getDateFacture(): ?\DateTimeInterface
    {
        return $this->dateFacture;
    }

    public function setDateFacture(?\DateTimeInterface $dateFacture): self
    {
        $this->dateFacture = $dateFacture;

        return $this;
    }

    public function getIdCommande(): ?Commande
    {
        return $this->idCommande;
    }

    public function setIdCommande(?Commande $idCommande): self
    {
        $this->idCommande = $idCommande;

        return $this;
    }


}
