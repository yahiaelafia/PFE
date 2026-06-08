<?php
session_start();
require_once 'db.php';
$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email    = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $password = $_POST["password"];

    if (!empty($email) && !empty($password)) {
        if ($email === "admin@ataa.ma" && $password === "12345") {
            $_SESSION["id"] = 0;
            $_SESSION["email"] = $email;
            $_SESSION["role"] = "admin";
            header("Location: dashbordA.php");
            exit;
        }
        try {
            $stmtM = $pdo->prepare("SELECT id, name, password FROM motatawi3 WHERE email = :email");
            $stmtM->execute([':email' => $email]);
            $userM = $stmtM->fetch(PDO::FETCH_ASSOC);
            if ($userM && password_verify($password, $userM['password'])) {
                $_SESSION["id"] = $userM["id"];
                $_SESSION["email"] = $email;
                $_SESSION["username"] = $userM["name"];
                $_SESSION["role"] = "motatawi3";
                header("Location: index.php");
                exit;
            }
            $stmtA = $pdo->prepare("SELECT id, name, password FROM association WHERE email = :email");
            $stmtA->execute([':email' => $email]);
            $userA = $stmtA->fetch(PDO::FETCH_ASSOC);
            if ($userA && password_verify($password, $userA['password'])) {
                $_SESSION["id"] = $userA["id"];
                $_SESSION["email"] = $email;
                $_SESSION["username"] = $userA["name"];
                $_SESSION["role"] = "association";
                header("Location: DashBords/dashbord.php");
                exit;
            }
            $message = "Email ou mot de passe incorrect.";
        } catch (PDOException $e) {
            $message = "Erreur de base de données.";
        }
    } else {
        $message = "Tous les champs sont obligatoires.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="auth.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <link rel="shortcut icon" href="assets/logovert.png">
    <title>Connexion — Ataa</title>
</head>
<body>
    <div class="container">
        <div class="form-panel">
            <h1>Bienvenue sur <b>Ataa</b></h1>
            <p class="subtitle">Connectez-vous pour continuer</p>

            <?php if ($message): ?>
                <div class="message" style="display:block"><?php echo htmlspecialchars($message); ?></div>
            <?php endif; ?>

            <form method="POST">
                <div class="form-group">
                    <label for="email">Adresse e-mail</label>
                    <div class="input-wrap">
                        <input type="email" id="email" name="email" placeholder="exemple@email.com" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <div class="input-wrap">
                        <input type="password" id="password" name="password" placeholder="••••••••" required>
                        <button type="button" class="toggle-pw"><i class="fa-regular fa-eye"></i></button>
                    </div>
                </div>
                <button type="submit" class="btn-login">
                    <i class="fa-solid fa-right-to-bracket"></i> Connexion
                </button>
                <div class="links">
                    <p>Pas encore de compte ? <a href="choisir.html">Créer un compte</a></p>
                    <p class="footer">&copy; 2026 Ataa. Tous droits réservés.</p>
                </div>
            </form>
        </div>
        <div class="imagefack">
            <img src="assets/logoblanc.png" alt="Ataa">
            <p class="tagline">Ensemble, agissons pour la solidarité.</p>
        </div>
    </div>
    <script src="auth.js"></script>
</body>
</html>
