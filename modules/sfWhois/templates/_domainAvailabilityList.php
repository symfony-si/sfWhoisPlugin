<?php if ($whoisResult != null) : ?>
<ul>
<?php foreach($sf_data->getRaw('whoisResult') as $whoisObj) : ?>
<li>
	<?php echo $whoisObj->getDomain()?>&nbsp;

<?php 
	if ($whoisObj->getIsDomainFree())
	{
		echo "Prosta!";
	}
	else
	{
		echo "Zasedena!&nbsp;";
		echo link_to('whois', '@show_whois?domain='.$whoisObj->getDomain(), array('method'=>'post'));
	}
?>
</li>
<?php endforeach ?>
</ul>
<?php endif ?>