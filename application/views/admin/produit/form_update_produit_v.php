<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?><form method="post" action="<?php echo site_url('Produit_c/validFormModifierProduit')?>">
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"> 
<div class="row">
	<fieldset>
	<legend>Modifier un produit</legend>
	<input name="id"  type="hidden" value="<?php if(isset($id)) echo $id; ?>"/>
	<label>Nom 
	<input name="nom"  type="text"  size="18" 	value="<?= set_value('nom',$nom);?>"/>
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
	<input name="prix"  type="text"  size="18"  value="<?= set_value('prix',$prix);?>"/>
	<?= form_error('prix');?>  </label>
    <label>Photo
	<input name="photo"  type="text"  size="18" value="<?= set_value('photo',$photo);?>"/>
	<?= form_error('photo');?> </label>
	<input type="submit" name="ModifierProduit" value="Modifier" />
	</fieldset>	
</div>
</form>


<div class="row">
	<fieldset>
<?php
echo form_open("Produit_c/validFormModifierProduit")."\n";
echo form_hidden('id',$id); 
echo form_label('Nom : ', 'nom'); 
echo form_input('nom',set_value('nom',$nom))."\n"; 
echo form_error('nom','<span class="error">',"</span>"); 

echo form_label('type produit : ', 'id_type'); 
echo form_dropdown('id_type', $typeProduit,$id_type); 
echo form_error('id_type','<span class="error">',"</span>"); 
// http://stackoverflow.com/questions/4331078/code-igniter-form-dropdown-selecting-correct-value-from-the-database 

//http://www.w3schools.com/jsref/jsref_obj_regexp.asp 
echo form_label('prix : ', 'prix'); 
$data = array( 
    'name'        => 'prix', 
    'value'       =>  set_value('prix',$prix)
); 
echo form_input($data).'<br>';
echo form_error('prix');

echo form_label('photo : ', 'photo'); 
echo form_input('photo',set_value('photo',$photo))."\n"; 
echo form_error('photo'); 

echo "<br>"; 
echo form_submit("ModifierProduit", "Modifier")."\n"; 
echo form_close()."\n"; 

?> 
</fieldset>	
</div>