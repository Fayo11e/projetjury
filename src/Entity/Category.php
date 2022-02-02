<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'string', length: 255)]
    private $articlePath;

    #[ORM\ManyToOne(targetEntity: Article::class)]
    private $ManyToOne;

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

    public function getArticlePath(): ?string
    {
        return $this->articlePath;
    }

    public function setArticlePath(string $articlePath): self
    {
        $this->articlePath = $articlePath;

        return $this;
    }

    public function getManyToOne(): ?Article
    {
        return $this->ManyToOne;
    }

    public function setManyToOne(?Article $ManyToOne): self
    {
        $this->ManyToOne = $ManyToOne;

        return $this;
    }
}
