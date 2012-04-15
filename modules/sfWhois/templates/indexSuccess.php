<?php include_partial('form', array('form'=>$form)); ?>

<?php include_partial('domainAvailabilityList', array('whoisResult'=>isset($whoisResult)?$whoisResult:null)) ?>