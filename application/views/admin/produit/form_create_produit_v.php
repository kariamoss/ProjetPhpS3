<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?><form method="post" action="<?php echo site_url('Produit_c/validFormCreerProduit')?>">
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"> 
<div class="row">
	<fieldset>
	<legend>Ajouter un produit</legend>
	<label>Nom 
	<input name="nom"  type="text"  size="18" 	value="<?= set_value('nom');?>"/>
	<?= form_error('nom');?>    </label>

	<label>Type
	<select name="id_type">
	<?php foreach($typeProduit  as $key=>$value) : ?>
		<option value="<?php echo $key; ?>" 
			 <?php if(isset($id_type)  and $id_type==$key): ?> selected="selected" <?php endif; ?> >
		<?php echo $value; ?>
	    </option>
	<?php endforeach; ?>
	</select>
	<?php echo form_error('id_type');?>
	</label>

	<label>Prix
	<input name="prix"  type="text"  size="18"  value="<?= set_value('prix');?>"/>
	<?= form_error('prix');?>  </label>
    <label>Photo
	<input name="photo"  type="text"  size="18" value="<?= set_value('photo');?>"/>
	<?= form_error('photo');?> </label>
	<input type="submit" name="ajouterProduit" value="Creer" />
	</fieldset>	
</div>
</form>