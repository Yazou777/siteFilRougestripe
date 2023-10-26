<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ProduitRepository::class)]
#[ApiResource(
    normalizationContext: [ "groups" => ["read:product"]]
)]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(["read:product"])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(["read:product"])]
    private ?string $pro_nom = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 9, scale: 2, nullable: true)]
    #[Groups(["read:product"])]
    private ?string $pro_prix = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(["read:product"])]
    private ?string $pro_image = null;

    #[ORM\Column( nullable: true, type:Types::TEXT)]
    private ?string $pro_description = null;

    #[ORM\Column(nullable: true)]
    private ?int $pro_stkphy = null;

    #[ORM\Column(nullable: true)]
    private ?int $pro_stkale = null;

    #[ORM\ManyToOne(inversedBy: 'produits', targetEntity: Categorie::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?categorie $cat = null;

    #[ORM\OneToMany(mappedBy: 'pro', targetEntity: Vente::class)]
    private Collection $ventes;

    #[ORM\OneToMany(mappedBy: 'pan_pro', targetEntity: Panier::class)]
    private Collection $paniers;

    #[ORM\OneToMany(mappedBy: 'liv_pro', targetEntity: Livraison::class)]
    private Collection $livraisons;

    public function __construct()
    {
        $this->ventes = new ArrayCollection();
        $this->paniers = new ArrayCollection();
        $this->livraisons = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProNom(): ?string
    {
        return $this->pro_nom;
    }

    public function setProNom(string $pro_nom): static
    {
        $this->pro_nom = $pro_nom;

        return $this;
    }

    public function getProPrix(): ?string
    {
        return $this->pro_prix;
    }

    public function setProPrix(?string $pro_prix): static
    {
        $this->pro_prix = $pro_prix;

        return $this;
    }

    public function getProImage(): ?string
    {
        return $this->pro_image;
    }

    public function setProImage(?string $pro_image): static
    {
        $this->pro_image = $pro_image;

        return $this;
    }

    public function getProDescription(): ?string
    {
        return $this->pro_description;
    }

    public function setProDescription(?string $pro_description): static
    {
        $this->pro_description = $pro_description;

        return $this;
    }

    public function getProStkphy(): ?int
    {
        return $this->pro_stkphy;
    }

    public function setProStkphy(?int $pro_stkphy): static
    {
        $this->pro_stkphy = $pro_stkphy;

        return $this;
    }

    public function getProStkale(): ?int
    {
        return $this->pro_stkale;
    }

    public function setProStkale(?int $pro_stkale): static
    {
        $this->pro_stkale = $pro_stkale;

        return $this;
    }

    public function getCat(): ?categorie
    {
        return $this->cat;
    }

    public function setCat(?categorie $cat): static
    {
        $this->cat = $cat;

        return $this;
    }

    /**
     * @return Collection<int, Vente>
     */
    public function getVentes(): Collection
    {
        return $this->ventes;
    }

    public function addVente(Vente $vente): static
    {
        if (!$this->ventes->contains($vente)) {
            $this->ventes->add($vente);
            $vente->setPro($this);
        }

        return $this;
    }

    public function removeVente(Vente $vente): static
    {
        if ($this->ventes->removeElement($vente)) {
            // set the owning side to null (unless already changed)
            if ($vente->getPro() === $this) {
                $vente->setPro(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Panier>
     */
    public function getPaniers(): Collection
    {
        return $this->paniers;
    }

    public function addPanier(Panier $panier): static
    {
        if (!$this->paniers->contains($panier)) {
            $this->paniers->add($panier);
            $panier->setPanPro($this);
        }

        return $this;
    }

    public function removePanier(Panier $panier): static
    {
        if ($this->paniers->removeElement($panier)) {
            // set the owning side to null (unless already changed)
            if ($panier->getPanPro() === $this) {
                $panier->setPanPro(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Livraison>
     */
    public function getLivraisons(): Collection
    {
        return $this->livraisons;
    }

    public function addLivraison(Livraison $livraison): static
    {
        if (!$this->livraisons->contains($livraison)) {
            $this->livraisons->add($livraison);
            $livraison->setLivPro($this);
        }

        return $this;
    }

    public function removeLivraison(Livraison $livraison): static
    {
        if ($this->livraisons->removeElement($livraison)) {
            // set the owning side to null (unless already changed)
            if ($livraison->getLivPro() === $this) {
                $livraison->setLivPro(null);
            }
        }

        return $this;
    }
}
