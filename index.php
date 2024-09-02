<?php session_start();
include_once 'public/lib/fonksiyon.php';
include_once 'public/lib/tasarim.php';

$sinif = new kurumsal();
$tas = new tasarim();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <title><?php echo $sinif->title; ?></title>
    <meta name="title" content="<?php echo $sinif->metatitle; ?>">
    <meta name="description" content="<?php echo $sinif->metadesc; ?>">
    <meta name="keyword" content="<?php echo $sinif->metakey; ?>">
    <meta name="author" content="<?php echo $sinif->metaauthor; ?>">
    <meta name="owner" content="<?php echo $sinif->metaowner; ?>">
    <meta name="copyright" content="<?php echo $sinif->metacopy; ?>">


    <!-- Kütüphaneler -->
    <script src="public/lib/jquery/jquery.min.js"></script>
    <script src="public/lib/jquery/jquery-migrate.min.js"></script>
    <script src="public/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="public/lib/easing/easing.min.js"></script>
    <script src="public/lib/superfish/hoverIntent.js"></script>
    <script src="public/lib/superfish/superfish.min.js"></script>
    <script src="public/lib/wow/wow.min.js"></script>
    <script src="public/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="public/lib/magnific-popup/magnific-popup.min.js"></script>
    <script src="public/lib/sticky/sticky.js"></script>
    <script src="public/js/main.js"></script>


    <!-- Fontlar -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800|Montserrat:300,400,700"
          rel="stylesheet">

    <!-- Bootstrap stil dosyası -->
    <link href="public/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- işimize yarayacak diğer kütüphane css dosyalarımız -->
    <link href="public/lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="public/lib/animate/animate.min.css" rel="stylesheet">
    <link href="public/lib/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="public/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="public/lib/magnific-popup/magnific-popup.css" rel="stylesheet">
    <link href="public/lib/ionicons/css/ionicons.min.css" rel="stylesheet">

    <!-- bizim stil dosyamız -->
    <link href="public/css/style.css" rel="stylesheet">

    <script>
        $(document).ready(function (e) {
            $('#bultensonuc').hide();

            $("#gonderbtn").click(function () {
                $.ajax({
                    type: "POST",
                    url: 'public/lib/mail/gonder.php',
                    data: $('#mailform').serialize(),
                    success: function (donen) {
                        $('#mailform').trigger("reset");
                        $('#formtutucu').fadeOut(500);
                        $('#mesajsonuc').html(donen);
                    },
                });
            });

            $("#bultenbtn").click(function () {
                $.ajax({
                    type: "POST",
                    url: 'public/lib/islem.php?islem=bultenislem',
                    data: $('#bultenform').serialize(),
                    success: function (donen) {
                        $('#bultenform').trigger("reset");
                        $('#bultentutucu').fadeOut();
                        $('#bultensonuc').html(donen).fadeIn();
                    },
                });
            });
        });
    </script>

</head>

<body id="body">

<!-- ÜST BAR -->

<section id="topbar" class="d-none d-lg-block">
    <div class="container clearfix">

        <div class="contact-info float-left">
            <i class="fa fa-envelope-o"></i><a
                    href="mailto:<?php echo $sinif->mailadres; ?>"><?php echo $sinif->mailadres; ?></a>
            <i class="fa fa-phone"></i><?php echo $sinif->telefonno; ?>

        </div>
        <div class="social-links float-right">
            <a href="<?php echo $sinif->twit; ?>" class="twitter"><i class="fa fa-twitter"></i></a>
            <a href="<?php echo $sinif->face; ?>" class="facebook"><i class="fa fa-facebook"></i></a>
            <a href="<?php echo $sinif->inst; ?>" class="instagram"><i class="fa fa-instagram"></i></a>

            <a href="index.php?dil=tr" class="twitter">TR</a>
            <a href="index.php?dil=en" class="twitter">EN</a>
        </div>
    </div>

</section>

<?php
@$dil = $_GET['dil'];

if ($dil == "tr" || $dil == "en"):
    @$_SESSION['dil'] = $dil;
    header("Location:index.php");

elseif (!isset($_SESSION['dil'])):
    $_SESSION['dil'] = "tr";
endif;
?>


<!-- header -->

<header id="header">

    <div class="container">

        <div id="logo" class="pull-left">
            <h1><a href="#body" class="scrollto"><?php echo $sinif->logoyazisi; ?></a></h1>


        </div>


        <nav id="nav-menu-container">
            <ul class="nav-menu">
                <?php $sinif->linkler($baglanti); ?>
            </ul>
        </nav>

    </div>


</header>


<!-- İNTRO -->

<section id="intro">


    <div class="intro-content">
        <h2><?php echo $sinif->slogan; ?></h2>


    </div>


    <div id="intro-carousel" class="owl-carousel">

        <?php $sinif->introbak($baglanti); ?>

    </div>


</section>

<!-- ana main -->
<main id="main">

            <?php $sinif->hakkimizda($baglanti); ?>

    <!-- ana main -->


    <!-- Hizmet burda -->
    <?php $tas->HizmettasarimDuzen(@$baglanti); ?>


    <!-- referanslar -->
    <?php $tas->ReftasarimDuzen(@$baglanti); ?>


    <!-- Filomuz -->
    <section id="filo" class="wow fadeInUp">

        <?php $sinif->filomuz($baglanti); ?>

    </section>

    <!-- Videolar -->
    <?php $tas->VideotasarimDuzen(@$baglanti); ?>

    <!-- müşteri Yorumlar -->
    <?php $tas->YorumtasarimDuzen(@$baglanti); ?>


    <!-- iletişim -->

    <section id="iletisim" class="wow fadeInUp">

        <div class="container">


            <div class="section-header">
                <h2><?php echo $sinif->iletisimUstbaslik; ?></h2>
                <p><?php echo $sinif->iletisimbaslik; ?></p>
            </div>

            <div class="row contact-info">

                <div class="col-md-4">
                    <div class="contact-address">
                        <i class="ion-ios-location-outline"></i>
                        <h3><?php echo $sinif->adresBilgi; ?></h3>
                        <address><?php echo $sinif->adres; ?></address>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="contact-phone">
                        <i class="ion-ios-telephone-outline"></i>
                        <h3><?php echo $sinif->telefonBilgi; ?></h3>
                        <p><a href="tel:<?php echo $sinif->telefonno; ?>"><?php echo $sinif->telefonno; ?></a></p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="contact-email">
                        <i class="ion-ios-email-outline"></i>
                        <h3><?php echo $sinif->mailBilgi; ?></h3>
                        <p><a href="mailto:<?php echo $sinif->mailadres; ?>"><?php echo $sinif->mailadres; ?></a></p>
                    </div>
                </div>


            </div>

        </div>

        <div class="container mb-4">
            <iframe src="<?php echo $sinif->haritabilgi; ?>"
                    width="100%" height="380" frameborder="0" style="border:0" allowfullscreen></iframe>

        </div>


        <div class="container">
            <div class="form">

                <div id="mesajsonuc"></div>

                <div id="formtutucu">
                    <form id="mailform">

                        <div class="form-row">

                            <div class="form-group col-md-6">
                                <input type="text" name="isim" class="form-control"
                                       placeholder="<?php echo $sinif->adBilgi; ?>"
                                       required="required"/>

                            </div>

                            <div class="form-group col-md-6">
                                <input type="text" name="mailadres" class="form-control"
                                       placeholder="<?php echo $sinif->mailForm; ?>"
                                       required="required"/>

                            </div>
                        </div>


                        <div class="form-group">
                            <input type="text" name="konu" class="form-control"
                                   placeholder="<?php echo $sinif->konuBilgi; ?>"
                                   required="required"/>
                        </div>

                        <div class="form-group">
                            <textarea class="form-control" name="mesaj" rows="5"></textarea>
                        </div>


                        <div class="text-center"><input type="button" value="<?php echo $sinif->butonBilgi; ?>"
                                                        id="gonderbtn"
                                                        class="btn btn-info"/>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </section>


</main>

<!-- footer -->

<footer id="footer">

    <div class="container">

        <div class="row">

            <div class="col-lg-4">

                <?php $tas->BultentasarimDuzen(@$baglanti); ?>

            </div>

            <div class="col-lg-4">
                <div class="copyright">
                    <?php echo $sinif->footer; ?>
                </div>
                <div class="credits">
                    <?php echo $sinif->metaowner; ?>
                </div>
            </div>

        </div>

    </div>
</footer>
<a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>


</body>
</html>
