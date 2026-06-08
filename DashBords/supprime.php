<?php
session_start();
if (!isset($_SESSION['id'])) { header("Location: ../login.php"); exit(); }
require_once '../db.php';
$message = '';
$association_id = $_SESSION['id'];

if (isset($_GET['delete_offre'])) {
    $pdo->prepare("DELETE FROM offre_benevole WHERE id=:id AND association_id=:aid")
        ->execute([':id'=>(int)$_GET['delete_offre'],':aid'=>$association_id]);
    $message = "L'offre a été supprimée.";
}
if (isset($_GET['delete_donation'])) {
    $pdo->prepare("DELETE FROM post_donation WHERE id=:id AND association_id=:aid")
        ->execute([':id'=>(int)$_GET['delete_donation'],':aid'=>$association_id]);
    $message = "Le post de donation a été supprimé.";
}

$offres   = $pdo->prepare("SELECT * FROM offre_benevole WHERE association_id=:aid");
$offres->execute([':aid'=>$association_id]); $offres = $offres->fetchAll();

$donations = $pdo->prepare("SELECT * FROM post_donation WHERE association_id=:aid");
$donations->execute([':aid'=>$association_id]); $donations = $donations->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dashB.css">
    <link rel="shortcut icon" href="../assets/logovert.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <title>Mes publications — Ataa</title>
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
        <h1><i class="fa-solid fa-layer-group" style="color:#2e7d32;"></i> Mes publications</h1>

        <?php if ($message): ?>
            <div class="success-msg"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>

        <div class="tables-section">
            <h2>Offres de bénévolat (<?php echo count($offres); ?>)</h2>
            <table>
                <thead><tr><th>Image</th><th>Titre</th><th>Description</th><th>Action</th></tr></thead>
                <tbody>
                    <?php if ($offres): foreach ($offres as $o): ?>
                        <tr>
                            <td><img src="../assets/<?php echo htmlspecialchars($o['image']); ?>" width="50" style="border-radius:6px;"></td>
                            <td><?php echo htmlspecialchars($o['titre']); ?></td>
                            <td><?php echo htmlspecialchars(substr($o['description'],0,60)).'…'; ?></td>
                            <td><a href="supprime.php?delete_offre=<?php echo $o['id']; ?>" class="btn-delete">Supprimer</a></td>
                        </tr>
                    <?php endforeach; else: ?>
                        <tr><td colspan="4" style="text-align:center;color:#6b7c6b;">Aucune offre.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <h2>Posts de donation (<?php echo count($donations); ?>)</h2>
            <table>
                <thead><tr><th>Image</th><th>Titre</th><th>RIB</th><th>Action</th></tr></thead>
                <tbody>
                    <?php if ($donations): foreach ($donations as $d): ?>
                        <tr>
                            <td><img src="../assets/<?php echo htmlspecialchars($d['image']); ?>" width="50" style="border-radius:6px;"></td>
                            <td><?php echo htmlspecialchars($d['titre']); ?></td>
                            <td><?php echo htmlspecialchars($d['rib']); ?></td>
                            <td><a href="supprime.php?delete_donation=<?php echo $d['id']; ?>" class="btn-delete">Supprimer</a></td>
                        </tr>
                    <?php endforeach; else: ?>
                        <tr><td colspan="4" style="text-align:center;color:#6b7c6b;">Aucun post.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>
<script src="dashboard.js"></script>
</body>
</html>
