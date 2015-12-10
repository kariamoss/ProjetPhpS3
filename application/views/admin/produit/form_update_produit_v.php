<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?><form method="post" action="<?php echo site_url('Produit_c/validFormModifierProduit')?>">
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
<div class="row">
	<fieldset>
	<legend>Modifier un produit</legend>
	<input name="id"  type="hidden" value="<?php echo $produit['id'] ?>"/>
	<label>Nom 
	<input name="nom"  type="text"  size="18" 	value="<?php echo $produit["nom"];?>"/>
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
	<input name="prix"  type="text"  size="18"  value="<?php echo $produit["prix"];?>"/>
	<?= form_error('prix');?>  </label>
	<label>Stock
	<input name="stock"  type="text"  size="18"  value="<?php echo $produit["stock"];?>"/>
	<?= form_error('stock');?>  </label>
    <label>Photo
	<input name="photo"  type="text"  size="18" value="<?php echo $produit["photo"];?>"/>
	<?= form_error('photo');?> </label>
	<input type="submit" name="ModifierProduit" value="Modifier" />
	</fieldset>	
</div>
</form>
