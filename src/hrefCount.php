<?php 
namespace emoretti\hrefcount;

use jakeasmith\http_build_url;
use emoretti\hrefcount\hrefCountConfig;
use emoretti\hrefcount\exception\hrefCountException;

require_once(__DIR__."/hrefCountConfig.php"); 
require_once(__DIR__."/Exception/hrefCountException.php"); 

class hrefCount 
{
	protected $configuration;
	protected $db;
	protected $table;

	function __construct()
	{
		$this->configuration = new hrefCountConfig(); 

		$this->db = $this->configuration->DATABASE;

		$this->table = $this->configuration->TABLE_NAME;
	}
 
	function href(string $link = "", string $alias = "")
	{
		try{
			$link = filter_var($link, FILTER_SANITIZE_URL);
			$alias = filter_var($alias, FILTER_SANITIZE_STRING);
			
			$this->createOrUpdateLink($link,$alias);

			$url = parse_url($link);
			
			(isset($url['query']) && strlen($url['query']) > 0) ? $url['query'].="&" : $url['query']='';

			$url['query'] .= $this->configuration->QUERY_STRING_VAR_NAME . "=" . self::strToHex($link."~".$alias);

			echo $this->configuration->BASE_URL . http_build_url($url);

			/*if(isset($url['query']))
			{
				$href = $link . "&" .  $this->configuration->QUERY_STRING_VAR_NAME . "=" . self::strToHex($link."~".$alias);
			}
			elseif (isset($url['fragment'])) 
			{
				$href = str_replace("#".$url['fragment'],'',$link) . "?" . $this->configuration->QUERY_STRING_VAR_NAME . "=" . self::strToHex($link."~".$alias) . "#" .$url['fragment'];
			}
			else
			{
				$href = $link . "?" .  $this->configuration->QUERY_STRING_VAR_NAME . "=" . self::strToHex($link."~".$alias);
			}

			echo $href;*/
			
		}catch(\Exception $e)
		{
			throw new hrefCountException($e->getMessage(),null,$e);
		}
		
	}
 
	private 
	function createOrUpdateLink(string $link, string $alias)
	{
		try{
			$st = $this->db->prepare("SELECT * FROM " . $this->table . " WHERE link = :link ");
			$st->bindParam(':link', $link);
			$st->execute();

			if(count($st->fetchAll()) == 0){
				$stIn = $this->db->prepare("INSERT INTO " . $this->table . " (alias, link) VALUES(:alias , :link)");
				$stIn->bindParam(':alias', $alias);
				$stIn->bindParam(':link', $link);
				$stIn->execute();
			}
		}catch(PDOException $e)
		{
			throw new hrefCountException($e->getMessage(),null,$e);
		}
	}	

	static private
	function strToHex($string)
	{
	    $hex='';
	    for ($i=0; $i < strlen($string); $i++)
	    {
	        $hex .= dechex(ord($string[$i]));
	    }
	    return $hex;
	}
}

?>