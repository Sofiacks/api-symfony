<?php

namespace App\Entity;

use App\Repository\PostsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\DateTime;

#[ORM\Entity(repositoryClass: PostsRepository::class)]
class Posts
{
    #[ORM\Id]
    #[ORM\Column(type: "integer", unique: true)]

    // id int ou uuid ?

    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $content = null;

    #[Column(name: "created_at", type: "datetime", nullable: true)]
    private DateTime|null $createdAt = null;

    #[Column(name: "published_at", type: "datetime", nullable: true)]
    private DateTime|null $publishedAt = null;



    #[ORM\OneToMany(mappedBy: 'posts', targetEntity: Comment::class,cascade: ['persist', 'merge', "remove"], fetch: 'LAZY', orphanRemoval: true)]
    private Collection $comments;

    #[ORM\ManyToMany(targetEntity: Tag::class, mappedBy: 'posts', cascade: ['persist', 'merge'], fetch: 'EAGER')]
    private Collection $tags;

    public function __construct()
    {
        $this->createdAt = new DateTime();
        $this->comments = new ArrayCollection();
        $this->tags = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }


    public function setId(?int $id): Posts
    {
        $this->id = $id;
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

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }


    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }


    public function setCreatedAt(?DateTime $createdAt): Posts
    {
        $this->createdAt = $createdAt;
        return $this;
    }


    public function getPublishedAt(): ?DateTime
    {
        return $this->publishedAt;
    }


    public function setPublishedAt(?DateTime $publishedAt): Posts
    {
        $this->publishedAt = $publishedAt;
        return $this;
    }


    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments->add($comment);
            $comment->setPosts($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getPosts() === $this) {
                $comment->setPosts(null);
            }
        }

        return $this;
    }


    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tag $tag): self
    {
        if (!$this->tags->contains($tag)) {
            $this->tags->add($tag);
            $tag->addPost($this);
        }

        return $this;
    }

    public function removeTag(Tag $tag): self
    {
        if ($this->tags->removeElement($tag)) {
            $tag->removePost($this);
        }

        return $this;
    }

    public function __toString(): string
    {
        // TODO: Implement __toString() method.
        return  "post [ id: " . $this->id . ", title: " . $this->title . ", content: " . $this->content . "]";
    }

}
