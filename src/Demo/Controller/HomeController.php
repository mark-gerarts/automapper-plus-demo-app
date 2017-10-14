<?php

namespace Demo\Controller;

use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class HomeController
 *
 * @package Demo\Controller
 */
class HomeController
{
    /**
     * @var EngineInterface
     */
    private $templating;

    /**
     * HomeController constructor.
     *
     * @param EngineInterface $templating
     */
    function __construct(EngineInterface $templating)
    {
        $this->templating = $templating;
    }

    /**
     * @param Request $request
     * @return Response
     */
    function __invoke(Request $request)
    {
        return $this->templating->renderResponse('default/home.html.twig');
    }
}
