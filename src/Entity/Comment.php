<?php

namespace App\Entity;

use App\Repository\CommentRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use Symfony\Component\Serializer\Annotation\Ignore;
use Symfony\Component\Validator\Constraints\DateTime;

#[ORM\Entity(repositoryClass: CommentRepository::class)]
class Comment
{
#[ORM\Id]
#[ORM\GeneratedValue]
#[ORM\Column]
#[Ignore]


private Posts $post;

private ?int $id = null;

    #[Column(type: "string", length: 255)]
    private string $content;


    #[Column(name: "created_at", type: "datetime", nullable: true)]
    private DateTime|null $createdAt = null;


    #[ORM\ManyToOne(targetEntity: "App\Entity\Posts", inversedBy: "comments")]
    #[ORM\JoinColumn(name: "post_id", referencedColumnName: "id")]
    private Posts $posts ;

    public function __construct()
    {
        $this->createdAt = new DateTime();
    }

    public static function of(string $string): Comment
    {
        $Comment = new Comment();
        $Comment->setContent($string);
        return $Comment;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getPosts(): Posts
    {
        return $this->posts;
    }

    public function setPosts(?posts $posts): self
    {
        $this->posts = $posts;

        return $this;
    }


    public function getContent(): string
    {
        return $this->content;
    }


    public function setContent(string $content): Comment
    {
        $this->content = $content;
        return $this;
    }


    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }


    public function setCreatedAt(?DateTime $createdAt): Comment
    {
        $this->createdAt = $createdAt;
        return $this;
    }

}
