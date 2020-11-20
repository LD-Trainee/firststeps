<?php

namespace App\Entity;

use App\Repository\DeliciousPizzaEntityRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DeliciousPizzaEntityRepository::class)
 */
class DeliciousPizzaEntity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $fuck;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFuck(): ?int
    {
        return $this->fuck;
    }

    public function setFuck(int $fuck): self
    {
        $this->fuck = $fuck;

        return $this;
    }
}
