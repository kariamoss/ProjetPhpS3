<?php

defined('BASEPATH') OR exit('No direct script access allowed');
?><div class="row">
    <table>
        <caption> Commandes </caption>
        <thead>
        <tr><th>Etat</th><th>Commande n&deg;</th><th>Prix</th><th>Date Commande</th>
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
                    </td>


                    <?php //if(isset($_SESSION['droit']) and $_SESSION['droit']=='DROITadmin'): ?>
                    <?php //endif;?>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        <tbody>
    </table>
</div>

