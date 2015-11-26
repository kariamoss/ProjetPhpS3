<?php
/**
 * Created by PhpStorm.
 * User: Mathieu
 * Date: 10/11/2015
 * Time: 15:54
 */
defined('BASEPATH') OR exit('No direct script access allowed');
?><div class="row">
    <table>
        <caption>Recapitulatifs de votre panier</caption>
        <thead>
        <tr><th>Nom</th><th>Marque</th></th><th>Quantite</th><th>Prix</th><th>Photo</th><th>Actions</th>

        </tr>
        </thead>
        <tbody>
        <?php  // print_r($produit);?>
        <?php if( $panier != NULL): ?>
            <?php foreach ($panier as $value): ?>
                <tr><td>
                        <?= $value->nom; ?>
                    </td><td>
                        <?= $value->libelle; ?>
                    </td><td>
                        <?= $value->quantite; ?>
                    </td><td>
                        <?= $value->prix; ?>
                    </td><td>
                        <img style="width:40px;height:40px"
                             src="<?php echo base_url();?>img/<?= $value->photo; ?>"
                             alt="image de <?= $value->libelle; ?>" >

                    </td>
                    <td>
                        <a href="<?php echo site_url("Panier_c/supprimerDuPanier")."/".$value->id_produit; ?>"
                           class="button tiny round">-</a>
                        <a href="<?php echo site_url("Panier_c/ajouterAuPanier")."/".$value->id_produit; ?>"
                           class="button tiny round">+</a>
                    </td>
                    <?php //if(isset($_SESSION['droit']) and $_SESSION['droit']=='DROITadmin'): ?>
                    <td></td>

                    <?php //endif;?>
                </tr>

            <?php endforeach; ?>

        <?php endif; ?>

        <tbody>
    </table>
</div>
<a href="<?php echo site_url("Panier_c/validerPanier")."/".$value->id_user; ?>"
   class="button tiny">Valider ma commande</a>


<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>