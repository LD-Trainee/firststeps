<?php

namespace App\Entity;

use App\Repository\PlusRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PlusRepository::class)
 */
class Plus
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $zahlPlus;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $feldPlus;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $attending;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getZahlPlus(): ?int
    {
        return $this->zahlPlus;
    }

    public function setZahlPlus(?int $zahlPlus): self
    {
        $this->zahlPlus = $zahlPlus;

        return $this;
    }

    public function getFeldPlus(): ?int
    {
        return $this->feld;
    }

    public function setFeldPlus(?int $feld): self
    {
        $this->feld = $feld;

        return $this;
    }

    public function getAttending(): ?bool
    {
        return $this->attending;
    }

    public function setAttending(?bool $attending): self
    {
        $this->attending = $attending;

        return $this;
    }
}
