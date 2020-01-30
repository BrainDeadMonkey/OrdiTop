<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commercial
 *
 * @ORM\Table(name="commercial", indexes={@ORM\Index(name="fk_commercial_User1_idx", columns={"User_id"})})
 * @ORM\Entity
 */
class Commercial
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_commercial", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCommercial;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_commercial", type="string", length=45, nullable=false)
     */
    private $nomCommercial;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="create_commercial", type="datetime", nullable=false)
     */
    private $createCommercial;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="User_id", referencedColumnName="id")
     * })
     */
    private $user;

    public function getIdCommercial(): ?int
    {
        return $this->idCommercial;
    }

    public function getNomCommercial(): ?string
    {
        return $this->nomCommercial;
    }

    public function setNomCommercial(string $nomCommercial): self
    {
        $this->nomCommercial = $nomCommercial;

        return $this;
    }

    public function getCreateCommercial(): ?\DateTimeInterface
    {
        return $this->createCommercial;
    }

    public function setCreateCommercial(\DateTimeInterface $createCommercial): self
    {
        $this->createCommercial = $createCommercial;

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


}
