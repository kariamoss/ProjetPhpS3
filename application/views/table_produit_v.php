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
        <caption>Recapitulatifs des produits</caption>
        <thead>
        <tr><th>id</th><th>type</th><th>nom</th><th>prix</th><th>photo</th>

            <th>op�ration</th>
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
                        <img style="width:40px;height:40px" src="<?php echo base_url();?>img/<?= $value->photo; ?>" alt="image de <?= $value->libelle; ?>" >
                    </td>
                    <?php //if(isset($_SESSION['droit']) and $_SESSION['droit']=='DROITadmin'): ?>
                    <td>
                    </td>
                    <?php //endif;?>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        <tbody>
    </table>
</div>
