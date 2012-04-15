<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<?php 
	if($form->hasGlobalErrors())
		echo $form->getGlobalErrors(); 
 ?>

 
<form action="<?php echo url_for('@whois_domain_validity') ?>" method="post"> 

      <?php echo $form ?><input type="submit" value="Preveri zasedenost" />

</form>