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

namespace SH\Framework\Infrastructure\Storage\PDO;

use SH\Framework\Infrastructure\Storage\StorageAdapterInterface;
use SH\Framework\Infrastructure\ServiceProvider\PDOServiceProvider;
use PDO;
use Monolog\Logger;

/**
 * Class TransactionAdapter
 *
 * @package SH\Framework\Infrastructure\Storage\PDO
 */
class TransactionAdapter implements StorageAdapterInterface
{
    protected $logger;
    protected $dbProvider;
    protected $db;

    /**
     * TransactionAdapter constructor.
     *
     * @param Logger             $logger
     * @param PDOServiceProvider $pdoServiceProvider
     */
    public function __construct(
        Logger $logger,
        PDOServiceProvider $pdoServiceProvider
    ) {
        $this->logger = $logger;
        $this->dbProvider = $pdoServiceProvider;
        $this->db = $this->dbProvider->getConnection();
    }

    /**
     * @param  $params
     * @return bool
     * @throws \Exception
     */
    public function save($params)
    {
        try {
            $statement = $this->db->prepare('INSERT OR REPLACE INTO "property" ("property_id", "data") VALUES (:property_id, :value) ');
            $statement->bindValue('property_id', $params->getPropertyId());
            $statement->bindValue('value', $params->getValue());
            $result = $statement->execute();

            $this->logger->debug('Db SAVE: ', $params->toArray());
            return true;

        } catch (\PDOException $e) {
            throw $e;
            $this->logger->log(500, $e);

        } catch (\Exception $e) {
            throw $e;
            $this->logger->log(500, $e);
        }
    }

    /**
     * @param  null $params
     * @return array
     * @throws \Exception
     */
    public function read($params = null)
    {
        $propertyId = isset($params['property_id']) ? $params['property_id'] : null;
        $limit = isset($params['limit']) ? $params['limit'] : 3000;
        $order = isset($params['sort']) ? $params['sort'] : 'date';

        try {
            if (!empty($propertyId)) {
                $statement = $this->db->prepare('SELECT property_id, data FROM "property" WHERE "property_id" =:property_id');
                $statement->bindValue('property_id', $propertyId);
            } else {
                $statement = $this->db->prepare('SELECT data FROM "property"  ORDER BY :order ASC LIMIT :limit');
                $statement->bindValue('limit', $limit);
                $statement->bindValue('order', $order);

            }

            $result = $statement->execute();

            $this->logger->debug('Db READ: ' . $params);
            $rows = [];
            while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
                $rows [] = json_decode($row['data']);
            }
            return $rows;
        } catch (\PDOException $e) {
            throw $e;
            $this->logger->log(500, $e);

        } catch (\Exception $e) {
            throw $e;
            $this->logger->log(500, $e);
        }
    }

    /**
     * @param $params
     */
    public function delete($params)
    {

    }
}
