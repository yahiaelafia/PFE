<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'association') {
    header("Location: ../login.php"); exit;
}
require_once '../db.php';
$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titre        = $_POST['titre'];
    $description  = $_POST['description'];
    $image        = $_FILES['image']['name'];
    $image_tmp    = $_FILES['image']['tmp_name'];
    $association_id = $_SESSION['id'];

    if (!empty($titre) && !empty($description) && !empty($association_id)) {
        move_uploaded_file($image_tmp, "../assets/" . $image);
        try {
            $stmt = $pdo->prepare("INSERT INTO offre_benevole (association_id, image, titre, description) VALUES (:aid,:img,:titre,:desc)");
            $stmt->execute([':aid'=>$association_id,':img'=>$image,':titre'=>$titre,':desc'=>$description]);
            $message = "L'offre a été ajoutée avec succès !";
        } catch (PDOException $e) {
            $message = "Erreur : " . $e->getMessage();
        }
    } else {
        $message = "Veuillez remplir tous les champs.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dashB.css">
    <link rel="shortcut icon" href="../assets/logovert.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <title>Ajouter une offre — Ataa</title>
</head>
<body>
<main>
    <div class="fackimg">
        <div class="logo-wrap"><img src="../assets/logoblanc.png" alt="Ataa"></div>
        <div class="menu">
            <a href="../index.php"><i class="fa-solid fa-house"></i> Accueil</a>
            <a href="dashbord.php"><i class="fa-solid fa-plus"></i> Offre bénévole</a>
            <a href="dashbordDonation.php"><i class="fa-solid fa-hand-holding-heart"></i> Post donation</a>
            <a href="supprime.php"><i class="fa-solid fa-trash"></i> Mes publications</a>
        </div>
        <div class="menufooter">
            <a href="../logout.php" class="exit"><i class="fa-solid fa-right-from-bracket"></i> Déconnecter</a>
        </div>
    </div>

    <div class="container">
        <h1><i class="fa-solid fa-plus" style="color:#2e7d32;"></i> Ajouter une offre bénévole</h1>
        <?php if ($message): ?>
            <div class="success-msg"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>
        <form method="post" enctype="multipart/form-data">
            <label>Image de l'offre</label>
            <input type="file" name="image" accept="image/*">
            <label>Titre</label>
            <input type="text" name="titre" placeholder="Titre de l'offre" required>
            <label>Description</label>
            <textarea name="description" placeholder="Décrivez l'offre de bénévolat…" required></textarea>
            <button type="submit">Publier l'offre</button>
        </form>
    </div>
</main>
<script src="dashboard.js"></script>
</body>
</html>
