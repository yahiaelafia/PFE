<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="auth.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <link rel="shortcut icon" href="assets/logovert.png" type="image">
    <title>Connexion à Ataa</title>
</head>
<body>
    <div class="container">
        <form  action="login.php" method="POST">
                <h1>Bienvenue sur <b>Ataa</b></h1>
                <br>
                <div class="form-group">
                    <label for="email">Adresse e-mail</label>
                    <input type="email" id="email" name="email" placeholder="exemple@email.com" required>
                </div>

                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" name="password" placeholder=" • • • • • • " required>
                </div>

                <button type="submit" class="btn-login">Connexion</button>
                <div class="links">
                <p>Pas un copmte ?               <a href="choisir.html">Créer le compte</a></p>
                <p class="footer">&copy; 2026 Ataa. Tous droits réservés.</p>
                </div>
            </form>
            <div class="imagefack">
                <img src="assets/logoblanc.png" alt="image blanc">
            </div>
        </div>
    </main>
</body>
</html>