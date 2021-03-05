<?php

namespace App\Entity;

use App\Repository\PublicationEquipementRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=PublicationEquipementRepository::class)
 */
class PublicationEquipement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date;

    /**
     *Type("string")
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     * )
     *@Assert\NotNull
     * 
     * @ORM\Column(type="string", length=255 ,nullable=true)
     */
    private $title;

    /**
     * /**
     *Type("string")
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     * )
     *@Assert\NotNull
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=255 , nullable=true)
     */
    private $image;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="publicationEquipements")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=TypePublication::class, inversedBy="publicationEquipements")
     */
    private $typePublication;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

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

    public function getTypePublication():?TypePublication 
    {
        return $this->typePublication;
    }

    public function setTypePublication(?TypePublication $typePublication): self
    {
        $this->typePublication = $typePublication;

        return $this;
    }
}
