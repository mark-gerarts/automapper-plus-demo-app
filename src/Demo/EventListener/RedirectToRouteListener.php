<?php

namespace Demo\EventListener;

use Demo\Response\RedirectToRouteResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\Routing\RouterInterface;

/**
 * Class RedirectToRouteListener
 *
 * @package Demo\EventListener
 */
class RedirectToRouteListener
{
    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * RedirectToRouteListener constructor.
     *
     * @param RouterInterface $router
     */
    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    /**
     * Transforms a RedirectToRouteResponse into an actual RedirectResponse.
     *
     * @param FilterResponseEvent $e
     */
    public function onKernelResponse(FilterResponseEvent $e)
    {
        /** @var RedirectToRouteResponse $response */
        $response = $e->getResponse();
        if (!$response instanceof RedirectToRouteResponse) {
            return;
        }

        $redirectResponse = new RedirectResponse(
            $this->router->generate($response->getRoute())
        );

        $e->setResponse($redirectResponse);
    }
}
