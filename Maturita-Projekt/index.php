<!doctype html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Online deníček</title>
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
            <a href="#home" class="nav-link active"><span class="nav-link-span"><span class="u-nav">Domů</span></span></a>
            <a href="#about" class="nav-link"><span class="nav-link-span"><span class="u-nav">Proč</span></span></a>
            <a href="#work" class="nav-link"><span class="nav-link-span"><span class="u-nav">O mně</span></span></a>
            <a href="#contact" class="nav-link"><span class="nav-link-span"><span class="u-nav">Kontakt</span></span></a>
            <a href="prihlaseni.php" class="nav-link"><span class="nav-link-span"><span class="u-nav">Přihlášení</span></span></a>
            <a href="registrace.php" class="nav-link"><span class="nav-link-span"><span class="u-nav">Registrace</span></span></a>

        </div>
    </nav>
</header>
<main>
    <section id="home">
        <h1 class="title">Online Deníček</h1>
        <p class="description">Zaznamenej si své myšlenky moderně</p>
    </section>









    <section id="about">
        <div class="about-container">
            <div class="about-text">
                <h2>Proč psát deník?</h2>
                <p>
                    Psaní deníku může mít mnoho pozitivních účinků na naši psychiku.
                    Pomáhá nám udržovat se v klidu, zlepšuje naši kreativitu, pomáhá nám
                    zpracovat a uvolnit negativní emoce, a mnoho dalšího. Navíc, psaní
                    deníku online ti umožní psát kdykoliv a kdekoliv, a můžeš si tak
                    zapsat své myšlenky okamžitě, když tě napadnou.
                </p>
            </div>
            <div class="about-image">
                <img src="koutek.png" alt="Typing on a notebook">
            </div>
        </div>
    </section>

    <section id="work">
        <div class="work-container">
            <div class="work-text">
                <h2>O autorovi</h2>
                <p>
                    Jsem Adam Antoš a věnuji se seberozvoji a pomáhání lidem. Rád trávím čas ve sportovních aktivitách, čtení knih a učení se nových věcí. Snažím se být pozitivní silou v životech lidí a pomáhat jim dosáhnout svých cílů.
                </p>
            </div>
            <div class="work-image">
                <img src="ja.png" alt="A man in a suit">
            </div>
        </div>
    </section>

    <section id="contact">
        <div class="email-container">
            <div class="work-text">
                <h2>Kontaktujte nás</h2>
                <p>Pokud budete mít jakýkoli dotaz či obchodní nabídku, neváhejte nás kontaktovat na našem emailu:</p>
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