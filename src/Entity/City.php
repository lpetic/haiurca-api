<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CityRepository")
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="cities")
 * @ApiResource(attributes={
 *     "normalization_context"={"groups"={"city"}},
 *     "denormalization_context"={"groups"={"city"}}
 * })
 */
class City
{

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"city", "travel", "user", "country"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"city", "travel", "user", "country"})
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=Country::class, inversedBy="cities")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"city", "travel", "user"})
     */
    private $country;

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

    public function getCountry(): ?Country
    {
        return $this->country;
    }

    public function setCountry(?Country $country): self
    {
        $this->country = $country;

        return $this;
    }
}
