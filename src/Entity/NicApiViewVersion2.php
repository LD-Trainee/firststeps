<?php

namespace App\Entity;

use App\Repository\NicApiViewRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=NicApiViewRepository::class)
 */
class NicApiViewVersion2
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $input;

    /**
     * @ORM\Column(type="text")
     */
    private $output;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $NgrokURL;

    /**
     * @ORM\Column(type="integer", length=10)
     */
    private $delete;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInput(): ?string
    {
        return $this->input;
    }

    public function setInput(?string $input): self
    {
        $this->input = $input;

        return $this;
    }

    public function getOutput()
    {
        return $this->output;
    }

    public function setOutput($output): self
    {
        $this->output = $output;

        return $this;
    }

    public function getNgrokURL(): ?string
    {
        return $this->NgrokURL;
    }

    public function setNgrokURL(string $NgrokURL): self
    {
        $this->NgrokURL = $NgrokURL;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDelete(): ?int
    {
        return $this->delete;
    }

    /**
     * @param mixed $delete
     */
    public function setDelete($delete): void
    {
        $this->delete = $delete;
    }
}
