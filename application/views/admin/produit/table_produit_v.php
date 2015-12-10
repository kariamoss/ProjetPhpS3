<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?><div class="row">
<a href="<?php echo base_url();?>index.php/Produit_c/creerProduit/"> Ajouter un produit </a>
<table>
<caption>Recapitulatifs des produits</caption>
	</br></br><span style="color:red" > Les produits en rouge doivent être réapprovisionnés</span></br>
<thead>
<tr><th>id</th><th>type</th><th>nom</th><th>Stock restant</th><th>prix</th><th>photo</th>

<th>opération</th>
</tr>
</thead>
<tbody>
<?php  // print_r($produit);?>

<?php if( $produit != NULL): ?>

	<?php foreach ($produit as $value): ?>
		<tr><td>
				<span <?php if($value->stock <= 5){ echo 'style="color:red"'; }
				else { echo 'style="color:black"'; } ?> >
		<?php echo $value->id; ?></span>
		</td><td>
				<span <?php if($value->stock <= 5){ echo 'style="color:red"'; }
				else { echo 'style="color:black"'; } ?> >
		<?= $value->libelle; ?></span>
		</td><td>
		<span <?php if($value->stock <= 5){ echo 'style="color:red"'; }
		else { echo 'style="color:black"'; } ?> ><?= $value->nom; ?></span>
		</td><td>
			<span <?php if($value->stock <= 5){ echo 'style="color:red"'; }
				else { echo 'style="color:black"'; } ?> ><?= $value->stock; ?> </span>
		</td><td>
				<span <?php if($value->stock <= 5){ echo 'style="color:red"'; }
				else { echo 'style="color:black"'; } ?> >
		<?= $value->prix; ?></span>
		</td>><td>
				<img style="width:40px;height:40px" src="<?php echo base_url();?>img/<?= $value->photo; ?>" alt="image de <?= $value->libelle; ?>" >
			</td>
		<?php //if(isset($_SESSION['droit']) and $_SESSION['droit']=='DROITadmin'): ?>
		<td>
			<a href="<?php echo site_url("Produit_c/modifierProduit")."/".$value->id; ?>">modifier</a>
			<a href="<?php echo site_url("Produit_c/supprimerProduit")."/".$value->id; ?>">supprimer</a>
		</td>
		<?php //endif;?>
		</tr>
	<?php endforeach; ?>
<?php endif; ?>
</tbody>
</table>
</div>

