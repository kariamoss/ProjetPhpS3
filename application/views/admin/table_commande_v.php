<?php
/**
 * Created by PhpStorm.
 * User: Mathieu
 * Date: 07/12/2015
 * Time: 13:57
 */


defined('BASEPATH') OR exit('No direct script access allowed');
?><div class="row">
    <table>
        <caption> Administration des commandes </caption>
        <thead>
        <tr><th>Etat</th><th>Commande n&deg;</th><th>Prix</th><th>Date Commande</th><th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php if( $commande != NULL): ?>
            <?php foreach ($commande as $value): ?>
                <tr><td>
                        <?= $value->libelle; ?>
                    </td><td>
                        <?= $value->id_commande; ?>
                    </td><td>
                        <?= $value->prix; ?>
                    </td><td>
                        <?= $value->date_achat;?>
                    </td><td>
                        <a href="<?php echo site_url("Commande_c/validerCommande")."/".$value->id_commande; ?>">Valider la commande</a>
                        <a href="<?php echo site_url("Commande_c/supprimerCommande")."/".$value->id_commande; ?>">supprimer</a>
                    </td>
                    <?php //endif;?>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        <tbody>
    </table>
</div>

