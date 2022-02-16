<?php

namespace App\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string')]
    private $createdAt;

    #[ORM\Column(type: 'string')]
    private $content;

    #[ORM\Column(type: 'string', length: 255)]
    private $title;

    #[ORM\OneToMany(mappedBy: 'article', targetEntity: Category::class)]
    private $relation;

    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: 'articles')]
    #[ORM\JoinColumn(nullable: false)]
    private $Relation;

    public function __construct()
    {
        $this->relation = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?string
    {
        return $this->createdAt;
    }

    public function setCreatedAt(string $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

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

    /**
     * @return Collection|Category[]
     */
    public function getRelation(): Collection
    {
        return $this->relation;
    }

    public function addRelation(Category $relation): self
    {
        if (!$this->relation->contains($relation)) {
            $this->relation[] = $relation;
            $relation->setArticle($this);
        }

        return $this;
    }

    public function removeRelation(Category $relation): self
    {
        if ($this->relation->removeElement($relation)) {
            // set the owning side to null (unless already changed)
            if ($relation->getArticle() === $this) {
                $relation->setArticle(null);
            }
        }

        return $this;
    }

    public function setRelation(?Category $Relation): self
    {
        $this->Relation = $Relation;

        return $this;
    }




   

}
