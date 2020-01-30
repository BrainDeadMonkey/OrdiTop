<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Commande
 *
 * @ORM\Table(name="commande", indexes={@ORM\Index(name="fk_commande_adresse1_idx", columns={"id_adresse_facture"}), @ORM\Index(name="fk_commande_adresse2_idx", columns={"id_adresse_livraison"}), @ORM\Index(name="fk_commande_client1_idx", columns={"id_client"})})
 * @ORM\Entity
 */
class Commande
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_commande", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCommande;

    /**
     * @var int
     *
     * @ORM\Column(name="nombre_article_total", type="integer", nullable=false)
     */
    private $nombreArticleTotal;

    /**
     * @var int|null
     *
     * @ORM\Column(name="reduction_customer", type="integer", nullable=true)
     */
    private $reductionCustomer;

    /**
     * @var string
     *
     * @ORM\Column(name="prix_livraison", type="decimal", precision=19, scale=4, nullable=false)
     */
    private $prixLivraison;

    /**
     * @var string
     *
     * @ORM\Column(name="prix_total", type="decimal", precision=19, scale=4, nullable=false)
     */
    private $prixTotal;

    /**
     * @var string
     *
     * @ORM\Column(name="mode_livraison", type="string", length=45, nullable=false)
     */
    private $modeLivraison;

    /**
     * @var string
     *
     * @ORM\Column(name="mode_paiement", type="string", length=45, nullable=false)
     */
    private $modePaiement;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_commande", type="datetime", nullable=false, options={"default": "CURRENT_TIMESTAMP"})
     */
    private $dateCommande;

    /**
     * @var string
     *
     * @ORM\Column(name="statut_commande", type="string", length=45, nullable=false)
     */
    private $statutCommande;

    /**
     * @var \Adresse
     *
     * @ORM\ManyToOne(targetEntity="Adresse")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_adresse_facture", referencedColumnName="id_adresse")
     * })
     */
    private $idAdresseFacture;

    /**
     * @var \Adresse
     *
     * @ORM\ManyToOne(targetEntity="Adresse")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_adresse_livraison", referencedColumnName="id_adresse")
     * })
     */
    private $idAdresseLivraison;

    /**
     * @var \Client
     *
     * @ORM\ManyToOne(targetEntity="Client")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_client", referencedColumnName="id_client")
     * })
     */
    private $idClient;

    

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idArticle = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getIdCommande(): ?int
    {
        return $this->idCommande;
    }

    public function getNombreArticleTotal(): ?int
    {
        return $this->nombreArticleTotal;
    }

    public function setNombreArticleTotal(int $nombreArticleTotal): self
    {
        $this->nombreArticleTotal = $nombreArticleTotal;

        return $this;
    }

    public function getReductionCustomer(): ?int
    {
        return $this->reductionCustomer;
    }

    public function setReductionCustomer(?int $reductionCustomer): self
    {
        $this->reductionCustomer = $reductionCustomer;

        return $this;
    }

    public function getPrixLivraison(): ?string
    {
        return $this->prixLivraison;
    }

    public function setPrixLivraison(string $prixLivraison): self
    {
        $this->prixLivraison = $prixLivraison;

        return $this;
    }

    public function getPrixTotal(): ?string
    {
        return $this->prixTotal;
    }

    public function setPrixTotal(string $prixTotal): self
    {
        $this->prixTotal = $prixTotal;

        return $this;
    }

    public function getModeLivraison(): ?string
    {
        return $this->modeLivraison;
    }

    public function setModeLivraison(string $modeLivraison): self
    {
        $this->modeLivraison = $modeLivraison;

        return $this;
    }

    public function getModePaiement(): ?string
    {
        return $this->modePaiement;
    }

    public function setModePaiement(string $modePaiement): self
    {
        $this->modePaiement = $modePaiement;

        return $this;
    }

    public function getDateCommande(): ?\DateTimeInterface
    {
        return $this->dateCommande;
    }

    public function setDateCommande(\DateTimeInterface $dateCommande): self
    {
        $this->dateCommande = $dateCommande;

        return $this;
    }

    public function getStatutCommande(): ?string
    {
        return $this->statutCommande;
    }

    public function setStatutCommande(string $statutCommande): self
    {
        $this->statutCommande = $statutCommande;

        return $this;
    }

    public function getIdAdresseFacture(): ?Adresse
    {
        return $this->idAdresseFacture;
    }

    public function setIdAdresseFacture(?Adresse $idAdresseFacture): self
    {
        $this->idAdresseFacture = $idAdresseFacture;

        return $this;
    }

    public function getIdAdresseLivraison(): ?Adresse
    {
        return $this->idAdresseLivraison;
    }

    public function setIdAdresseLivraison(?Adresse $idAdresseLivraison): self
    {
        $this->idAdresseLivraison = $idAdresseLivraison;

        return $this;
    }

    public function getIdClient(): ?Client
    {
        return $this->idClient;
    }

    public function setIdClient(?Client $idClient): self
    {
        $this->idClient = $idClient;

        return $this;
    }

}
