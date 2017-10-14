<?php

namespace Demo\Controller\Blog;

use AutoMapperPlus\AutoMapperInterface;
use Demo\Model\Post;
use Demo\Repository\PostRepositoryInterface;
use Demo\Util\FlashTrait;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;

/**
 * Class CreatePostController
 *
 * @package Demo\Controller\Blog
 */
class CreatePostController
{
    use FlashTrait;

    /**
     * @var EngineInterface
     */
    private $templating;

    /**
     * @var Form
     */
    private $createPostForm;

    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @var AutoMapperInterface
     */
    private $mapper;

    /**
     * @var PostRepositoryInterface
     */
    private $postRepository;

    /**
     * CreatePostController constructor.
     *
     * @param Form $createPostForm
     * @param EngineInterface $templating
     * @param RouterInterface $router
     * @param AutoMapperInterface $mapper
     * @param PostRepositoryInterface $postRepository
     */
    function __construct
    (
        Form $createPostForm,
        EngineInterface $templating,
        RouterInterface $router,
        AutoMapperInterface $mapper,
        PostRepositoryInterface $postRepository
    )
    {
        $this->templating = $templating;
        $this->createPostForm = $createPostForm;
        $this->router = $router;
        $this->mapper = $mapper;
        $this->postRepository = $postRepository;
    }

    /**
     * @param Request $request
     * @return RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    function __invoke(Request $request)
    {
        $form = $this->createPostForm;
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $createPost = $form->getData();
            $post = $this->mapper->map($createPost, Post::class);
            $this->postRepository->insert($post);

            $this->addFlash(
                $request,
                'success',
                'Created <em>' . strip_tags($post->getTitle()) . '</em>'
            );

            return new RedirectResponse($this->router->generate('demo.blog.index'));
        }

        return $this->templating->renderResponse('blog/create.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
