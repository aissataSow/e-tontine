<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

require_once 'includes/db.php';
$pageTitle = "À propos";
include 'includes/header.php';
?>

<style>
    .apropos-container {
        max-width: 900px;
        margin: 40px auto;
        padding: 0 20px;
    }

    .apropos-container h1 {
        font-size: 2.5rem;
        color: #2c3e50;
        margin-bottom: 20px;
    }

    .apropos-container p {
        font-size: 1.1rem;
        line-height: 1.8;
        color: #34495e;
        text-align: justify;
    }

    .carousel-title {
        font-size: 1.5rem;
        margin-top: 50px;
        margin-bottom: 20px;
        color: #2d3436;
        text-align: center;
    }

    .partner-carousel {
        overflow: hidden;
        position: relative;
        height: 120px;
        background-color: #f4f4f4;
        border-radius: 12px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    .carousel-track {
        display: flex;
        width: max-content;
        animation: scroll-left 25s linear infinite;
        align-items: center;
    }

    .carousel-track img {
        height: 120px;
        margin: 0 40px;
        /* filter: grayscale(100%); */
        transition: filter 0.3s ease;
    }

    .carousel-track img:hover {
        filter: grayscale(0%);
    }

    @keyframes scroll-left {
        from {
            transform: translateX(100%);
        }
        to {
            transform: translateX(-100%);
        }
    }


    /* section des developpeurs */


    .dev-section {
    margin-top: 60px;
    text-align: center;
}

.dev-cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
    gap: 30px;
    padding: 20px;
}

.dev-card {
    background: #fff;
    padding: 15px;
    border-radius: 12px;
    border: 1px solid #ddd;
    box-shadow: 0 5px 10px rgba(0,0,0,0.05);
    transition: transform 0.2s ease;
    cursor: pointer;
    text-align: center;
}

.dev-card:hover {
    transform: scale(1.03);
    border: 2px solid #007BFF;
}

.dev-card img {
    width: 150px;
    height: 150px;
    object-fit: cover;
    border-radius: 50%;
    margin-bottom: 10px;
}

.dev-card strong {
    display: block;
    margin-bottom: 8px;
    color: #2c3e50;
}

.dev-description {
    display: none;
    font-size: 0.95em;
    color: #555;
    margin-top: 10px;
    animation: fadeIn 0.4s ease-in-out;
    text-align: justify;
}
.dev-description p {
    margin: 0;
    text-align : justify;
    word-break: break-word; /* casse les mots longs comme les emails */
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(5px); }
    to { opacity: 1; transform: translateY(0); }
}


</style>

<div class="apropos-container">
    <h1>À propos de E-Tontine</h1>
    <p>
        E-Tontine est une plateforme numérique moderne dédiée à la gestion sécurisée, transparente et automatisée des tontines entre particuliers. 
        Que vous soyez une association, un groupe d'amis ou une communauté professionnelle, E-Tontine vous permet de créer, rejoindre et gérer 
        vos tontines mensuelles ou annuelles en toute simplicité. Notre objectif est de redonner confiance dans les systèmes d’épargne collective 
        grâce à la technologie. 
    </p>

</div>

 <div class="dev-section">
    <h2 class="carousel-title">Les développeurs</h2>
    <div class="dev-cards">
        <div class="dev-card" onclick="toggleDescription(this)">
            <img src="images/aissatah.jpg" alt="Dev 1">
            <strong>Aissata Houleymata Anne</strong>
            
            <div class="dev-description">Back-end developer.
                <strong> <P>aissatahouleymata.anne@unchk.edu.sn</P></strong>
                 </div>
        </div>
        <div class="dev-card" onclick="toggleDescription(this)">
            <img src="images/Mame_diarra_diop.jpg" alt="Dev 2">
            <strong>Mame Diarra Diop</strong>
            <div class="dev-description">UI/UX Designer.
                <strong> <P>mamediarra.diop14@unchk.edu.sn</P></strong>
            </div>
        </div>
        <div class="dev-card" onclick="toggleDescription(this)">
            <img src="images/Aissata_Alassane_sow .jpg" alt="Dev 3">
            <strong>Aissata Alassane sow </strong>
            <div class="dev-description">Fullstack developer.
                <strong> <P>aissataalassane.sow@unchk.edu.sn</P></strong>
            </div>
        </div>
        <div class="dev-card" onclick="toggleDescription(this)">
            <img src="images/Adama_Hamidou.jpg" alt="Dev 4">
            <strong>Adama Hamidou Sy</strong>
            <div class="dev-description">Front-end.
                <strong> <P>adamahamidou.sy@unchk.edu.sn</P></strong>
            </div>
        </div>
        <div class="dev-card" onclick="toggleDescription(this)">
            <img src="images/ouseynou.jpg" alt="Dev 5">
            <strong>Ousseynou Fall</strong>
            <div class="dev-description">Gestion base de données.
                <strong> <P>Ousseynou.fall3@unchk.edu.sn</P></strong>
            </div>
        </div>
        <div class="dev-card" onclick="toggleDescription(this)">
            <img src="images/dieynaba.jpg" alt="Dev 6">
            <strong>Dieynaba Seck</strong>
            <div class="dev-description">Notifications et mails.
                <strong> <P>dieynaba.seck3@unchk.edu.sn</P></strong>
            </div>
        </div>
        <div class="dev-card" onclick="toggleDescription(this)">
            <img src="images/Samba Diao.jpg" alt="Dev 7">
            <strong>Samba Diao</strong>
            <div class="dev-description">Création des rapports PDF.
                <strong> <P>Samba.diaw4@unchk.edu.sn</P></strong>
            </div>
        </div>
        <div class="dev-card" onclick="toggleDescription(this)">
            <img src="images/Penda.jpg" alt="Dev 8">
            <strong>Penda Ndiaye</strong>
            <div class="dev-description">Chef de projet.
                <strong> <P>penda.ndiaye9@unchk.edu.sn</P></strong>
            </div>
        </div>
        <div class="dev-card" onclick="toggleDescription(this)">
            <img src="images/Maty.jpg" alt="Dev 9">
            <strong>Maty Sarr</strong>
            <div class="dev-description">Suivi GitHub / Trello.
                <strong> <P>maty.sarr4@unchk.edu.sn</P></strong>
            </div>
        </div>
        <div class="dev-card" onclick="toggleDescription(this)">
            <img src="images/dev10.jpg" alt="Dev 10">
            <strong>??????  ????</strong>
            <div class="dev-description">Tests utilisateurs.
                <strong> <P>aissatahouleymata.anne@unchk.edu.sn</P></strong>
            </div>
        </div>
    </div>
</div>




  <h2 class="carousel-title">Nos Partenaires</h2>
    <div class="partner-carousel">
        <div class="carousel-track">
            <img src="images/ecobank.png" alt="Partenaire 1">
            <img src="images/banque_islamique.png" alt="Partenaire 2">
            <img src="images/orange.png" alt="Partenaire 3">
            <img src="images/wave.png" alt="Partenaire 4">
            <img src="images/yas_free.png" alt="Partenaire 5">
            <img src="images/expresso.png" alt="Partenaire 6">
            <!-- Tu peux dupliquer ou en ajouter autant que nécessaire -->
        </div>
    </div>

   <script>
    function toggleDescription(card) {
    const desc = card.querySelector('.dev-description');
    desc.style.display = desc.style.display === 'block' ? 'none' : 'block';
}
</script>


<?php include 'includes/footer.php'; ?>
