<?php

namespace Demo\Controller;

use AutoMapperPlus\AutoMapperInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class IndexController
 *
 * @package Demo\Controller
 */
class IndexController
{
    /**
     * @var AutoMapperInterface
     */
    private $autoMapper;

    function __construct(AutoMapperInterface $autoMapper)
    {
        $this->autoMapper = $autoMapper;
    }

    /**
     * @param Request $request
     * @return Response
     */
    function __invoke(Request $request)
    {
        return new Response("Hello, world!");
    }
}
