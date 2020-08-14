<?php

namespace App\Entity;

use App\Repository\RechnerRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * @ORM\Entity(repositoryClass=RechnerRepository::class)
 */
class Rechner
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $zahl;

    private $attending;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getZahl(): ?int
    {
        return $this->zahl;
    }

    public function setZahl(?string $zahl): self
    {
        $this->zahl = $zahl;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAttending()
    {
        return $this->attending;
    }

    /**
     * @param mixed $attending
     */
    public function setAttending($attending): void
    {
        $this->attending = $attending;
    }



}
