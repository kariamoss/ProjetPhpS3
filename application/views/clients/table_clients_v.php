<?php
/**
 * Created by PhpStorm.
 * User: Mathieu
 * Date: 06/12/2015
 * Time: 18:33
 */

defined('BASEPATH') OR exit('No direct script access allowed');
?><div class="row">
    <meta charset="utf-8">
    <table>
        <caption>Liste des Clients enregistrés</caption>
        <thead>
        <tr><th>ID</th><th>Email</th><th>Password</th><th>Login</th><th>Nom</th><th>Code Postal</th><th>Ville</th><th>Adresse</th>
        <th>Validé</th>
        </tr>
        </thead>
        <tbody>
        <?php  // print_r($produit);?>
        <?php if( $clients != NULL): ?>
            <?php foreach ($clients as $value): ?>
                <tr><td>
                        <?= $value->id_user; ?>
                    </td><td>
                        <?= $value->email; ?>
                    </td><td>
                        <?= $value->password; ?>
                    </td><td>
                        <?= $value->login; ?>
                    </td><td>
                        <?= $value->nom; ?>
                    </td><td>
                        <?= $value->code_postal; ?>
                    </td><td>
                        <?= $value->ville; ?>
                    </td><td>
                        <?= $value->adresse; ?>
                    </td><td>
                        <?= $value->valide; ?>
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


