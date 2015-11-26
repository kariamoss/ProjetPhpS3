<?php
/**
 * Created by PhpStorm.
 * User: Mathieu
 * Date: 09/11/2015
 * Time: 14:28
 */
defined('BASEPATH') OR exit('No direct script access allowed');
?><div class="row">
    <table>
        <caption>Recapitulatifs des produits</caption>
        <thead>
        <tr><th>id</th><th>Type</th><th>Nom</th><th>Prix</th><th>Photo</th>
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
                        <img style="width:40px;height:40px"
                             src="<?php echo base_url();?>img/<?= $value->photo; ?>"
                             alt="image de <?= $value->libelle; ?>" >
                    </td>
                    <td>
                        <a href="<?php echo site_url("Panier_c/ajouterAuPanier")."/".$value->id; ?>">Ajouter au panier</a>
                    </td>

                    <?php //if(isset($_SESSION['droit']) and $_SESSION['droit']=='DROITadmin'): ?>
                    <?php //endif;?>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        <tbody>
    </table>
</div>


<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>