<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><form method="post" action="<?php echo site_url('Users_c/validFormCoordonnes')?>">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
    <div class="row">
        <fieldset>
            <legend>Modifier vos coordonnées</legend>
            <input name="id"  type="hidden" value="<?php echo $coordonnees['id_user'] ?>"/>
            <label>Email
                <input name="email"  type="text"  size="18" 	value="<?php echo $coordonnees["email"]?>"/>
                <?= form_error('email');?>    </label>

            <label>Login
                <input name="login"  type="text"  size="18"  value="<?php echo $coordonnees["login"];?>"/>
                <?= form_error('login');?>  </label>
            <label>Password
                <input name="password"  type="text"  size="18" value="<?php echo $coordonnees["password"];?>"/>
                <?= form_error('password');?> </label>
            <label>Nom
                <input name="nom"  type="text"  size="18" value="<?php echo $coordonnees["nom"];?>"/>
                <?= form_error('nom');?> </label>
            <label>Code Postal
                <input name="code_postal"  type="text"  size="18" value="<?php echo $coordonnees["code_postal"];?>"/>
                <?= form_error('code_postal');?> </label>
            <label>Ville
                <input name="ville"  type="text"  size="18" value="<?php echo $coordonnees["ville"];?>"/>
                <?= form_error('ville');?> </label>
            <label>Adresse
                <input name="adresse"  type="text"  size="18" value="<?php echo $coordonnees["adresse"];?>"/>
                <?= form_error('adresse');?> </label>
            <input type="submit" name="ModifierCoordonnes" value="Modifier" />
        </fieldset>
    </div>
</form>
