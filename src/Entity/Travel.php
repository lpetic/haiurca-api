<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Traits\TimeTrait;
use App\Repository\TravelRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=TravelRepository::class)
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="travels")
 */
class Travel
{
    use TimeTrait;
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=City::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $origin;

    /**
     * @ORM\ManyToOne(targetEntity=City::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $destination;

    /**
     * @ORM\Column(type="datetime")
     */
    private $go;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $back;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=1000, nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="travels")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrigin(): ?City
    {
        return $this->origin;
    }

    public function setOrigin(?City $origin): self
    {
        $this->origin = $origin;

        return $this;
    }

    public function getDestination(): ?City
    {
        return $this->destination;
    }

    public function setDestination(?City $destination): self
    {
        $this->destination = $destination;

        return $this;
    }

    public function getGo(): ?\DateTimeInterface
    {
        return $this->go;
    }

    public function setGo(\DateTimeInterface $go): self
    {
        $this->go = $go;

        return $this;
    }

    public function getBack(): ?\DateTimeInterface
    {
        return $this->back;
    }

    public function setBack(?\DateTimeInterface $back): self
    {
        $this->back = $back;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(?int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
