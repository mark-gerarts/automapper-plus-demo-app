<?php

namespace Demo\Controller\Blog;

use AutoMapperPlus\AutoMapperInterface;
use Demo\Model\Post;
use Demo\ViewModel\Post\PostDetailViewModel;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ViewController
 *
 * @package Demo\Controller\Blog
 */
class ViewController
{
    /**
     * @var AutoMapperInterface
     */
    private $mapper;

    /**
     * @var EngineInterface
     */
    private $templating;

    /**
     * ViewController constructor.
     *
     * @param AutoMapperInterface $mapper
     * @param EngineInterface $templating
     */
    public function __construct
    (
        AutoMapperInterface $mapper,
        EngineInterface $templating
    )
    {
        $this->mapper = $mapper;
        $this->templating = $templating;
    }

    /**
     * @param Request $request
     * @param Post $post
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function __invoke(Request $request, Post $post)
    {
        $post = $this->mapper->map($post, PostDetailViewModel::class);

        return $this->templating->renderResponse('blog/view.html.twig', [
            'post' => $post
        ]) ;
    }
}
