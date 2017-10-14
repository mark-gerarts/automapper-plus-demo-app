<?php

namespace Demo\Util;

use Symfony\Component\HttpFoundation\Request;

/**
 * Class FlashTrait
 *
 * @package Demo\Util
 */
trait FlashTrait
{
    /**
     * Adds a flash message to the session.
     *
     * @param Request $request
     * @param $type
     * @param $message
     */
    public function addFlash(Request $request, $type, $message): void
    {
        $session = $request->getSession();
        $session->getFlashBag()->add($type, $message);
    }
}
