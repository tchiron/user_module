<?php if (isset($error_messages['log'])) : ?>
    <div class="error">
        <?= $error_messages['log'] ?>
    </div>
<?php endif; ?>
<form action="/signin_controller.php" method="post">
    <label for="login">Login : </label>
    <input type="text" name="login" id="login" value="<?= (isset($signin_post['login'])) ? $signin_post['login'] : "" ; ?>">
    <span id="error_login"><?= (isset($error_messages['login'])) ? $error_messages['login'] : '' ; ?></span><br>
    <label for="password">Mot de passe : </label>
    <input type="password" name="password" id="password">
    <span id="error_password"><?= (isset($error_messages['password'])) ? $error_messages['password'] : '' ; ?></span><br>
    <button type="submit">Valider</button>
    <button type="reset">Reset</button>
</form>