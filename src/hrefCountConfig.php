<?php
namespace emoretti\hrefcount;

use emoretti\hrefcount\exception\hrefCountException;
use PDO;
use PDOException;

class hrefCountConfig
{
    // Your Website base url (Ex: http://www.yousite.com)
    private $BASE_URL = "http://www.yoursite.com";

    // The query string get variable that will be included in any link
    private $QUERY_STRING_VAR_NAME = "qs";

    //Configuration for PDO MYSQL DATABASE
    /*
    Configuration settings for PDO MYSQL DATABASE
    
    If you doesn't use MYSQL you can modify the class method db_connect as needed
    */
    private $DATABASE_HOST = "localhost";
    private $DATABASE_NAME = "test";
    private $DATABASE_USR = "root";
    private $DATABASE_PWD = "";
    private $TABLE_NAME = "href_count";

    /*
    *
    *
    *
    * 
		!!!  ---- DON'T MODIFY BEYOND IF YOU DON'T KNOW WHAT YOU ARE DOING ---- !!!
	*
	*
	*
	*
	* 
    */
    private $DATABASE = null;

    /**
     * [__construct of the class hrefCountConfig]
     */
    public function __construct()
    {
        $this->db_connect();
    }

    /**
     * [__get magic method of class hrefConfig]
     * @param  [string] $conf [the configuration needed]
     * @return [string|object] [The class argument requested]
     */
    public function __get($conf)
    {
        return (array_key_exists($conf, get_object_vars($this))) ? $this->$conf : null;
    }

    /**
     * [db_connect create an PDO instance for database]
     * @return [null]
     */
    private function db_connect()
    {
        try
        {
            $this->DATABASE = new PDO('mysql:host=' . $this->DATABASE_HOST . ';dbname=' . $this->DATABASE_NAME, $this->DATABASE_USR, $this->DATABASE_PWD);
            $this->DATABASE->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->DATABASE->setAttribute(PDO::ATTR_PERSISTENT, true);
            $this->DATABASE->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        }
        catch(PDOException $e)
        {
            throw new hrefCountException("Error in db connection", 1);
        }
    }

}
?>