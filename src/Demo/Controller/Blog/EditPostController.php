<?php

namespace Demo\Controller\Blog;

use AutoMapperPlus\AutoMapperInterface;
use Demo\Model\Post;
use Demo\Repository\PostRepositoryInterface;
use Demo\Response\RedirectToRouteResponse;
use Demo\Util\FlashTrait;
use Demo\ViewModel\Post\EditPostViewModel;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class EditPostController
 *
 * @package Demo\Controller\Blog
 */
class EditPostController
{
    use FlashTrait;

    /**
     * @var EngineInterface
     */
    private $templating;

    /**
     * @var Form
     */
    private $editPostForm;

    /**
     * @var AutoMapperInterface
     */
    private $mapper;

    /**
     * @var PostRepositoryInterface
     */
    private $postRepository;

    /**
     * EditPostController constructor.
     *
     * @param Form $editPostForm
     * @param EngineInterface $templating
     * @param AutoMapperInterface $mapper
     * @param PostRepositoryInterface $postRepository
     */
    public function __construct
    (
        Form $editPostForm,
        EngineInterface $templating,
        AutoMapperInterface $mapper,
        PostRepositoryInterface $postRepository
    )
    {
        $this->templating = $templating;
        $this->editPostForm = $editPostForm;
        $this->mapper = $mapper;
        $this->postRepository = $postRepository;
    }

    /**
     * @param Request $request
     * @param Post $post
     * @return RedirectToRouteResponse|\Symfony\Component\HttpFoundation\Response
     */
    function __invoke(Request $request, Post $post)
    {
        $form = $this->editPostForm;
        // I'll admit, mapping in this scenario doesn't add much value. However,
        // if you use something like a Command Bus, you would map to the DTO
        // here, and back to the entity in the Command Handler class. This
        // makes the mapping much more interesting.
        $post = $this->mapper->map($post, EditPostViewModel::class);
        $form->setData($post);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $editPost = $form->getData();
            $post = $this->mapper->map($editPost, Post::class);
            $this->postRepository->update($post);

            $this->addFlash(
                $request,
                'success',
                'Updated <em>' . strip_tags($post->getTitle()) . '</em>'
            );

            return new RedirectToRouteResponse('demo.blog.index');
        }

        return $this->templating->renderResponse('blog/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
