<?php

namespace App\Entity;

use App\Repository\TagRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Ignore;

#[ORM\Entity(repositoryClass: TagRepository::class)]
class Tag
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]

    private ?int $id = null;

    #[Ignore]
    #[ORM\ManyToMany(targetEntity: posts::class, inversedBy: 'tags')]
    private Collection $posts;


    #[ORM\Column(length: 30)]
    private ?string $topic = null;

    public function __construct()
    {
        $this->posts = new ArrayCollection();
    }

    public static function of(string $string): Tag
    {
        $Tag = new Tag();
        $Tag->setTopic($string);
        return $Tag;
    }

    public function getId(): int
    {
        return $this->id;
    }


    public function getPosts(): Collection
    {
        return $this->posts;
    }

    public function addPost(posts $post): self
    {
        if (!$this->posts->contains($post)) {
            $this->posts->add($post);
        }

        return $this;
    }

    public function removePost(posts $post): self
    {
        $this->posts->removeElement($post);

        return $this;
    }

    public function getTopic(): ?string
    {
        return $this->topic;
    }


    public function setTopic(): ?string
    {
        return $this->topic;
    }

}
