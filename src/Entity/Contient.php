<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ContientRepository")
 */
class Contient
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Article")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="id_article", referencedColumnName="id_article")
     * })
     */
    private $id_article;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Commande")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="id_commande", referencedColumnName="id_commande")
     * })
     */
    private $id_commande;

    /**
     * @ORM\Column(type="integer")
     */
    private $nombre_article;

    /**
     * @ORM\Column(type="decimal", precision=23, scale=4)
     */
    private $prix_article;

    /**
     * @ORM\Column(type="decimal", precision=23, scale=4)
     */
    private $prix_article_tva;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdArticle(): ?Article
    {
        return $this->id_article;
    }

    public function setIdArticle(?Article $id_article): self
    {
        $this->id_article = $id_article;

        return $this;
    }

    public function getIdCommande(): ?Commande
    {
        return $this->id_commande;
    }

    public function setIdCommande(?Commande $id_commande): self
    {
        $this->id_commande = $id_commande;

        return $this;
    }

    public function getNombreArticle(): ?int
    {
        return $this->nombre_article;
    }

    public function setNombreArticle(int $nombre_article): self
    {
        $this->nombre_article = $nombre_article;

        return $this;
    }

    public function getPrixArticle(): ?string
    {
        return $this->prix_article;
    }

    public function setPrixArticle(string $prix_article): self
    {
        $this->prix_article = $prix_article;

        return $this;
    }

    public function getPrixArticleTva(): ?string
    {
        return $this->prix_article_tva;
    }

    public function setPrixArticleTva(string $prix_article_tva): self
    {
        $this->prix_article_tva = $prix_article_tva;

        return $this;
    }
}
