<?php

namespace App\Controller;

use App\Repository\PostsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostsController extends AbstractController
{
    #[Route('/posts', name: 'app_posts')]
    public function index(): Response
    {
        return $this->render('posts/index.html.twig', [
            'controller_name' => 'PostsController',
        ]);
    }

    public function __construct(private PostsRepository $posts)
    {
    }

    #[Route(path: "", name: "all", methods: ["GET"])]
    function all(): Response
    {
        $data = $this->posts->findAll();
        return $this->json($data);
    }
}
  //  function byId(): Response
   // ...

