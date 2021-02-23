<?php

namespace App\Entity;

use App\Repository\BusinessHoursRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BusinessHoursRepository::class)
 */
class BusinessHours
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Business::class, inversedBy="businessHours")
     * @ORM\JoinColumn(nullable=false)
     */
    private $business;

    /**
     * @ORM\Column(type="integer")
     */
    private $day;

    /**
     * @ORM\Column(type="time")
     */
    private $openTime;

    /**
     * @ORM\Column(type="time")
     */
    private $closeTime;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBusiness(): ?Business
    {
        return $this->business;
    }

    public function setBusiness(?Business $business): self
    {
        $this->business = $business;

        return $this;
    }

    public function getDay(): ?int
    {
        return $this->day;
    }

    public function setDay(int $day): self
    {
        $this->day = $day;

        return $this;
    }

    public function getOpenTime(): ?\DateTimeInterface
    {
        return $this->openTime;
    }

    public function setOpenTime(\DateTimeInterface $openTime): self
    {
        $this->openTime = $openTime;

        return $this;
    }

    public function getCloseTime(): ?\DateTimeInterface
    {
        return $this->closeTime;
    }

    public function setCloseTime(\DateTimeInterface $closeTime): self
    {
        $this->closeTime = $closeTime;

        return $this;
    }
}
