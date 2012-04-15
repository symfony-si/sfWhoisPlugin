<?php
class sfDomainForm extends sfForm
{
  protected $validDomainExtensions=null;
  
  public function setup()
  {
  	$this->validDomainExtensions=sfConfig::get('app_valid_domain_extensions');
  	
    $this->setWidgets(array(
      'domain'    => new sfWidgetFormInputText()
    ));
	
    $this->setValidators(array(
      'domain'          => new sfValidatorRegex(array('pattern'=>$this->getDomainRegexPattern(true)), array('invalid'=>'Domena ni veljavna', 'required'=>'Vnesi domeno!'))
    ));

    $this->widgetSchema->setNameFormat('sf_domain[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }
  
  private function getDomainRegexPattern($woExt = false)
  {
  	$pattern = '/^[a-zA-Z0-9\-]+'.(!$woExt?'\.':'(\.').'('.$this->validDomainExtensions.')'.($woExt?')?':'').'$/i';
  	return $pattern;
  }
  
  public function getDomainInfo($deepInfo = false)
  {
  	$checkDomain = trim($this->getValue('domain'));
  	
	$result = array();
	
	if ($this->loopDefaultExtensions())
	{
		foreach(explode('|', sfConfig::get('app_default_domain_extensions')) as $ext)
		{
			$domain = $checkDomain.'.'.trim($ext);

			$whois = new sfWhois();
			$whois->setDeepWhois($deepInfo);
			$whois->Lookup($domain);
			
			$result[]=$whois; 
		}
	}
	else
	{
		$domain = $checkDomain;
		$whois = new sfWhois();
		$whois->setDeepWhois($deepInfo);
		$whois->Lookup($domain);
			
		$result[]=$whois; 
	}
		
	return $result;
  }
  
  private function loopDefaultExtensions()
  {
  	if (preg_match($this->getDomainRegexPattern(), $this->getValue('domain')))
  		return false;
  	return true;
  }
}