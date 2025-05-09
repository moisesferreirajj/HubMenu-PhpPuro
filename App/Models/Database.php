<?php

require_once 'global.php';

use PDO;
use PDOException;
use stdClass;

class Database
{
    // properties
    private $_host;
    private $_database;
    private $_username;
    private $_password;
    private $_port;
    private $_return_type;

    public function __construct($return_type = 'object')
    {
        // set connection configuration
        $this->_host = DB_HOST;
        $this->_database = DB_NAME;
        $this->_username = DB_USER;
        $this->_password = DB_PASSWORD;
        $this->_port = DB_PORT;

        // sets return type
        if (!empty($return_type) && $return_type == 'object') {
            $this->_return_type = PDO::FETCH_OBJ;
        } else {
            $this->_return_type = PDO::FETCH_ASSOC;
        }
    }

    public function execute_query($sql, $parameters = null)
    {
        // executes a query with results

        // connection
        $connection = new PDO(
            'mysql:host=' . $this->_host . ';port=' . $this->_port . ';dbname=' . $this->_database . ';charset=utf8',
            $this->_username,
            $this->_password,
            array(PDO::ATTR_PERSISTENT => true)
        );

        $results = null;

        try {

            $db = $connection->prepare($sql);
            if (!empty($parameters)) {
                $db->execute($parameters);
            } else {
                $db->execute();
            }

            $results = $db->fetchAll($this->_return_type);
        } catch (PDOException $err) {

            // close connection
            $connection = null;

            // return error
            return $this->_result('error', $err->getMessage(), $sql, null, 0, null);
        }

        // close connection
        $connection = null;

        // return results
        return $this->_result('success', 'success', $sql, $results, $db->rowCount(), null);
    }

    public function execute_non_query($sql, $parameters = null)
    {
        // executes a query without results

        // connection
        $connection = new PDO(
            'mysql:host=' . $this->_host . ';port=' . $this->_port . ';dbname=' . $this->_database . ';charset=utf8',
            $this->_username,
            $this->_password,
            array(PDO::ATTR_PERSISTENT => true)
        );

        // init transaction
        $connection->beginTransaction();

        // prepare and execute the query
        try {
            
            $db = $connection->prepare($sql);
            if (!empty($parameters)) {
                $db->execute($parameters);
            } else {
                $db->execute();
            }

            // last inserted id
            $last_inserted_id = $connection->lastInsertId();

            // finish transaction
            $connection->commit();

        } catch (PDOException $err) {

            // undo all sql operations on error
            $connection->rollBack();

            // close connection
            $connection = null;

            // return error
            return $this->_result('error', $err->getMessage(), $sql, null, 0, null);
        }

        // close connection
        $connection = null;

        // return results
        return $this->_result('success', 'success', $sql, null, $db->rowCount(), $last_inserted_id);
    }

    private function _result($status, $message, $sql, $results, $affected_rows, $last_id)
    {
        $tmp = new stdClass;
        $tmp->status = $status;
        $tmp->message = $message;
        $tmp->query = $sql;
        $tmp->results = $results;
        $tmp->affected_rows = $affected_rows;
        $tmp->last_id = $last_id;
        return $tmp;
    }
}