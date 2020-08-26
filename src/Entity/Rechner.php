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
     * @ORM\Column(type="float", precision=10, scale=2, nullable=true)
     */
    private $zahl;

    private $attending;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getZahl(): ?float
    {
        return $this->zahl;
    }

    public function setZahl(?float $zahl): self
    {
        $this->zahl = $zahl;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getRechenart()
    {
        return $this->attending;
    }

    /**
     * @param mixed $attending
     */
    public function setRechenart($attending): void
    {
        $this->attending = $attending;
    }



}
