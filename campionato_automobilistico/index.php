<?php
$title ="Homepage";
require "base/header.php";
?>
<section class="bg-dark text-white py-4">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <h1 class="display-4  mb-4">Benvenuti nel Portale Ufficiale del Campionato Automobilistico 2023!</h1>
                <p class="lead mb-0">
                    Segui tutto il campionato in tempo reale: risultati, classifiche, statistiche e molto altro. Che tu sia un fan accanito o un nuovo appassionato, qui troverai tutto ciò che ti serve per vivere l'emozione delle corse. Scopri i piloti, le squadre e le gare che stanno scrivendo la storia di questa stagione!
                </p>
            </div>
        </div>
    </div>
</section>
<div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active" data-bs-interval="10000">
            <img src="style/images/image1.jpg" class="d-block w-100" alt="image1">
        </div>
        <div class="carousel-item" data-bs-interval="2000">
            <img src="style/images/image2.jpg" class="d-block w-100" alt="image2">
        </div>
        <div class="carousel-item">
            <img src="style/images/image3.jpg" class="d-block w-100" alt="image3">
        </div>
        <div class="carousel-item">
            <img src="style/images/image4.webp" class="d-block w-100" alt="image4">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
<?php require "base/footer.php"?>
