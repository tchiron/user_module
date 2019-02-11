<form action="/signup.php" method="post">
    <label for="pseudo">Pseudo : </label>
    <input type="text" name="pseudo" id="pseudo">
    <span id="error_pseudo"><?= (isset($error_messages['pseudo'])) ? $error_messages['pseudo'] : '' ; ?></span><br>
    <label for="password">Mot de passe : </label>
    <input type="password" name="password" id="password">
    <span id="error_password"><?= (isset($error_messages['password'])) ? $error_messages['password'] : '' ; ?></span><br>
    <button type="submit">Valider</button>
    <button type="reset">Reset</button>
</form>