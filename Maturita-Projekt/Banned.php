<?php
?>




<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Warning</title>
    <link rel="stylesheet" href="styltest.css">
</head>
<body>

<header id="nav-wrapper">
<nav id="nav">
    <div class="nav left">
        <span class="gradient skew">
          <h1 class="logo un-skew"><a href="#home">OnlineD</a></h1>
        </span>
        <button id="menu" class="btn-nav"><span class="fas fa-bars"></span></button>
    </div>
    <div class="nav right">
        <a href="#home" class="nav-link active"><span class="nav-link-span"><span class="u-nav">Blokace</span></span></a>
        <a href="#about" class="nav-link "><span class="nav-link-span"><span class="u-nav">Proč?</span></span></a>
        <a href="#work" class="nav-link "><span class="nav-link-span"><span class="u-nav">Kontakt</span></span></a>
        <a href="logout.php" class="nav-link "><span class="nav-link-span"><span class="u-nav">Odhlásit se</span></span></a>

    </div>
</nav>
</header>
<main>
    <section id="home">
        <h1 class="title">Něco se pokazilo</h1>
        <p class="description">Byl si zablokován více si přecti ↓</p>
    </section>

    <section id="about">
        <h1 class="title">Proč si byl zablokován?</h1>
        <p class="description">Zde jsou pravděpodobé důvody proč jsi byl zablokován</p>

        <ul class="ban-reasons">
            <li>Nepřiměřené chování vůči ostatním uživatelům.</li>
            <li>Porušení pravidel týkajících se obsahu.</li>
            <li>Opakované porušování pravidel a podmínek služby.</li>
            <li>Podvodné činnosti, jako je například spamování.</li>
            <li>Porušení autorských práv.</li>
            <li>Neplatná registrace účtu.</li>
            <li>Nenávistný obsah a šíření nenávisti.</li>
            <li>Zneužívání služeb pro šíření škodlivého obsahu.</li>
        </ul>
    </section>

    <section id="contact">
        <div class="work-container">
            <div class="work-text">
                <h2>Kontaktujte nás</h2>
                <p>Pokud budete mít jakýkoli dotaz či se domíváte, že vám byla blokace udělena neprávem, neváhejte nás kontaktovat na našem emailu:</p>
                <a href="mailto:adam.antos@educanet.cz" class="contact-link">adam.antos@educanet.cz</a>
            </div>
        </div>
    </section>
</main>




<footer>
    <p>Author: Adam Antoš<br>
        <a href="#">onlinedenicek@gmail.com</a></p>
</footer>











</body>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    var util = {
        mobileMenu() {
            $("#nav").toggleClass("nav-visible");
        },
        windowResize() {
            if ($(window).width() > 800) {
                $("#nav").removeClass("nav-visible");
            }
        },
        scrollEvent() {
            var scrollPosition = $(document).scrollTop();

            $.each(util.scrollMenuIds, function(i) {
                var link = util.scrollMenuIds[i],
                    container = $(link).attr("href"),
                    containerOffset = $(container).offset().top,
                    containerHeight = $(container).outerHeight(),
                    containerBottom = containerOffset + containerHeight;

                if (scrollPosition < containerBottom - 20 && scrollPosition >= containerOffset - 20) {
                    $(link).addClass("active");
                } else {
                    $(link).removeClass("active");
                }
            });
        }
    };

    $(document).ready(function() {

        util.scrollMenuIds = $("a.nav-link[href]");
        $("#menu").click(util.mobileMenu);
        $(window).resize(util.windowResize);
        $(document).scroll(util.scrollEvent);

    });
</script>
</html>
