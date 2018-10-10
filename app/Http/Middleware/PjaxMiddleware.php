<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Response;

class PjaxMiddleware
{

    public function handle($request, Closure $next)
    {
        $response = $next($request);

        if (! $request->pjax() || $response->isRedirection()) {
            return $response;
        }

        $this->filterResponse($response, $request->header('X-PJAX-CONTAINER'))
            ->setUriHeader($response, $request);

        return $response;
    }


    protected function filterResponse(Response $response, $container)
    {
        $crawler = new Crawler($response->getContent());

        $response->setContent(
            $this->makeTitle($crawler) .
            $this->fetchContents($crawler, $container)
        );

        return $this;
    }

    protected function makeTitle($crawler)
    {
        $pageTitle = $crawler->filter('head > title')->html();

        return "<title>{$pageTitle}</title>";
    }

    protected function fetchContents($crawler, $container)
    {
        $content = $crawler->filter($container);

        if (! $content->count()) {
            abort(422);
        }

        return $content->html();
    }

    protected function setUriHeader(Response $response, Request $request)
    {
        $response->header(
            'X-PJAX-URL', $request->getRequestUri()
        );
    }
}
