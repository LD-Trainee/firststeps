<?php

namespace App\Entity;

use App\Repository\RestRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RestRepository::class)
 */
class Rest
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=0, nullable=true)
     */
    private $minZahl;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=0)
     */
    private $maxZahl;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=0)
     */

    private $randomNumber;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMinZahl(): ?string
    {
        return $this->minZahl;
    }

    public function setMinZahl(?string $minZahl): self
    {
        $this->minZahl = $minZahl;

        return $this;
    }

    public function getMaxZahl(): ?string
    {
        return $this->maxZahl;
    }

    public function setMaxZahl(string $maxZahl): self
    {
        $this->maxZahl = $maxZahl;

        return $this;
    }

    public function setRandomNumber(string $rnd)
    {
        $this->randomNumber = $rnd;

        return $this;
    }

    public function getRandomNumber()
    {
        return $this->randomNumber;
    }


    /**
     * @ORM\Column(type="decimal", precision=10, scale=0)
     */
    private $text;

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param mixed $text
     */
    public function setText($text): void
    {
        $this->text = $text;
    }
}
