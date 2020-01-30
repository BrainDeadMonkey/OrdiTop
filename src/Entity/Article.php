<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Article
 *
 * @ORM\Table(name="article", indexes={@ORM\Index(name="fk_article_fabricant1_idx", columns={"id_fabricant"}), @ORM\Index(name="fk_article_sous_rubrique1_idx", columns={"id_sous_rubrique"})})
 * @ORM\Entity(repositoryClass="App\Repository\SearchRepository")
 */
class Article
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_article", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idArticle;

    /**
     * @var string
     *
     * @ORM\Column(name="model_article", type="string", length=60, nullable=false)
     */
    private $modelArticle;

    /**
     * @var string|null
     *
     * @ORM\Column(name="description_article", type="text", length=255, nullable=true)
     */
    private $descriptionArticle;

    /**
     * @var string
     *
     * @ORM\Column(name="prix_article", type="decimal", precision=19, scale=4, nullable=false)
     */
    private $prixArticle;

    /**
     * @var int|null
     *
     * @ORM\Column(name="stock_article", type="integer", nullable=true)
     */
    private $stockArticle;

    /**
     * @var string|null
     *
     * @ORM\Column(name="main_image", type="string", length=300, nullable=true)
     */
    private $mainImage;

    /**
     * @var \Fabricant
     *
     * @ORM\ManyToOne(targetEntity="Fabricant")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_fabricant", referencedColumnName="id_fabricant")
     * })
     */
    private $idFabricant;

    /**
     * @var \SousRubrique
     *
     * @ORM\ManyToOne(targetEntity="SousRubrique")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_sous_rubrique", referencedColumnName="id_sous_rubrique")
     * })
     */
    private $idSousRubrique;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idCommande = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getIdArticle(): ?int
    {
        return $this->idArticle;
    }

    public function getModelArticle(): ?string
    {
        return $this->modelArticle;
    }

    public function setModelArticle(string $modelArticle): self
    {
        $this->modelArticle = $modelArticle;

        return $this;
    }

    public function getDescriptionArticle(): ?string
    {
        return $this->descriptionArticle;
    }

    public function setDescriptionArticle(?string $descriptionArticle): self
    {
        $this->descriptionArticle = $descriptionArticle;

        return $this;
    }

    public function getPrixArticle(): ?string
    {
        return $this->prixArticle;
    }

    public function setPrixArticle(string $prixArticle): self
    {
        $this->prixArticle = $prixArticle;

        return $this;
    }

    public function getStockArticle(): ?int
    {
        return $this->stockArticle;
    }

    public function setStockArticle(?int $stockArticle): self
    {
        $this->stockArticle = $stockArticle;

        return $this;
    }

    public function getMainImage(): ?string
    {
        return $this->mainImage;
    }

    public function setMainImage(?string $mainImage): self
    {
        $this->mainImage = $mainImage;

        return $this;
    }

    public function getIdFabricant(): ?Fabricant
    {
        return $this->idFabricant;
    }

    public function setIdFabricant(?Fabricant $idFabricant): self
    {
        $this->idFabricant = $idFabricant;

        return $this;
    }

    public function getIdSousRubrique(): ?SousRubrique
    {
        return $this->idSousRubrique;
    }

    public function setIdSousRubrique(?SousRubrique $idSousRubrique): self
    {
        $this->idSousRubrique = $idSousRubrique;

        return $this;
    }

    

}
