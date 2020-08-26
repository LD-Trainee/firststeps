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
     * @ORM\Column(type="float", nullable=true)
     */

    private $feld;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $zahlminus;

    public function getId(): ?int
    {
        return $this->id;
    }

    private $attending;

    /**
     * @return float
     */

    public function getZahlminus(): ?float
    {
        return $this->zahlminus;
    }

    /**
     * @param float $zahlminus
     */

    public function setZahlminus(?float $zahlminus): self
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

    /**
     * @return float
     */

    public function getFeld(): ?float
    {
        return $this->feld;
    }

    /**
     * @param float $gg
     */

    public function setFeld(?float $gg){
        $this->feld = $gg;
    }


}
