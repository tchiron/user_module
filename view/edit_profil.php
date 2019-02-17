<form action="/profil_controller.php?form=profil" method="post">
    <label for="pseudo">Pseudo : </label>
    <input type="text" name="pseudo" id="pseudo" value="<?= (isset($pseudo)) ? $pseudo : $user->getPseudo(); ?>">
    <span id="error_pseudo"><?= (isset($error_messages['pseudo'])) ? $error_messages['pseudo'] : '' ; ?></span><br>
    <label for="email">Email : </label>
    <input type="text" name="email" id="email" value="<?= (isset($email)) ? $email : $user->getEmail(); ?>">
    <span id="error_email"><?= (isset($error_messages['email'])) ? $error_messages['email'] : '' ; ?></span><br>
    <label for="password">Veuillez entrer votre mot de passe pour vérifier qu'il s'agit bien de votre compte :</label><br>
    <input type="password" name="password" id="password">
    <span id="error_password"><?= (isset($error_messages['password'])) ? $error_messages['password'] : '' ; ?></span><br>
    <button type="submit">Valider</button>
    <button type="reset">Reset</button>
</form>