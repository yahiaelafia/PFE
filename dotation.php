<?php
session_start();
if (!isset($_SESSION['id'])) { header("Location: login.php"); exit; }
require_once 'db.php';
$stmt = $pdo->prepare("SELECT * FROM post_donation ORDER BY id DESC");
$stmt->execute();
$donations = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/logovert.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <link rel="stylesheet" href="dotation.css">
    <title>Donation — Ataa</title>
</head>
<body>
    <header>
        <a href="index.php"><img src="assets/logovert.png" alt="Ataa"></a>
        <nav>
            <a href="index.php">Accueil</a>
            <a href="articles.php">Volontariat</a>
            <a href="dotation.php">Donation</a>
            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'association'): ?>
            <a href="DashBords/dashbord.php"></i> Tableau de bord</a>
            <?php endif; ?>
            <a href="apropos.php">À propos</a>
            <a href="logout.php" class="exit"><i class="fa-solid fa-right-from-bracket"></i> Déconnecter</a>
        </nav>
    </header>

    <main>
        <h1 style="text-align:center;padding:36px 20px 0;font-size:26px;font-weight:700;">
            Appels aux <span style="color:#2e7d32;">Dons</span>
        </h1>

        <div class="toutarticles">
            <?php if ($donations): foreach ($donations as $donation): ?>
                <div class="article">
                    <img src="assets/<?php echo htmlspecialchars($donation['image']); ?>" alt="Image">
                    <h3><?php echo htmlspecialchars($donation['titre']); ?></h3>
                    <div class="rib-tag">
                        <i class="fa-solid fa-credit-card"></i>
                        RIB : <?php echo htmlspecialchars($donation['rib']); ?>
                    </div>
                    <p><?php echo htmlspecialchars(substr($donation['description'], 0, 90)) . '…'; ?></p>
                    <div class="footerarticle">
                        <a href="detailD.php?id=<?php echo $donation['id']; ?>">
                            Soutenir <i class="fa-solid fa-heart"></i>
                        </a>
                    </div>
                </div>
            <?php endforeach; else: ?>
                <p style="color:#6b7c6b;padding:20px;">Aucun appel aux dons disponible.</p>
            <?php endif; ?>
        </div>
    </main>

    <footer><p>&copy; 2026 Ataa. Tous droits réservés.</p></footer>
    <script src="main.js"></script>
</body>
</html>
