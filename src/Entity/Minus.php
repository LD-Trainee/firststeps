<?php

namespace App\Entity;

use App\Repository\MinusRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MinusRepository::class)
 */
class Minus
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
    private $zahlminus;

    public function getId(): ?int
    {
        return $this->id;
    }

    private $attending;

    public function getZahlminus(): ?string
    {
        return $this->zahlminus;
    }

    public function setZahlminus(?string $zahlminus): self
    {
        $this->zahlminus = $zahlminus;

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
    public function setAttending($attending)
    {
        $this->attending = $attending;
    }



}
