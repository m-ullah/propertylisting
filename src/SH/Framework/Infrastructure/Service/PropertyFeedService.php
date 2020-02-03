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

namespace SH\Framework\Infrastructure\Service;
use SH\Application\Exception\XMLParserException;

/**
 * Class PropertyFeedService
 *
 * @package SH\Framework\Infrastructure\Service
 */
final class PropertyFeedService
{

    public function __construct()
    {
    }

    /**
     * @param  $filename
     * @return \SimpleXMLElement
     * @throws XMLParserException
     */
    public function fetchXMLFeed($filename)
    {
        // read from file and return raw xml file
        try {
            return simplexml_load_file($filename);
        } catch (\Exception $e) {
            throw new XMLParserException('Unable to fetch xml feed');
        }
    }

    /**
     * @param  $filename
     * @return string
     * @throws XMLParserException
     */
    public function curlFetchXMLFeed($filename)
    {
        // read from remote feed
        try {
            $ch = curl_init('https://www.youtube.com/feeds/videos.xml?playlist_id=PLC02CFDE5690E4010');
            curl_setopt($ch, CURLOPT_HEADER, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            $output = curl_exec($ch);
            $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
        } catch (\Exception $e) {
            throw new XMLParserException('Unable to fetch xml feed');
        }
        $json = json_encode($output);
        return $json;
    }
}
