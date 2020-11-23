<?php

namespace App\Entity;

use App\Repository\CustomerAddressesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CustomerAddressesRepository::class)
 */
class CustomerAddresses implements \JsonSerializable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $client_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $home_id;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $porch;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $floor;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $intercom;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $apartment;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="addresses")
     * @ORM\JoinColumn(nullable=false)
     */
    private $client;

    /**
     * @ORM\ManyToOne(targetEntity=Home::class, inversedBy="addresses")
     * @ORM\JoinColumn(nullable=false)
     */
    private $home;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClientId(): ?int
    {
        return $this->client_id;
    }

    public function setClientId(int $client_id): self
    {
        $this->client_id = $client_id;

        return $this;
    }

    public function getHomeId(): ?int
    {
        return $this->home_id;
    }

    public function setHomeId(int $home_id): self
    {
        $this->home_id = $home_id;

        return $this;
    }

    public function getPorch(): ?int
    {
        return $this->porch;
    }

    public function setPorch(?int $porch): self
    {
        $this->porch = $porch;

        return $this;
    }

    public function getFloor(): ?int
    {
        return $this->floor;
    }

    public function setFloor(?int $floor): self
    {
        $this->floor = $floor;

        return $this;
    }

    public function getIntercom(): ?int
    {
        return $this->intercom;
    }

    public function setIntercom(?int $intercom): self
    {
        $this->intercom = $intercom;

        return $this;
    }

    public function getApartment(): ?int
    {
        return $this->apartment;
    }

    public function setApartment(?int $apartment): self
    {
        $this->apartment = $apartment;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getHome(): ?Home
    {
        return $this->home;
    }

    public function setHome(?Home $home): self
    {
        $this->home = $home;

        return $this;
    }

    public function jsonSerialize()
    {
        return [
            "id" => $this->getId(),
            "client_id" => $this->getClientId(),
            "home_id" => $this->getHomeId(),
            "porch" => $this->getPorch(),
            "floor" => $this->getFloor(),
            "intercom" => $this->getIntercom(),
            "apartment" => $this->getApartment()
        ];
    }
}
