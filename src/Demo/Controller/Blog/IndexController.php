<?php

namespace Demo\Controller\Blog;

use AutoMapperPlus\AutoMapperInterface;
use Demo\Repository\PostRepositoryInterface;
use Demo\ViewModel\Post\PostListViewModel;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class IndexController
 *
 * @package Demo\Controller\Blog
 */
class IndexController
{
    /**
     * @var EngineInterface
     */
    private $templating;

    /**
     * @var PostRepositoryInterface
     */
    private $postRepository;
    /**
     * @var AutoMapperInterface
     */
    private $mapper;

    /**
     * IndexController constructor.
     *
     * @param PostRepositoryInterface $postRepository
     * @param AutoMapperInterface $mapper
     * @param EngineInterface $templating
     */
    public function __construct
    (
        PostRepositoryInterface $postRepository,
        AutoMapperInterface $mapper,
        EngineInterface $templating
    )
    {
        $this->postRepository = $postRepository;
        $this->templating = $templating;
        $this->mapper = $mapper;
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function __invoke(Request $request)
    {
        $allPosts = $this->postRepository->findAll();
        $allPosts = $this->mapper->mapMultiple($allPosts, PostListViewModel::class);

        return $this->templating->renderResponse('blog/index.html.twig', [
            'posts' => $allPosts
        ]);
    }
}
