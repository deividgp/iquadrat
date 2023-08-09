<?php

namespace App\Entity;

use App\Repository\ProvinceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProvinceRepository::class)]
class Province
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'province', targetEntity: Town::class)]
    private Collection $towns;

    public function __construct()
    {
        $this->towns = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Town>
     */
    public function getTowns(): Collection
    {
        return $this->towns;
    }

    public function addTown(Town $town): static
    {
        if (!$this->towns->contains($town)) {
            $this->towns->add($town);
            $town->setProvince($this);
        }

        return $this;
    }

    public function removeTown(Town $town): static
    {
        if ($this->towns->removeElement($town)) {
            // set the owning side to null (unless already changed)
            if ($town->getProvince() === $this) {
                $town->setProvince(null);
            }
        }

        return $this;
    }
}
