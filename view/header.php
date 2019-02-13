<h3>Bienvenue <em><?= $user->getPseudo() ? $user->getPseudo() :  'cher utilisateur'; ?></em></h3>
<div>
    <a href="/index.php?page=home"><button>Accueil</button></a>
    <a href="/index.php?page=2"><button>Page 2</button></a>
    <a href="/index.php?page=3"><button>Page 3</button></a>
    <?php if ($user->getId()) : ?>
        <a href="/index.php?page=profil"><button>Profil</button></a>
        <a href="/signout.php"><button>Deconnexion</button></a>
    <?php else : ?>
        <a href="/index.php?page=signup"><button>S'enregistrer</button></a>
        <a href="/index.php?page=signin"><button>Connexion</button></a>
    <?php endif; ?>
</div>