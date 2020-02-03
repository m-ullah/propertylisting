<?php
/**
 *
 * @author     M Ullah <jitu21@gmail.com>
 * @copyright  2019 - 2020 M Ullah
 * @license    MIT
 * @version    1.0.0
 * @link       https://github.com/m-ullah/spotahome
 * @since      File available since Release 1.0.0
 * @deprecated File deprecated in Release 2.0.0
 * @copyright  Copyright (c) 2019 M Ullah
 */

namespace SH\Framework\Interfaces\Http\ServiceProvider;

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use SH\Framework\Extension\Slim\ConnectableInterface;
use SH\Framework\Interfaces\Http\Controller\Property\GetPropertiesController;

/**
 * Class RouteServiceProvider
 *
 * @package SH\Framework\Interfaces\Http\ServiceProvider
 */
class RouteServiceProvider implements ConnectableInterface
{
    /**
     * Connect a service to the Slim app
     *
     * @param  App $app The slim application
     * @return mixed
     */
    public function connect(App $app)
    {
        // Support CORS
        $app->options(
            '/{routes:.+}', function (Request $request, Response $response, $args) {
                return $response;
            }
        );

        $app->add(
            function ($request, $response, $next) use ($app) {
                $timestamp = time();
                $tsstring = gmdate('D, d M Y H:i:s ', $timestamp) . 'GMT';
                $etag = md5($timestamp);

                $response = $next($request, $response, $next);
                return $response
                    ->withHeader('Access-Control-Allow-Origin', '*')
                    ->withHeader(
                        'Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin,'
                        . 'Authorization, Content-Length, Cache-Control, Pragma, Expires, Accept-Encoding, X-CSRF-Token'
                    )
                    ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
                    ->withHeader('Access-Control-Expose-Headers', 'Location')
                    ->withHeader('Last-Modified', $tsstring)
                    ->withHeader('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
                    ->withHeader('Pragma', 'no-cache')
                    ->withHeader('Expires', $tsstring)
                    ->withHeader('ETag', $etag);
            }
        );

        // ping
        $app->get(
            '/ping', function (Request $request, Response $response, $args) use ($app) {
                $ping = array('status' => 'ok');

                return $response->withJson($ping);
            }
        );

        $app->add(
            function ($request, $response, $next) use ($app) {
                $request = $request->withAttribute('settings', $app->getContainer()->get('settings')); //add settings
                return $next($request, $response);
            }
        );

        // GET endpoints
        $app->get('/property/list', GetPropertiesController::class . ':execute');


        return $this;
    }
}
