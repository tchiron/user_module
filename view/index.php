<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="/public/css/main.css" />
    <script src="/public/js/script.js"></script>
</head>
<body>
    <header>
        <?php include VIEW . '/header.php'; ?>
    </header>
    <section>
        <?php switch ($page) {
            case 'signup':
                include VIEW . '/signup.php';
                break;

            case 'signin':
                include VIEW . '/signin.php';
                break;

            case 'profil':
                include VIEW . '/profil.php';
                break;

            case 'edit_profil':
                include VIEW . '/edit_profil.php';
                break;

            case 'home':
            default:
                include VIEW . '/home.php';
                break;
        } ?>
    </section>
</body>
</html>