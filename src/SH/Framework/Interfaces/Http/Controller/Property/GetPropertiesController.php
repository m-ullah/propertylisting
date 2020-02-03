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

namespace SH\Framework\Interfaces\Http\Controller\Property;

use SH\Framework\Infrastructure\Service\PropertyFeedService;
use SH\Framework\Interfaces\Http\Controller\HttpQueryController;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class GetPropertiesController
 *
 * @package SH\Framework\Interfaces\Http\Controller\Property
 */
final class GetPropertiesController extends HttpQueryController
{
    private $currencyService;

    public function __construct(PropertyFeedService $currencyService)
    {
        $this->currencyService = $currencyService;
    }

    /**
     * @param  ServerRequestInterface $request
     * @return \Slim\Http\Response
     */
    public function execute(ServerRequestInterface $request)
    {
        $route = $request->getQueryParams();
        $params = ['sort' => isset($route['sort']) ? $route['sort'] : null, 'limit' => isset($route['limit']) ? (int)$route['limit'] : null];
        $properties = $this->propertyRepository->readAll($params);

        if (count($properties) > 0) {
            return $this->responseFactory->response($properties, 'json');
        }
        $result['status'] = 'error';
        return $this->responseFactory->response([], 'json', 404);
    }

}
