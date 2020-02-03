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

namespace SH\Framework\Interfaces\Http\ServiceProvider\Response;

use Slim\Http\Response;

/**
 * Class ResponseFactory
 *
 * @package SH\Framework\Interfaces\Http\ServiceProvider\Response
 */
class ResponseFactory implements ResponseFactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function response($data = '', $type = 'json', $code = 200)
    {
        $response = new Response();

        // 200 - OK
        // 201 - Created
        // 202 - Accepted
        // 204 - No Content

        switch ($type) {
        case 'json':
            return $response->withJson($data)->withStatus($code);
                break;
        default:
            return $response->withStatus(200, 'OK');
        }
    }
}
