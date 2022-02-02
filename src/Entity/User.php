<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'string', length: 255)]
    private $firstname;

    #[ORM\Column(type: 'datetime_immutable')]
    private $createdAt;

    #[ORM\Column(type: 'string', length: 255)]
    private $email;

    #[ORM\Column(type: 'string', length: 255)]
    private $password;

    #[ORM\Column(type: 'string', length: 255)]
    private $nickname;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: commentary::class)]
    private $relation;

    #[ORM\OneToMany(mappedBy: 'admin', targetEntity: Article::class)]
    private $relationadmin;

    public function __construct()
    {
        $this->relation = new ArrayCollection();
        $this->relationadmin = new ArrayCollection();
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

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getNickname(): ?string
    {
        return $this->nickname;
    }

    public function setNickname(string $nickname): self
    {
        $this->nickname = $nickname;

        return $this;
    }

    /**
     * @return Collection|commentary[]
     */
    public function getRelation(): Collection
    {
        return $this->relation;
    }

    public function addRelation(commentary $relation): self
    {
        if (!$this->relation->contains($relation)) {
            $this->relation[] = $relation;
            $relation->setUser($this);
        }

        return $this;
    }

    public function removeRelation(commentary $relation): self
    {
        if ($this->relation->removeElement($relation)) {
            // set the owning side to null (unless already changed)
            if ($relation->getUser() === $this) {
                $relation->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Article[]
     */
    public function getRelationadmin(): Collection
    {
        return $this->relationadmin;
    }

    public function addRelationadmin(Article $relationadmin): self
    {
        if (!$this->relationadmin->contains($relationadmin)) {
            $this->relationadmin[] = $relationadmin;
            $relationadmin->setAdmin($this);
        }

        return $this;
    }

    public function removeRelationadmin(Article $relationadmin): self
    {
        if ($this->relationadmin->removeElement($relationadmin)) {
            // set the owning side to null (unless already changed)
            if ($relationadmin->getAdmin() === $this) {
                $relationadmin->setAdmin(null);
            }
        }

        return $this;
    }
}
