<form action="/profil_controller.php?form=password" method="post">
    <label for="old_password">Ancien mot de passe : </label>
    <input type="password" name="old_password" id="old_password">
    <span id="error_old_password"><?= (isset($error_messages['old_password'])) ? $error_messages['old_password'] : '' ; ?></span><br>
    <label for="new_password">Nouveau mot de passe : </label>
    <input type="password" name="new_password" id="new_password">
    <span id="error_new_password"><?= (isset($error_messages['new_password'])) ? $error_messages['new_password'] : '' ; ?></span><br>
    <label for="confirm_password">Confimez votre nouveau mot de passe :</label>
    <input type="password" name="confirm_password" id="confirm_password">
    <span id="error_confirm_password"><?= (isset($error_messages['confirm_password'])) ? $error_messages['confirm_password'] : '' ; ?></span><br>
    <button type="submit">Valider</button>
    <button type="reset">Reset</button>
</form>