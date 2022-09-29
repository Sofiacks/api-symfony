<?php

namespace App\Command;

use App\Entity\Posts;

class PostFactory
{

    public static function create(string $title, string $content): Posts
    {
        $post = new Posts();
        $post->setTitle($title);
        $post->setContent($content);
        return $post;
    }
}