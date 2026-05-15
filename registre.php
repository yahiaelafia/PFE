<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="auth.css">
    <link rel="shortcut icon" href="assets/logovert.png" type="image">
    <title>Inscription sur Ataa</title>
</head>
<body>
    <div class="container">
        <form  action="login.php" method="POST">
                <h1> Inscrivez-vous sur <b>Ataa</b></h1>
                <br>
                <div class="form-group">
                    <label for="name"> Nom </label>
                    <input type="text" id="name" name="name" placeholder="Votre nom" required>
                </div>
                <div class="form-group">
                    <label for="name">CNI</label>
                    <input type="text" id="cni" name="cni" placeholder="N° de la carte nationale d'identité" required>
                </div>
                <div class="form-group">
                    <label for="email">Adresse e-mail</label>
                    <input type="email" id="email" name="email" placeholder="exemple@email.com" required>
                </div>

                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" name="password" placeholder=" • • • • • • " required>
                </div>

                <button type="submit" class="btn-login">
                    <i class="fa-solid fa-right-to-bracket"></i> Enregistrer
                </button>
                 <div class="links">
                <p>Déja un copmte ?               <a href="login.php">Connexion</a></p>
                <p class="footer">&copy; 2026 Ataa. Tous droits réservés.</p>
                </div>
                </form>
                <div class="imagefack">
                    <img src="assets/logoblanc.png" alt="image blanc">
                </div>
</body>
</html>