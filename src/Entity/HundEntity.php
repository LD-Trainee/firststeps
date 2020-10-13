<?php

namespace App\Entity;

use App\Repository\HundEntityRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne;

/**
 * @ORM\Entity(repositoryClass=HundEntityRepository::class)
 */
class HundEntity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $rasse;

    /**
     * @ORM\Column(type="integer")
     */
    private $age;

    /**
     * @ORM\Column(type="integer")
     * @ManyToOne(targetEntity="HerrchenEntity")
     */
    private $herrchen;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getRasse(): ?string
    {
        return $this->rasse;
    }

    public function setRasse(string $rasse): self
    {
        $this->rasse = $rasse;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getHerrchen(): ?int
    {
        return $this->herrchen;
    }

    public function setHerrchen(int $herrchen): self
    {
        $this->herrchen = $herrchen;

        return $this;
    }
}
