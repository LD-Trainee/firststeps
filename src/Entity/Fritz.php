<?php

namespace App\Entity;

use App\Repository\FritzRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FritzRepository::class)
 */
class Fritz
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $akt;

    /**
     * @ORM\Column(type="text")
     */
    private $Switch;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAkt(): ?string
    {
        return $this->akt;
    }

    public function setAkt(string $akt): self
    {
        $this->akt = $akt;

        return $this;
    }

    public function getSwitch(): ?string
    {
        return $this->Switch;
    }

    public function setSwitch(string $Switch): self
    {
        $this->Switch = $Switch;

        return $this;
    }
}
