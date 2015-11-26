<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?><div class="row">
<a href="<?php echo base_url();?>index.php/Produit_c/creerProduit/"> Ajouter un produit </a>
<table>
<caption>Recapitulatifs des produits</caption>
<thead>
<tr><th>id</th><th>type</th><th>nom</th><th>prix</th><th>photo</th>

<th>opération</th>
</tr>
</thead>
<tbody>
<?php  // print_r($produit);?>
<?php if( $produit != NULL): ?>
	<?php foreach ($produit as $value): ?>
		<tr><td>
		<?php echo $value->id; ?>
		</td><td>
		<?= $value->libelle; ?>
		</td><td>
		<?= $value->nom; ?>
		</td><td>
		<?= $value->prix; ?>
		</td><td>
		<?= $value->photo; ?>
		</td><td>
		<img style="width:40px;height:40px" src="<?php echo base_url();?>images/<?= $value->photo; ?>" alt="image de <?= $value->libelle; ?>" >
		</td>
		<?php //if(isset($_SESSION['droit']) and $_SESSION['droit']=='DROITadmin'): ?>
		<td>
			<a href="<?php echo base_url();?>index.php/Produit_c/modifierProduit/<?= $value->id; ?>">modifier</a>
			<a href="<?php echo site_url("Produit_c/supprimerProduit")."/".$value->id; ?>">supprimer</a>
		</td>
		<?php //endif;?>
		</tr>
	<?php endforeach; ?>
<?php endif; ?>
<tbody>
</table>
</div>


<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
