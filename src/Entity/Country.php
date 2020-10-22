<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CountryRepository")
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="countries")
 * @ApiResource(attributes={
 *     "security"="is_granted('ROLE_USER')",
 *     "normalization_context"={"groups"={"country"}},
 *     "denormalization_context"={"groups"={"country"}}
 * })
 */
class Country
{

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"country", "travel", "user", "city"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"country", "travel", "user", "city"})
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=City::class, mappedBy="country", orphanRemoval=true)
     * @Groups({"country"})
     */
    private $cities;

    public function __construct()
    {
        $this->cities = new ArrayCollection();
    }

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

    /**
     * @return Collection|City[]
     */
    public function getCities(): Collection
    {
        return $this->cities;
    }

    public function addCity(City $city): self
    {
        if (!$this->cities->contains($city)) {
            $this->cities[] = $city;
            $city->setCountry($this);
        }

        return $this;
    }

    public function removeCity(City $city): self
    {
        if ($this->cities->contains($city)) {
            $this->cities->removeElement($city);
            // set the owning side to null (unless already changed)
            if ($city->getCountry() === $this) {
                $city->setCountry(null);
            }
        }

        return $this;
    }
}
