<?php

namespace App\Entity;

use App\Repository\CheckinRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CheckinRepository::class)
 */
class Checkin
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="checkins")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Business::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $business;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return User|null
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * @param User|null $user
     * @return $this
     */
    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @param Business|null $business
     * @return $this
     */
    public function setBusiness(?Business $business): self
    {
        $this->business = $business;

        return $this;
    }
}
