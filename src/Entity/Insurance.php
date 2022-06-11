<?php

declare(strict_types=1);

namespace App\Entity;

use App\Entity\InsuranceTypeEnum;
use App\Entity\NamedTrait;
use App\Repository\InsuranceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InsuranceRepository::class)]
class Insurance
{
    use NamedTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'date')]
    private $endDate;

    #[ORM\ManyToOne(targetEntity: Tool::class, inversedBy: 'insurances')]
    #[ORM\JoinColumn(nullable: false)]
    private $tool;

    #[ORM\Column(type: 'string', enumType:InsuranceTypeEnum::class, length: 1)]
    private $type;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function getTool(): ?Tool
    {
        return $this->tool;
    }

    public function setTool(?Tool $tool): self
    {
        $this->tool = $tool;

        return $this;
    }

    public function getType(): ?InsuranceTypeEnum
    {
        return $this->type;
    }

    public function setType(InsuranceTypeEnum $type): self
    {
        $this->type = $type;

        return $this;
    }
}
