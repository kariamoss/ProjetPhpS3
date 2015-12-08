<?php

defined('BASEPATH') OR exit('No direct script access allowed');
?><div class="row">
    <table>
        <caption>Recapitulatifs de votre commande</caption>
        <thead>
        <tr><th>Nom</th><th>Marque</th></th><th>Quantite</th><th>Prix</th><th>Photo</th>

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
                    <?php //if(isset($_SESSION['droit']) and $_SESSION['droit']=='DROITadmin'): ?>
                    <td></td>

                    <?php //endif;?>
                </tr>

            <?php endforeach; ?>

        <?php endif; ?>

        <tbody>
    </table>
    <a href="<?php echo site_url('Commande_c/displayCommande');?>" class = "button small" >Retour</a>
</div>


