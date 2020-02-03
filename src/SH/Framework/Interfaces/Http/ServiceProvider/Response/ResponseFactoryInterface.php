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
 * Interface ResponseFactoryInterface
 *
 * @package SH\Framework\Interfaces\Http\ServiceProvider\Response
 */
interface ResponseFactoryInterface
{
    /**
     * Returns a response
     *
     * @param string $type The type of response
     * @param string $data The content of the response
     * @param int    $code The response code
     *
     * @return Response
     */
    public function response($data = '', $type = 'json', $code = 201);
}
