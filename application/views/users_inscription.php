<div class="row">
    <div class="panel">
        <?php echo form_open('Users_c/validFormInscription'); ?>

        <label for="login">login:</label>
        <input type="text" name="login" value="<?php echo set_value('login');?>" />
        <?php echo form_error('login','<span class="error">',"</span>");?>
        <br>

        <label for="email">email:</label>
        <input type="text" name="email" value="<?php echo set_value('email');?>" />
        <?php echo form_error('email','<span class="error">',"</span>");?>
        <br>

        <label for="pass">Mot de passe:</label>
        <input type="password" name="pass" value="<?= set_value('pass');?>" />
        <?php echo form_error('pass','<span class="error">',"</span>");?>
        <br>
        <label for="pass2">confirmation Mot de passe:</label>
        <input type="password" name="pass2" value="<?= set_value('pass2');?>" />
        <?php echo form_error('pass2','<span class="error">',"</span>");?>
        <br>
        <?php if(isset($erreur))echo '<span class="error">'.$erreur."</span>";?>
        <input type="submit" value="Envoyer" />

        <?php echo form_close(); ?>
        <p><?= anchor('users_c/mdp_oublie','Mot de passe oublié ?')?></p>
    </div>
</div>
