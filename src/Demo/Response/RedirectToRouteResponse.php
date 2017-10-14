<?php

namespace Demo\Response;

use Symfony\Component\HttpFoundation\Response;

/**
 * Class RedirectToRouteResponse
 *
 * @package Demo\Response
 */
class RedirectToRouteResponse extends Response
{
    /**
     * @var
     */
    private $route;

    /**
     * RedirectToRouteResponse constructor.
     *
     * @param string $route
     */
    public function __construct(string $route) {
        parent::__construct('');
        $this->route = $route;
    }

    /**
     * @return string
     */
    public function getRoute(): string
    {
        return $this->route;
    }
}
