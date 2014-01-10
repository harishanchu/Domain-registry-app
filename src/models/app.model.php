<?php
class AppModel
{
    protected static $mongoCollection="domain";

    public static function insert($input)
    {
        $app = \Slim\Slim::getInstance();
        try
        {
            $collection = self::$mongoCollection;
            $collection = $app->db->$collection;
            $response = $collection->insert($input);

            $app->conn->close();
        }
        catch (MongoConnectionException $e)
        {
            die('Error connecting to MongoDB server');
        } catch (MongoException $e)
        {
            die('Error in app data');
        }
        return $response;
    }

    public static function checkDomainExists($domain)
    {

        $app = \Slim\Slim::getInstance();
        try
        {
            $collection = self::$mongoCollection;
            $collection = $app->db->$collection;
            $reponse = $collection->find(array('domain'=>$domain));

            $app->conn->close();
        }
        catch (MongoConnectionException $e)
        {
            die('Error connecting to MongoDB server');
        } catch (MongoException $e)
        {print_r($e);
            die('Error in app data');
        }
        return count(iterator_to_array($reponse));
    }

    public static function getAllDomains()
    {
        $app = \Slim\Slim::getInstance();
        try
        {
            $collection = self::$mongoCollection;
            $collection = $app->db->$collection;
            $response = $collection->find(array(),array('domain'));

            $app->conn->close();
        }
        catch (MongoConnectionException $e)
        {
            die('Error connecting to MongoDB server');
        } catch (MongoException $e)
        {
            die('Error in app data');
        }
        return iterator_to_array($response);
    }

    public static function getDomainInfo($domain)
    {
        $app = \Slim\Slim::getInstance();
        try
        {
            $collection = self::$mongoCollection;
            $collection = $app->db->$collection;
            $response = $collection->findOne(array('domain'=>$domain));

            $app->conn->close();
        }
        catch (MongoConnectionException $e)
        {
            die('Error connecting to MongoDB server');
        } catch (MongoException $e)
        {
            die('Error in app data');
        }
        return ($response);
    }
}