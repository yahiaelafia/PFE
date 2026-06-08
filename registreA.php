<?php
require_once 'db.php';
$message = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name     = trim($_POST['name']);
    $nif      = trim($_POST['nif']);
    $email    = trim($_POST['email']);
    $password = $_POST['password'];
    if (!empty($name) && !empty($nif) && !empty($email) && !empty($password)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO association (name, nif, email, password) VALUES (:name,:nif,:email,:password)");
            $stmt->execute([
                ':name'     => $name,
                ':nif'      => $nif,
                ':email'    => $email,
                ':password' => password_hash($password, PASSWORD_DEFAULT),
            ]);
            header("Location: login.php");
            exit();
        } catch (PDOException $e) {
            $message = ($e->getCode() == 23000)
                ? "Cet email ou ce NIF est déjà utilisé."
                : "Erreur : " . $e->getMessage();
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
    <title>Inscription Association — Ataa</title>
</head>
<body>
    <div class="container">
        <div class="form-panel">
            <h1>Inscrire votre <b>Association</b></h1>
            <p class="subtitle">Créez votre espace association</p>

            <?php if ($message): ?>
                <div class="message" style="display:block"><?php echo htmlspecialchars($message); ?></div>
            <?php endif; ?>

            <form method="POST">
                <div class="form-group">
                    <label for="name">Nom de l'association</label>
                    <div class="input-wrap">
                        <input type="text" id="name" name="name" placeholder="Nom de votre association" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="nif">NIF</label>
                    <div class="input-wrap">
                        <input type="text" id="nif" name="nif" placeholder="Numéro d'Identification Fiscale" required>
                    </div>
                </div>
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
                    <i class="fa-solid fa-building"></i> Créer l'espace
                </button>
                <div class="links">
                    <p>Déjà un compte ? <a href="login.php">Se connecter</a></p>
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
