<?php

namespace App\DataFixtures;

use App\Command\PostFactory;
use App\Entity\Comment;
use App\Entity\Tag;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $data = PostFactory::create("API TEST", "MON API SYMFONY PHP");
        $data->addTag(Tag::of( "Symfony"))
            ->addTag( Tag::of("PHP 8"))
            ->addComment(Comment::of("test comment 1"))
            ->addComment(Comment::of("test comment 2"));

        $manager->persist($data);
        $manager->flush();
    }
}
