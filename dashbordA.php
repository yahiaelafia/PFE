<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}
require_once 'db.php';

$message = '';

if (isset($_GET['delete_offre'])) {
    $id = (int)$_GET['delete_offre'];
    $pdo->prepare("DELETE FROM offre_benevole WHERE id = :id")->execute([':id' => $id]);
    $message = "L'offre de bénévolat a été supprimée.";
}

if (isset($_GET['delete_donation'])) {
    $id = (int)$_GET['delete_donation'];
    $pdo->prepare("DELETE FROM post_donation WHERE id = :id")->execute([':id' => $id]);
    $message = "Le post de donation a été supprimé.";
}

if (isset($_GET['delete_user'])) {
    $id = (int)$_GET['delete_user'];
    $pdo->prepare("DELETE FROM motatawi3 WHERE id = :id")->execute([':id' => $id]);
    $message = "Le volontaire a été supprimé.";
}

if (isset($_GET['delete_assoc'])) {
    $id = (int)$_GET['delete_assoc'];
    $pdo->prepare("DELETE FROM association WHERE id = :id")->execute([':id' => $id]);
    $message = "L'association a été supprimée.";
}

$offres    = $pdo->query("SELECT ob.*, a.name AS assoc_name FROM offre_benevole ob JOIN association a ON ob.association_id = a.id ORDER BY ob.id DESC")->fetchAll();
$donations = $pdo->query("SELECT pd.*, a.name AS assoc_name FROM post_donation pd JOIN association a ON pd.association_id = a.id ORDER BY pd.id DESC")->fetchAll();
$users     = $pdo->query("SELECT * FROM motatawi3 ORDER BY id DESC")->fetchAll();
$assocs    = $pdo->query("SELECT * FROM association ORDER BY id DESC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="DashBords/dashB.css">
    <link rel="shortcut icon" href="assets/logovert.png" type="image">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <title>Tableau de bord Admin</title>
</head>
<body>
    <main>
        <div class="fackimg">
            <div class="logo-wrap"><img src="assets/logoblanc.png" alt="Ataa"></div>
            <div class="menu">
                <a href="#offres"><i class="fa-solid fa-list"></i> Offres bénévoles</a>
                <a href="#donations"><i class="fa-solid fa-hand-holding-heart"></i> Posts de donation</a>
                <a href="#users"><i class="fa-solid fa-users"></i> Volontaires</a>
                <a href="#assocs"><i class="fa-solid fa-building"></i> Associations</a>
            </div>
            <div class="menufooter">
                <a href="logout.php" class="exit">Se déconnecter</a>
            </div>
        </div>

        <div class="container">
            <h1>Tableau de bord Administrateur</h1>

            <?php if (!empty($message)): ?>
                <div class="success-msg"><?php echo htmlspecialchars($message); ?></div>
            <?php endif; ?>

            <div class="tables-section">

                <h2 id="offres">Offres de Bénévolat (<?php echo count($offres); ?>)</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Titre</th>
                            <th>Association</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($offres): foreach ($offres as $o): ?>
                            <tr>
                                <td><img src="assets/<?php echo htmlspecialchars($o['image']); ?>" width="50px" style="border-radius:5px;"></td>
                                <td><?php echo htmlspecialchars($o['titre']); ?></td>
                                <td><?php echo htmlspecialchars($o['assoc_name']); ?></td>
                                <td><?php echo htmlspecialchars(substr($o['description'], 0, 60)) . '...'; ?></td>
                                <td>
                                    <a href="?delete_offre=<?php echo $o['id']; ?>" class="btn-delete" onclick="return confirm('Supprimer cette offre ?')">Supprimer</a>
                                </td>
                            </tr>
                        <?php endforeach; else: ?>
                            <tr><td colspan="5" style="text-align:center;color:#777;">Aucune offre.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>

                <h2 id="donations">Posts de Donation (<?php echo count($donations); ?>)</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Titre</th>
                            <th>Association</th>
                            <th>RIB</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($donations): foreach ($donations as $d): ?>
                            <tr>
                                <td><img src="assets/<?php echo htmlspecialchars($d['image']); ?>" width="50px" style="border-radius:5px;"></td>
                                <td><?php echo htmlspecialchars($d['titre']); ?></td>
                                <td><?php echo htmlspecialchars($d['assoc_name']); ?></td>
                                <td><?php echo htmlspecialchars($d['rib']); ?></td>
                                <td>
                                    <a href="?delete_donation=<?php echo $d['id']; ?>" class="btn-delete" onclick="return confirm('Supprimer ce post ?')">Supprimer</a>
                                </td>
                            </tr>
                        <?php endforeach; else: ?>
                            <tr><td colspan="5" style="text-align:center;color:#777;">Aucun post de donation.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>

                <h2 id="users">Volontaires (<?php echo count($users); ?>)</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>CNI</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($users): foreach ($users as $u): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($u['name']); ?></td>
                                <td><?php echo htmlspecialchars($u['email']); ?></td>
                                <td><?php echo htmlspecialchars($u['cni']); ?></td>
                                <td>
                                    <a href="?delete_user=<?php echo $u['id']; ?>" class="btn-delete" onclick="return confirm('Supprimer ce volontaire ?')">Supprimer</a>
                                </td>
                            </tr>
                        <?php endforeach; else: ?>
                            <tr><td colspan="4" style="text-align:center;color:#777;">Aucun volontaire.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>

                <h2 id="assocs">Associations (<?php echo count($assocs); ?>)</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>NIF</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($assocs): foreach ($assocs as $a): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($a['name']); ?></td>
                                <td><?php echo htmlspecialchars($a['email']); ?></td>
                                <td><?php echo htmlspecialchars($a['nif']); ?></td>
                                <td>
                                    <a href="?delete_assoc=<?php echo $a['id']; ?>" class="btn-delete" onclick="return confirm('Supprimer cette association ?')">Supprimer</a>
                                </td>
                            </tr>
                        <?php endforeach; else: ?>
                            <tr><td colspan="4" style="text-align:center;color:#777;">Aucune association.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>

            </div>
        </div>
    </main>
    <script src="DashBords/dashboard.js"></script>
</body>
</html>
