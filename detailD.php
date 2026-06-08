<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}
require_once 'db.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: dotation.php");
    exit;
}

$id = (int)$_GET['id'];
$stmt = $pdo->prepare("SELECT pd.*, a.name AS association_name FROM post_donation pd JOIN association a ON pd.association_id = a.id WHERE pd.id = :id");
$stmt->execute([':id' => $id]);
$donation = $stmt->fetch();

if (!$donation) {
    header("Location: dotation.php");
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
    <link rel="stylesheet" href="dotation.css">
    <title><?php echo htmlspecialchars($donation['titre']); ?></title>
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
            font-family: 'outfit';
        }
        .association-tag {
            color: green;
            font-size: 16px;
            margin-bottom: 15px;
            display: block;
        }
        .rib-box {
            background: #f4f4f4;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 12px 16px;
            margin: 15px 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
        }
        .rib-box span {
            font-weight: bold;
            font-size: 16px;
            color: #333;
        }
        .btn-copy {
            background: green;
            color: white;
            border: none;
            padding: 7px 14px;
            border-radius: 6px;
            cursor: pointer;
            font-family: 'outfit';
            font-size: 14px;
        }
        .btn-copy:hover {
            background: #046702;
        }
        .description {
            line-height: 1.8;
            color: #444;
            font-size: 16px;
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
            <img src="assets/<?php echo htmlspecialchars($donation['image']); ?>" alt="Image du don">
            <h1><?php echo htmlspecialchars($donation['titre']); ?></h1>
            <span class="association-tag">
                <i class="fa-solid fa-building"></i> <?php echo htmlspecialchars($donation['association_name']); ?>
            </span>

            <div class="rib-box">
                <span><i class="fa-solid fa-credit-card" style="color:green;"></i> RIB : <?php echo htmlspecialchars($donation['rib']); ?></span>
                <button class="btn-copy" onclick="copyRib('<?php echo htmlspecialchars($donation['rib']); ?>')">
                    <i class="fa-regular fa-copy"></i> Copier
                </button>
            </div>

            <p class="description"><?php echo nl2br(htmlspecialchars($donation['description'])); ?></p>
            <a href="dotation.php" class="btn-back"><i class="fa-solid fa-arrow-left"></i> Retour aux dons</a>
        </div>
    </main>

    <footer>
        <p>&copy; 2026 Ataa. Tous droits réservés.</p>
    </footer>

    <script src="main.js"></script>
</body>
</html>
