<?php

declare(strict_types=1);

namespace PhpRock\SettingsProvider\Http\Controller;

use DateTime;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

final class AssetController extends Controller
{
    /**
     * @return Response
     */
    public function js(): Response
    {
        $response = new Response(
            [], 200, [
                'Content-Type' => 'text/javascript',
            ]
        );

        return $this->cacheResponse($response);
    }

    /**
     * @return Response
     */
    public function css(): Response
    {
        $response = new Response(
            [], 200, [
                'Content-Type' => 'text/css',
            ]
        );

        return $this->cacheResponse($response);
    }

    /**
     * Cache the response 1 year (31536000 sec)
     *
     * @param Response $response
     *
     * @return Response
     */
    protected function cacheResponse(Response $response): Response
    {
        $response->setSharedMaxAge(31536000);
        $response->setMaxAge(31536000);
        $response->setExpires(new DateTime('+1 year'));

        return $response;
    }
}
