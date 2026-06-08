<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}
require_once 'db.php';

$stmt = $pdo->prepare("SELECT * FROM offre_benevole ORDER BY id DESC LIMIT 3");
$stmt->execute();
$dernieres_offres = $stmt->fetchAll();

$stmt = $pdo->prepare("SELECT * FROM post_donation ORDER BY id DESC LIMIT 3");
$stmt->execute();
$dernieres_donations = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/logovert.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <link rel="stylesheet" href="index.css">
    <title>Accueil — Ataa</title>
</head>
<body>
    <header>
        <a href="index.php"><img src="assets/logovert.png" alt="Ataa"></a>
        <nav>
            <a href="index.php">Accueil</a>
            <a href="articles.php">Volontariat</a>
            <a href="dotation.php">Donation</a>
            <a href="apropos.php">À propos</a>
            <a href="logout.php" class="exit"><i class="fa-solid fa-right-from-bracket"></i> Déconnecter</a>
        </nav>
    </header>

    <main>
        <div class="articleplus">
            <h1>Dernières offres de bénévolat</h1>
            <a href="articles.php">Voir tout <i class="fa-solid fa-arrow-right"></i></a>
        </div>
        <div class="toutarticles">
            <?php if ($dernieres_offres): foreach ($dernieres_offres as $offre): ?>
                <div class="article">
                    <img src="assets/<?php echo htmlspecialchars($offre['image']); ?>" alt="Image">
                    <h3><?php echo htmlspecialchars($offre['titre']); ?></h3>
                    <div class="footerarticle">
                        <p><i class="fa-solid fa-leaf"></i> Bénévolat</p>
                        <a href="detailV.php?id=<?php echo $offre['id']; ?>">Voir plus</a>
                    </div>
                </div>
            <?php endforeach; else: ?>
                <p style="color:#6b7c6b;padding:20px;">Aucune offre récente à afficher.</p>
            <?php endif; ?>
        </div>

        <div class="articleplus">
            <h1>Derniers appels aux dons</h1>
            <a href="dotation.php">Voir tout <i class="fa-solid fa-arrow-right"></i></a>
        </div>
        <div class="toutarticles">
            <?php if ($dernieres_donations): foreach ($dernieres_donations as $donation): ?>
                <div class="article">
                    <img src="assets/<?php echo htmlspecialchars($donation['image']); ?>" alt="Image">
                    <h3><?php echo htmlspecialchars($donation['titre']); ?></h3>
                    <div class="footerarticle">
                        <p><i class="fa-solid fa-hand-holding-heart"></i> Don</p>
                        <a href="detailD.php?id=<?php echo $donation['id']; ?>">Soutenir</a>
                    </div>
                </div>
            <?php endforeach; else: ?>
                <p style="color:#6b7c6b;padding:20px;">Aucun appel aux dons récent.</p>
            <?php endif; ?>
        </div>
    </main>

    <footer>
        <div>
            <p>&copy; 2026 Ataa. Tous droits réservés.</p>
        </div>
        <div class="menu">
            <p style="font-weight:600;color:#1b2a1b;margin-bottom:6px;">Navigation</p>
            <a href="index.php">Accueil</a>
            <a href="articles.php">Volontariat</a>
            <a href="dotation.php">Donation</a>
            <a href="apropos.php">À propos</a>
        </div>
        <div class="socialmedia">
            <p style="font-weight:600;color:#1b2a1b;margin-bottom:6px;">Suivez-nous</p>
            <div>
                <i class="fab fa-facebook"></i>
                <i class="fa-brands fa-x-twitter"></i>
                <i class="fab fa-instagram"></i>
            </div>
        </div>
        <div class="imagefooter">
            <a href="https://solicode.co/"><img class="solicode" src="assets/solicodenoir.png" alt="Solicode"></a>
            <b class="x">×</b>
            <img src="assets/logonoir.png" alt="Ataa">
        </div>
    </footer>

    <script src="main.js"></script>
</body>
</html>
