<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}
require_once 'db.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: articles.php");
    exit;
}

$id = (int)$_GET['id'];
$stmt = $pdo->prepare("SELECT ob.*, a.name AS association_name FROM offre_benevole ob JOIN association a ON ob.association_id = a.id WHERE ob.id = :id");
$stmt->execute([':id' => $id]);
$offre = $stmt->fetch();

if (!$offre) {
    header("Location: articles.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/logovert.png" type="image">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <link rel="stylesheet" href="articles.css">
    <title><?php echo htmlspecialchars($offre['titre']); ?></title>
    <style>
        .detail-container {
            max-width: 800px;
            margin: 30px auto;
            padding: 20px;
        }
        .detail-container img {
            width: 100%;
            height: 400px;
            object-fit: cover;
            border-radius: 10px;
            display: block;
            position: static;
            transform: none;
            left: auto;
            top: auto;
        }
        .detail-container h1 {
            font-size: 28px;
            margin: 20px 0 10px;
            text-align: left;
        }
        .association-tag {
            color: green;
            font-size: 16px;
            margin-bottom: 20px;
            display: block;
        }
        .description {
            line-height: 1.8;
            color: #444;
            font-size: 16px;
            padding: 0;
        }
        .btn-back {
            display: inline-block;
            margin-top: 25px;
            padding: 10px 22px;
            background: green;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-family: 'outfit';
        }
        .btn-back:hover {
            background: #046702;
        }
        main {
            display: block;
        }
    </style>
</head>
<body>
    <header>
        <a href="index.php"><img src="assets/logovert.png" width="80px" alt="logo"></a>
        <nav>
            <a href="index.php">Accueil</a>
            <a href="articles.php">Volontariat</a>
            <a href="dotation.php">Donation</a>
            <a href="apropos.php">À propos</a>
            <a href="logout.php" class="exit">Se déconnecter</a>
        </nav>
    </header>

    <main>
        <div class="detail-container">
            <img src="assets/<?php echo htmlspecialchars($offre['image']); ?>" alt="Image de l'offre">
            <h1><?php echo htmlspecialchars($offre['titre']); ?></h1>
            <span class="association-tag">
                <i class="fa-solid fa-building"></i> <?php echo htmlspecialchars($offre['association_name']); ?>
            </span>
            <p class="description"><?php echo nl2br(htmlspecialchars($offre['description'])); ?></p>
            <a href="articles.php" class="btn-back"><i class="fa-solid fa-arrow-left"></i> Retour aux offres</a>
        </div>
    </main>

    <footer>
        <p>&copy; 2026 Ataa. Tous droits réservés.</p>
    </footer>
    <script src="main.js"></script>
</body>
</html>
