<form action="/signup_controller.php" method="post">
    <label for="pseudo">Pseudo : </label>
    <input type="text" name="pseudo" id="pseudo" value="<?= (isset($signup_post['pseudo'])) ? $signup_post['pseudo'] : "" ; ?>">
    <span id="error_pseudo"><?= (isset($error_messages['pseudo'])) ? $error_messages['pseudo'] : '' ; ?></span><br>
    <label for="email">Email : </label>
    <input type="text" name="email" id="email" value="<?= (isset($signup_post['email'])) ? $signup_post['email'] : "" ; ?>">
    <span id="error_email"><?= (isset($error_messages['email'])) ? $error_messages['email'] : '' ; ?></span><br>
    <label for="password">Mot de passe : </label>
    <input type="password" name="password" id="password">
    <span id="error_password"><?= (isset($error_messages['password'])) ? $error_messages['password'] : '' ; ?></span><br>
    <button type="submit">Valider</button>
    <button type="reset">Reset</button>
</form>