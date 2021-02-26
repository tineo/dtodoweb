<?php

namespace App\Entity;

use App\Repository\BusinessRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Mtarld\SymbokBundle\Annotation\Getter;
use Mtarld\SymbokBundle\Annotation\Setter;

/**
 * @ORM\Entity(repositoryClass=BusinessRepository::class)
 */
class Business
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Getter
     * @Setter
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Getter
     * @Setter
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Getter
     * @Setter
     */
    private $alias;

    /**
     * @ORM\OneToOne(targetEntity=Image::class, cascade={"persist", "remove"})
     */
    private $logo;

    /**
     * @ORM\ManyToMany(targetEntity=Category::class)
     */
    private $category;

    /**
     * @ORM\ManyToOne(targetEntity=Ubigeo::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $ubigeo;

    /**
     * @ORM\Column(type="string", length=255)
     * @Getter
     * @Setter
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Getter
     * @Setter
     */
    private $tel;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Getter
     * @Setter
     */
    private $dm;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Getter
     * @Setter
     */
    private $email;

    /**
     * @ORM\Column(type="float")
     * @Getter
     * @Setter
     */
    private $lat;

    /**
     * @ORM\Column(type="float")
     * @Getter
     * @Setter
     */
    private $lng;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Getter
     * @Setter
     */
    private $information;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Getter
     * @Setter
     */
    private $videoUrl;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Getter
     * @Setter
     */
    private $webUrl;

    /**
     * @ORM\OneToMany(targetEntity=Rating::class, mappedBy="business", orphanRemoval=true)
     */
    private $ratings;

    /**
     * @ORM\OneToMany(targetEntity=BusinessHours::class, mappedBy="business", orphanRemoval=true)
     */
    private $businessHours;

    /**
     * Business constructor.
     */
    public function __construct()
    {
        $this->category = new ArrayCollection();
        $this->ratings = new ArrayCollection();
        $this->businessHours = new ArrayCollection();
    }

    /**
     * @return Image|null
     */
    public function getLogo(): ?Image
    {
        return $this->logo;
    }

    /**
     * @param Image|null $logo
     * @return $this
     */
    public function setLogo(?Image $logo): self
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * @return Collection|Category[]
     */
    public function getCategory(): Collection
    {
        return $this->category;
    }

    /**
     * @param Category $category
     * @return $this
     */
    public function addCategory(Category $category): self
    {
        if (!$this->category->contains($category)) {
            $this->category[] = $category;
        }

        return $this;
    }

    /**
     * @param Category $category
     * @return $this
     */
    public function removeCategory(Category $category): self
    {
        $this->category->removeElement($category);

        return $this;
    }


    /**
     * @return Collection|Rating[]
     */
    public function getRatings(): Collection
    {
        return $this->ratings;
    }

    public function addRating(Rating $rating): self
    {
        if (!$this->ratings->contains($rating)) {
            $this->ratings[] = $rating;
            $rating->setBusiness($this);
        }

        return $this;
    }

    public function removeRating(Rating $rating): self
    {
        if ($this->ratings->removeElement($rating)) {
            // set the owning side to null (unless already changed)
            if ($rating->getBusiness() === $this) {
                $rating->setBusiness(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|BusinessHours[]
     */
    public function getBusinessHours(): Collection
    {
        return $this->businessHours;
    }

    public function addBusinessHour(BusinessHours $businessHour): self
    {
        if (!$this->businessHours->contains($businessHour)) {
            $this->businessHours[] = $businessHour;
            $businessHour->setBusiness($this);
        }

        return $this;
    }

    public function removeBusinessHour(BusinessHours $businessHour): self
    {
        if ($this->businessHours->removeElement($businessHour)) {
            // set the owning side to null (unless already changed)
            if ($businessHour->getBusiness() === $this) {
                $businessHour->setBusiness(null);
            }
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUbigeo()
    {
        return $this->ubigeo;
    }

    /**
     * @param mixed $ubigeo
     */
    public function setUbigeo($ubigeo): void
    {
        $this->ubigeo = $ubigeo;
    }
}
