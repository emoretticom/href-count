<?php 
namespace emoretti\hrefcount;

use emoretti\hrefcount\hrefCountConfig;

require_once(__DIR__."/hrefCountConfig.php"); 

class hrefCountEndpoint
{
	protected $configuration;
	protected $db;
	protected $table;
	protected $link;
	protected $alias;

	function __construct()
	{
		$this->configuration = new hrefCountConfig(); 
		$this->db = $this->configuration->DATABASE;
		$this->table = $this->configuration->TABLE_NAME;

		if(isset($_GET[$this->configuration->QUERY_STRING_VAR_NAME])){
			$str = explode("~",self::hexToStr($_GET[$this->configuration->QUERY_STRING_VAR_NAME]));
			$link = filter_var($str[0], FILTER_SANITIZE_URL);
			$this->increaseLinkCount($link);
		}
	}


	private 
	function increaseLinkCount(string $link){
		$st = $this->db->prepare("UPDATE " . $this->table . " SET count = count + 1 WHERE link = :link" );
		$st->bindParam(":link" , $link);
		$st->execute();
	}


	static private
	function hexToStr($hex)
	{
	    $string='';
	    for ($i=0; $i < strlen($hex)-1; $i+=2)
	    {
	        $string .= chr(hexdec($hex[$i].$hex[$i+1]));
	    }
	    return $string;
	}
}
?>