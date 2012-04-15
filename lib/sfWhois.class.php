<?php
class sfWhois extends Whois
{
	protected $queryResult  = null;
	protected $isDomainFree = false;
	protected $domain = '';
	
	function Lookup($query = '', $is_utf = true)
	{
		$this->domain = $query;
		$this->queryResult=parent::Lookup($query, $is_utf);	
	}
	
	public function getDomain()
	{
		return $this->domain;
	}
	
	function getResult()
	{
		return $this->queryResult;
	}
	
	public function setDeepWhois($bool=true)
	{
		$this->deep_whois=$bool;
	}
	
	public function getIsDomainFree()
	{

		if(isset($this->queryResult['regrinfo']['registered']))
			return !($this->queryResult['regrinfo']['registered']=='yes');
		return true;
	}
	
	function __toString()
	{
		$utils = new utils;
			
		return $this->winfo = $utils->showHTML($this->getResult());
	}
	
	//private 
}

?>