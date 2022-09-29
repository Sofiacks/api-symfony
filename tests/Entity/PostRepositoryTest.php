<?php

namespace App\Tests\Entity;

use App\Command\PostFactory;
use App\Repository\PostRepositoryTestRepository;
use App\Repository\PostsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

#[ORM\Entity(repositoryClass: PostRepositoryTestRepository::class)]
class PostRepositoryTest extends KernelTestCase
{
    private EntityManagerInterface $entityManager;

    private  PostsRepository $postsRepository;

    protected function setUp(): void
    {
        //(1) boot the Symfony kernel

        $kernel=self::bootKernel();
        $this->assertSame('test', $kernel->getEnvironment());
        $this->entityManager=$kernel->getContainer()
            ->get('doctrine')
            ->getManager();

        //2 use static::getContainer() to access the service container
        $container= static::getContainer();

            // (3) run some service & test the result
        //(3"") get PostRepository from container.
        $this->postsRepository = $container->get(PostsRepository::class);
;    }

    //"destructor"
    protected function tearDown(): void
    {
        parent::tearDown();
        $this->entityManager->close();
    }

    public function testCreatePost(): void
    {
        $entity = PostFactory::create("test post", "test content");
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
        $this->assertNotNull($entity->getId());

        $byId = $this->postsRepository->findOneBy(["id" => $entity->getId()]);
        $this->assertEquals("test post", $byId->getTitle());
        $this->assertEquals("test content", $byId->getContent());
    }
}
