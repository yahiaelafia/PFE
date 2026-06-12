<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/logovert.png" type="image logo vert">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <link rel="stylesheet" href="apropos.css">
    <title>À propos d'Ataa</title>
</head>
<body>
     <header>
        <a href="index.php"><img src="assets/logovert.png" width="80px" alt="image logo vert"></a>
        <nav>
            <a href="index.php">Accueil</a>
            <a href="articles.php">Volontariat</a>
            <a href="dotation.php">Donation</a>
            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'association'): ?>
            <a href="DashBords/dashbord.php"></i> Tableau de bord</a>
            <?php endif; ?>
            <a href="apropos.php">À propos</a>
            <a href="logout.php" class="exit">Se déconnecter</a>
        </nav>
    </header>
    <main>
        <div class="apropos">
            <h2>À propos d'Ataa </h2>
                <p><b>Ataa</b>, est une plateforme numérique marocaine dédiée à la promotion du volontariat et de la solidarité sociale. Notre mission est de transformer l'envie d'aider en actions concrètes en simplifiant la connexion entre ceux qui veulent donner et ceux qui sont sur le terrain.</p>
        </div>


        <div class="fackcards">
            <article>
                <h3>Pourquoi Ataa ?</h3>
                <p>Ce projet répond à un besoin réel, celui de fédérer les efforts de solidarité. Il ne s'agit pas simplement d'un site web, mais d'un système complet conçu pour encourager la coopération mutuelle et faciliter la mise en œuvre de projets d'intérêt général au Maroc.</p>
            </article>
            <article>
                <h3>Notre Vision</h3>
                <p>Nous croyons en un Maroc où chaque citoyen peut contribuer positivement à sa communauté. Ataa aspire à construire un réseau solide de volontaires engagés, capables de répondre aux besoins sociaux les plus urgents avec efficacité et bienveillance.</p>
            </article>
            <article>
                <h3>Comment ça marche ?</h3>
                <p>Inscrivez-vous sur la plateforme, parcourez les missions de volontariat disponibles près de chez vous, et rejoignez une équipe engagée. Que ce soit pour quelques heures ou plusieurs semaines, chaque action compte et fait la différence.</p>
            </article>
        </div>
        <div class="sponsors">
            <h3>Nos partenaires</h3>
            <article >
                <img src="assets/tarbiya.png" width= "300px" alt="Img">
                <img src="assets/solicodebleu.jpg" width="300px" alt="solicode">
            </article>
        </div>
    </main>
        <footer>
        <p>&copy; 2026 Ataa. Tous droits réservés.</p>
        <div class="menu">
            <p style="font-weight:600;margin-bottom:6px;">Menu principal :</p>
            <a href="index.php">Accueil</a>
            <a href="article.php">Volontariat</a>
            <a href="dotation.php">Donation</a>
            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'association'): ?>
            <a href="DashBords/dashbord.php"></i> Tableau de bord</a>
            <?php endif; ?>
            <a href="apropos.php">À propos</a>
        </div> 
        <div class="socialmedia">
        <p style="font-weight:600;margin-bottom:6px;">Suiver nous:</p>
            <div> 
        <i class="fab fa-facebook"></i>
        <i class="fa-brands fa-x-twitter"></i>
        <i class="fab fa-instagram"></i>
             </div>
        </div>
            <div>
                <div class="imagefooter">
                    <a href="https://solicode.co/"><img class="solicode" src="assets/solicodenoir.png" alt="solicode"></a><b class="x">X</b><img src="assets/logonoir.png" alt="">
                </div>
    </footer>
    <script src="main.js"></script>
</body>
</html>