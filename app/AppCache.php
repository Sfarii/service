<?php

/*
 * This file is the core of Symfony.
 *
 * (c) Sfari Rami <rami2sfari@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Symfony\Bundle\FrameworkBundle\HttpCache\HttpCache;

class AppCache extends HttpCache
{
    /*
    * The available options are:
    *
    * debug: If true, the traces are added as a HTTP header to ease debugging
    *
    * default_ttl : The number of seconds that a cache entry should be considered fresh when no
    *     explicit freshness information is provided in a response.
    *     Explicit Cache-Control or Expires headers override this value. (default: 0)
    *
    * private_headers : Set of request headers that trigger "private" cache-control behavior
    *     on responses that don't explicitly state whether the response is public or private
    *     via a Cache-Control directive. (default: Authorization and Cookie)
    *
    * allow_reload : Specifies whether the client can force a cache reload by
    *      including a Cache-Control "no-cache" directive in the request.
    *      Set it to true for compliance with RFC 2616. (default: false)
    *
    * allow_revalidate : Specifies whether the client can force a cache revalidate
    *      by including a Cache-Control "max-age=0" directive in the request.
    *      Set it to true for compliance with RFC 2616. (default: false)
    *
    * stalewhilerevalidate : Specifies the default number of seconds
    *     (the granularity is the second as the Response TTL precision is a second)
    *      during which the cache can immediately return a stale response while it
    *      revalidates it in the background (default: 2). This setting is overridden
    *      by the stale-while-revalidate HTTP Cache-Control extension (see RFC 5861).
    *
    * staleiferror : Specifies the default number of seconds (the granularity is the second)
    *      during which the cache can serve a stale response when an error is encountered (default: 60).
    *      This setting is overridden by the stale-if-error HTTP Cache-Control extension (see RFC 5861).
    */


    /**
     * {@inheritDoc}
     */
    protected function getOptions()
    {
        return array(
            'default_ttl' => 0,
            'staleiferror' => 60,
            'stalewhilerevalidate' => 2,
            'allow_revalidate' => false,
            'allow_reload' => false,
            'private_headers' => 'Authorization and Cookie'
        );
    }
}
