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

namespace SH\Application;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Monolog\Logger;

final class ErrorHandler extends \Slim\Handlers\Error
{
    protected $logger;

    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    // Errors and Exceptions both extend Throwable
    public function __invoke(Request $request, Response $response, \Throwable $exception)
    {
        // Log the message
        $this->logger->error('Unexpected request exception', [$exception]);

        if ($exception instanceof \Exception) {
            return parent::__invoke($request, $response, $exception);
        }
        $body = json_encode(['code' => $exception->getCode()]);

        return $response
            ->withStatus(500)
            ->withHeader('Content-type', 'application/json')
            ->write($body);
    }
}
