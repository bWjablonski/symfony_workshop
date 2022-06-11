<?php

declare(strict_types=1);

namespace App\Entity;

use App\Entity\NamedTrait;
use App\Repository\ToolRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ToolRepository::class)]
class Tool
{
    use NamedTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\OneToMany(mappedBy: 'tool', targetEntity: Insurance::class)]
    private $insurances;

    public function __construct()
    {
        $this->insurances = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Insurance>
     */
    public function getInsurances(): Collection
    {
        return $this->insurances;
    }

    public function addInsurance(Insurance $insurance): self
    {
        if (!$this->insurances->contains($insurance)) {
            $this->insurances[] = $insurance;
            $insurance->setTool($this);
        }

        return $this;
    }

    public function removeInsurance(Insurance $insurance): self
    {
        if ($this->insurances->removeElement($insurance)) {
            // set the owning side to null (unless already changed)
            if ($insurance->getTool() === $this) {
                $insurance->setTool(null);
            }
        }

        return $this;
    }
}
