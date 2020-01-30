<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Client
 *
 * @ORM\Table(name="client", indexes={@ORM\Index(name="fk_client_User1_idx", columns={"User_id"}), @ORM\Index(name="fk_customer_adresse1_idx", columns={"id_adresse"}), @ORM\Index(name="fk_customer_commercial1_idx", columns={"id_commercial"})})
 * @ORM\Entity
 */
class Client
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_client", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idClient;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_client", type="string", length=45, nullable=false)
     */
    private $nomClient;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom_client", type="string", length=45, nullable=false)
     */
    private $prenomClient;

    /**
     * @var string|null
     *
     * @ORM\Column(name="sex_client", type="string", length=1, nullable=true)
     */
    private $sexClient;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="naissance_client", type="date", nullable=false)
     */
    private $naissanceClient;

    /**
     * @var string|null
     *
     * @ORM\Column(name="coefficient_client", type="decimal", precision=6, scale=4, nullable=true)
     */
    private $coefficientClient;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="User_id", referencedColumnName="id")
     * })
     */
    private $user;

    /**
     * @var \Adresse
     *
     * @ORM\ManyToOne(targetEntity="Adresse")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_adresse", referencedColumnName="id_adresse")
     * })
     */
    private $idAdresse;

    /**
     * @var \Commercial
     *
     * @ORM\ManyToOne(targetEntity="Commercial")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_commercial", referencedColumnName="id_commercial")
     * })
     */
    private $idCommercial;

    public function getIdClient(): ?int
    {
        return $this->idClient;
    }

    public function getNomClient(): ?string
    {
        return $this->nomClient;
    }

    public function setNomClient(string $nomClient): self
    {
        $this->nomClient = $nomClient;

        return $this;
    }

    public function getPrenomClient(): ?string
    {
        return $this->prenomClient;
    }

    public function setPrenomClient(string $prenomClient): self
    {
        $this->prenomClient = $prenomClient;

        return $this;
    }

    public function getSexClient(): ?string
    {
        return $this->sexClient;
    }

    public function setSexClient(?string $sexClient): self
    {
        $this->sexClient = $sexClient;

        return $this;
    }

    public function getNaissanceClient(): ?\DateTimeInterface
    {
        return $this->naissanceClient;
    }

    public function setNaissanceClient(\DateTimeInterface $naissanceClient): self
    {
        $this->naissanceClient = $naissanceClient;

        return $this;
    }

    public function getCoefficientClient(): ?string
    {
        return $this->coefficientClient;
    }

    public function setCoefficientClient(?string $coefficientClient): self
    {
        $this->coefficientClient = $coefficientClient;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getIdAdresse(): ?Adresse
    {
        return $this->idAdresse;
    }

    public function setIdAdresse(?Adresse $idAdresse): self
    {
        $this->idAdresse = $idAdresse;

        return $this;
    }

    public function getIdCommercial(): ?Commercial
    {
        return $this->idCommercial;
    }

    public function setIdCommercial(?Commercial $idCommercial): self
    {
        $this->idCommercial = $idCommercial;

        return $this;
    }

    public function __toString()
    {
        return $this->nomClient;
    }

}
