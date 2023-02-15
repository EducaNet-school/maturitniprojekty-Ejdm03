<!doctype html>
<html lang="en">
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
            <a href="#work" class="nav-link"><span class="nav-link-span"><span class="u-nav">O nás</span></span></a>
            <a href="#contact" class="nav-link"><span class="nav-link-span"><span class="u-nav">Kontakt</span></span></a>
        </div>
    </nav>
</header>
<main>
    <section id="home">
        <h1> Pes</h1>
    </section>
    <section id="about">
        <h1>Lasdadaw</h1>
    </section>
    <section id="work">

    </section>
    <section id="contact">

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