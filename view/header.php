<h3>Bienvenue <em><?= $user->getPseudo() ? $user->getPseudo() :  'cher utilisateur'; ?></em></h3>
<div>
    <a href="/home_controller.php?page=home"><button>Accueil</button></a>
    <a href="/home_controller.php?page=2"><button>Page 2</button></a>
    <a href="/home_controller.php?page=3"><button>Page 3</button></a>
    <?php if ($user->getId()) : ?>
        <a href="/home_controller.php?page=profil"><button>Profil</button></a>
        <a href="/signout_controller.php"><button>Deconnexion</button></a>
    <?php else : ?>
        <a href="/home_controller.php?page=signup"><button>S'enregistrer</button></a>
        <a href="/home_controller.php?page=signin"><button>Connexion</button></a>
    <?php endif; ?>
</div>