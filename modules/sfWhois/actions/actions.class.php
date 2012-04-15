<?php
class sfWhoisActions extends sfActions
{
	public function executeIndex(sfWebRequest $request)
	{
		$this->form = new sfDomainForm();
	}
	
	public function executeCheckValidity(sfWebRequest $request)
	{
		$this->forward404Unless($request->getMethod() == sfWebRequest::POST);
		
		$this->form = new sfDomainForm();
		
	  	$this->form->bind(
    		$request->getParameter($this->form->getName()),
    		$request->getFiles($this->form->getName())
  		);
 
  		if ($this->form->isValid())
  		{
 			$this->whoisResult = $this->form->getDomainInfo();
  		}
  		$this->setTemplate('index');
	}
	
	public function executeShow(sfWebRequest $request)
	{
		$this->forward404Unless($request->getMethod() == sfWebRequest::POST);
		$this->forward404Unless($domain = $request->getParameter('domain'));
		
		$whois = new sfWhois();
		$whois->setDeepWhois(true);
		$whois->Lookup($domain);
		
		$this->winfo = $whois->__toString();
	}
}
?>