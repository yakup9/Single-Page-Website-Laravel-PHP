<?php
ob_start();
try {
    $baglanti = new PDO("mysql:host=localhost;dbname=kurumsal;charset=utf8", "root", "");
    $baglanti->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die($e->getMessage());
}

class yonetim
{
    private $veriler = array();

    public function sorgum($vt, $sorgu, $tercih = 0)
    {
        $al = $vt->prepare($sorgu);
        $al->execute();

        if ($tercih == 1):
            return $al->fetch();
        elseif ($tercih == 2):
            return $al;
        endif;
    }


    public function siteayar($baglanti)
    {
        $sonuc = self::sorgum($baglanti, "select * from ayarlar", 1);

        if ($_POST):
            $title = htmlspecialchars($_POST['title']);
            $metatitle = htmlspecialchars($_POST['metatitle']);
            $metadesc = htmlspecialchars($_POST['metadesc']);
            $metakey = htmlspecialchars($_POST['metakey']);
            $metaauthor = htmlspecialchars($_POST['metaauthor']);
            $metaowner = htmlspecialchars($_POST['metaowner']);
            $metacopy = htmlspecialchars($_POST['metacopy']);
            $logoyazisi = htmlspecialchars($_POST['logoyazisi']);
            $twit = htmlspecialchars($_POST['twit']);
            $face = htmlspecialchars($_POST['face']);
            $inst = htmlspecialchars($_POST['inst']);
            $telefonno = htmlspecialchars($_POST['telefonno']);
            $adres = htmlspecialchars($_POST['adres']);
            $mailadres = htmlspecialchars($_POST['mailadres']);
            $slogan_tr = htmlspecialchars($_POST['slogan_tr']);
            $slogan_en = htmlspecialchars($_POST['slogan_en']);
            $referansbaslik_tr = htmlspecialchars($_POST['referansbaslik_tr']);
            $referansbaslik_en = htmlspecialchars($_POST['referansbaslik_en']);
            $referansUstBaslik_tr = htmlspecialchars($_POST['referansUstBaslik_tr']);
            $referansUstBaslik_en = htmlspecialchars($_POST['referansUstBaslik_en']);
            $filobaslik_tr = htmlspecialchars($_POST['filobaslik_tr']);
            $filobaslik_en = htmlspecialchars($_POST['filobaslik_en']);
            $filoUstBaslik_tr = htmlspecialchars($_POST['filoUstBaslik_tr']);
            $filoUstBaslik_en = htmlspecialchars($_POST['filoUstBaslik_en']);
            $yorumbaslik_tr = htmlspecialchars($_POST['yorumbaslik_tr']);
            $yorumbaslik_en = htmlspecialchars($_POST['yorumbaslik_en']);
            $yorumUstBaslik_tr = htmlspecialchars($_POST['yorumUstBaslik_tr']);
            $yorumUstBaslik_en = htmlspecialchars($_POST['yorumUstBaslik_en']);
            $iletisimbaslik_tr = htmlspecialchars($_POST['iletisimbaslik_tr']);
            $iletisimbaslik_en = htmlspecialchars($_POST['iletisimbaslik_en']);
            $iletisimUstBaslik_tr = htmlspecialchars($_POST['iletisimUstBaslik_tr']);
            $iletisimUstBaslik_en = htmlspecialchars($_POST['iletisimUstBaslik_en']);
            $hizmetlerbaslik_tr = htmlspecialchars($_POST['hizmetlerbaslik_tr']);
            $hizmetlerbaslik_en = htmlspecialchars($_POST['hizmetlerbaslik_en']);
            $hizmetlerUstBaslik_tr = htmlspecialchars($_POST['hizmetlerUstBaslik_tr']);
            $hizmetlerUstBaslik_en = htmlspecialchars($_POST['hizmetlerUstBaslik_en']);
            $videobaslik_tr = htmlspecialchars($_POST['videobaslik_tr']);
            $videobaslik_en = htmlspecialchars($_POST['videobaslik_en']);
            $videoUstBaslik_tr = htmlspecialchars($_POST['videoUstBaslik_tr']);
            $videoUstBaslik_en = htmlspecialchars($_POST['videoUstBaslik_en']);
            $haritabilgi = htmlspecialchars($_POST['haritabilgi']);
            $footer = htmlspecialchars($_POST['footer']);
            $mesajtercih = htmlspecialchars($_POST['mesajtercih']);

            $guncelleme = $baglanti->prepare("update ayarlar set title=?,metatitle=?,metadesc=?,metakey=?,
                   metaauthor=?,metaowner=?,metacopy=?,logoyazisi=?,twit=?,face=?,inst=?,telefonno=?,adres=?,
                   mailadres=?,slogan_tr=?,slogan_en=?,referansbaslik_tr=?,referansbaslik_en=?,referansUstBaslik_tr=?,
                   referansUstBaslik_en=?,filobaslik_tr=?,filobaslik_en=?,filoUstBaslik_tr=?,filoUstBaslik_en=?,
                   yorumbaslik_tr=?,yorumbaslik_en=?,yorumUstBaslik_tr=?,yorumUstBaslik_en=?,iletisimbaslik_tr=?,iletisimbaslik_en=?,
                   iletisimUstBaslik_tr=?,iletisimUstBaslik_en=?,hizmetlerbaslik_tr=?,hizmetlerbaslik_en=?,hizmetlerUstBaslik_tr=?,
                   hizmetlerUstBaslik_en=?,videobaslik_tr=?,videobaslik_en=?,videoUstBaslik_tr=?,videoUstBaslik_en=?,
                   haritabilgi=?,footer=?,mesajtercih=?");
            $guncelleme->bindParam(1, $title, PDO::PARAM_STR);
            $guncelleme->bindParam(2, $metatitle, PDO::PARAM_STR);
            $guncelleme->bindParam(3, $metadesc, PDO::PARAM_STR);
            $guncelleme->bindParam(4, $metakey, PDO::PARAM_STR);
            $guncelleme->bindParam(5, $metaauthor, PDO::PARAM_STR);
            $guncelleme->bindParam(6, $metaowner, PDO::PARAM_STR);
            $guncelleme->bindParam(7, $metacopy, PDO::PARAM_STR);
            $guncelleme->bindParam(8, $logoyazisi, PDO::PARAM_STR);
            $guncelleme->bindParam(9, $twit, PDO::PARAM_STR);
            $guncelleme->bindParam(10, $face, PDO::PARAM_STR);
            $guncelleme->bindParam(11, $inst, PDO::PARAM_STR);
            $guncelleme->bindParam(12, $telefonno, PDO::PARAM_STR);
            $guncelleme->bindParam(13, $adres, PDO::PARAM_STR);
            $guncelleme->bindParam(14, $mailadres, PDO::PARAM_STR);
            $guncelleme->bindParam(15, $slogan_tr, PDO::PARAM_STR);
            $guncelleme->bindParam(16, $slogan_en, PDO::PARAM_STR);
            $guncelleme->bindParam(17, $referansbaslik_tr, PDO::PARAM_STR);
            $guncelleme->bindParam(18, $referansbaslik_en, PDO::PARAM_STR);
            $guncelleme->bindParam(19, $referansUstBaslik_tr, PDO::PARAM_STR);
            $guncelleme->bindParam(20, $referansUstBaslik_en, PDO::PARAM_STR);
            $guncelleme->bindParam(21, $filobaslik_tr, PDO::PARAM_STR);
            $guncelleme->bindParam(22, $filobaslik_en, PDO::PARAM_STR);
            $guncelleme->bindParam(23, $filoUstBaslik_tr, PDO::PARAM_STR);
            $guncelleme->bindParam(24, $filoUstBaslik_en, PDO::PARAM_STR);
            $guncelleme->bindParam(25, $yorumbaslik_tr, PDO::PARAM_STR);
            $guncelleme->bindParam(26, $yorumbaslik_en, PDO::PARAM_STR);
            $guncelleme->bindParam(27, $yorumUstBaslik_tr, PDO::PARAM_STR);
            $guncelleme->bindParam(28, $yorumUstBaslik_en, PDO::PARAM_STR);
            $guncelleme->bindParam(29, $iletisimbaslik_tr, PDO::PARAM_STR);
            $guncelleme->bindParam(30, $iletisimbaslik_en, PDO::PARAM_STR);
            $guncelleme->bindParam(31, $iletisimUstBaslik_tr, PDO::PARAM_STR);
            $guncelleme->bindParam(32, $iletisimUstBaslik_en, PDO::PARAM_STR);
            $guncelleme->bindParam(33, $hizmetlerbaslik_tr, PDO::PARAM_STR);
            $guncelleme->bindParam(34, $hizmetlerbaslik_en, PDO::PARAM_STR);
            $guncelleme->bindParam(35, $hizmetlerUstBaslik_tr, PDO::PARAM_STR);
            $guncelleme->bindParam(36, $hizmetlerUstBaslik_en, PDO::PARAM_STR);
            $guncelleme->bindParam(37, $videobaslik_tr, PDO::PARAM_STR);
            $guncelleme->bindParam(38, $videobaslik_en, PDO::PARAM_STR);
            $guncelleme->bindParam(39, $videoUstBaslik_tr, PDO::PARAM_STR);
            $guncelleme->bindParam(40, $videoUstBaslik_en, PDO::PARAM_STR);
            $guncelleme->bindParam(41, $haritabilgi, PDO::PARAM_STR);
            $guncelleme->bindParam(42, $footer, PDO::PARAM_STR);
            $guncelleme->bindParam(43, $mesajtercih, PDO::PARAM_INT);
            $guncelleme->execute();

            echo '<div class="alert alert-success" role="alert">
                    Site ayarları başarıyla güncellendi
                </div>';
            header("refresh:1,url=control.php?sayfa=siteayar");

        else:
            ?>
            <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
                <div class="card-body">
                    <div class="col-lg-10 mx-auto">
                        <h3 class="text-info">SITE AYARLARI ></h3>
                    </div>
                    <div class="col-lg-10 mx-auto mt-2 border">
                        <div class="form-row">
                            <div class="col-lg-4 border-right p-3">
                                <label id="siteayarfont">Title</label>
                            </div>
                            <div class="col-lg-8 p-2">
                                <input type="text" name="title" class="form-control" value="<?= $sonuc['title']; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-10 mx-auto border">
                        <div class="form-row">
                            <div class="col-lg-4 border-right p-3">
                                <label id="siteayarfont">Meta Title</label>
                            </div>
                            <div class="col-lg-8 p-2">
                                <input type="text" name="metatitle" class="form-control"
                                       value="<?= $sonuc['metatitle']; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-10 mx-auto border">
                        <div class="form-row">
                            <div class="col-lg-4 border-right p-3">
                                <label id="siteayarfont">Meta Description</label>
                            </div>
                            <div class="col-lg-8 p-2">
                                <input type="text" name="metadesc" class="form-control"
                                       value="<?= $sonuc['metadesc']; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-10 mx-auto border">
                        <div class="form-row">
                            <div class="col-lg-4 border-right p-3">
                                <label id="siteayarfont">Meta Keyword</label>
                            </div>
                            <div class="col-lg-8 p-2">
                                <input type="text" name="metakey" class="form-control"
                                       value="<?= $sonuc['metakey']; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-10 mx-auto border">
                        <div class="form-row">
                            <div class="col-lg-4 border-right p-3">
                                <label id="siteayarfont">Meta Author</label>
                            </div>
                            <div class="col-lg-8 p-2">
                                <input type="text" name="metaauthor" class="form-control"
                                       value="<?= $sonuc['metaauthor']; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-10 mx-auto border">
                        <div class="form-row">
                            <div class="col-lg-4 border-right p-3">
                                <label id="siteayarfont">Meta Owner</label>
                            </div>
                            <div class="col-lg-8 p-2">
                                <input type="text" name="metaowner" class="form-control"
                                       value="<?= $sonuc['metaowner']; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-10 mx-auto border">
                        <div class="form-row">
                            <div class="col-lg-4 border-right p-3">
                                <label id="siteayarfont">Meta Copyright</label>
                            </div>
                            <div class="col-lg-8 p-2">
                                <input type="text" name="metacopy" class="form-control"
                                       value="<?= $sonuc['metacopy']; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-10 mx-auto border">
                        <div class="form-row">
                            <div class="col-lg-4 border-right p-3">
                                <label id="siteayarfont">Logo Yazısı</label>
                            </div>
                            <div class="col-lg-8 p-2">
                                <input type="text" name="logoyazisi" class="form-control"
                                       value="<?= $sonuc['logoyazisi']; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-10 mx-auto border">
                        <div class="form-row">
                            <div class="col-lg-4 border-right p-3">
                                <label id="siteayarfont">Twitter</label>
                            </div>
                            <div class="col-lg-8 p-2">
                                <input type="text" name="twit" class="form-control" value="<?= $sonuc['twit']; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-10 mx-auto border">
                        <div class="form-row">
                            <div class="col-lg-4 border-right p-3">
                                <label id="siteayarfont">Facebook</label>
                            </div>
                            <div class="col-lg-8 p-2">
                                <input type="text" name="face" class="form-control" value="<?= $sonuc['face']; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-10 mx-auto border">
                        <div class="form-row">
                            <div class="col-lg-4 border-right p-3">
                                <label id="siteayarfont">Instagram</label>
                            </div>
                            <div class="col-lg-8 p-2">
                                <input type="text" name="inst" class="form-control" value="<?= $sonuc['inst']; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-10 mx-auto border">
                        <div class="form-row">
                            <div class="col-lg-4 border-right p-3">
                                <label id="siteayarfont">Telefon No</label>
                            </div>
                            <div class="col-lg-8 p-2">
                                <input type="text" name="telefonno" class="form-control"
                                       value="<?= $sonuc['telefonno']; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-10 mx-auto border">
                        <div class="form-row">
                            <div class="col-lg-4 border-right p-3">
                                <label id="siteayarfont">Mail Adres</label>
                            </div>
                            <div class="col-lg-8 p-2">
                                <input type="text" name="adres" class="form-control" value="<?= $sonuc['adres']; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-10 mx-auto border">
                        <div class="form-row">
                            <div class="col-lg-4 border-right p-3">
                                <label id="siteayarfont">Açık Adres</label>
                            </div>
                            <div class="col-lg-8 p-2">
                                <input type="text" name="mailadres" class="form-control"
                                       value="<?= $sonuc['mailadres']; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-10 mx-auto border">
                        <div class="form-row">
                            <div class="col-lg-4 border-right p-3">
                                <label id="siteayarfont">Slogan TR</label>
                            </div>
                            <div class="col-lg-8 p-2">
                                <input type="text" name="slogan_tr" class="form-control"
                                       value="<?= $sonuc['slogan_tr']; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-10 mx-auto border">
                        <div class="form-row">
                            <div class="col-lg-4 border-right p-3">
                                <label id="siteayarfont">Slogan EN</label>
                            </div>
                            <div class="col-lg-8 p-2">
                                <input type="text" name="slogan_en" class="form-control"
                                       value="<?= $sonuc['slogan_en']; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-10 mx-auto border">
                        <div class="form-row">
                            <div class="col-lg-4 border-right p-3">
                                <label id="siteayarfont">Referans Başlık TR</label>
                            </div>
                            <div class="col-lg-8 p-2">
                                <input type="text" name="referansbaslik_tr" class="form-control"
                                       value="<?= $sonuc['referansbaslik_tr']; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-10 mx-auto border">
                        <div class="form-row">
                            <div class="col-lg-4 border-right p-3">
                                <label id="siteayarfont">Referans Başlık EN</label>
                            </div>
                            <div class="col-lg-8 p-2">
                                <input type="text" name="referansbaslik_en" class="form-control"
                                       value="<?= $sonuc['referansbaslik_en']; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-10 mx-auto border">
                        <div class="form-row">
                            <div class="col-lg-4 border-right p-3">
                                <label id="siteayarfont">Referans Üst Başlık TR</label>
                            </div>
                            <div class="col-lg-8 p-2">
                                <input type="text" name="referansUstBaslik_tr" class="form-control"
                                       value="<?= $sonuc['referansUstBaslik_tr']; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-10 mx-auto border">
                        <div class="form-row">
                            <div class="col-lg-4 border-right p-3">
                                <label id="siteayarfont">Referans Üst Başlık EN</label>
                            </div>
                            <div class="col-lg-8 p-2">
                                <input type="text" name="referansUstBaslik_en" class="form-control"
                                       value="<?= $sonuc['referansUstBaslik_en']; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-10 mx-auto border">
                        <div class="form-row">
                            <div class="col-lg-4 border-right p-3">
                                <label id="siteayarfont">Filo Başlık TR</label>
                            </div>
                            <div class="col-lg-8 p-2">
                                <input type="text" name="filobaslik_tr" class="form-control"
                                       value="<?= $sonuc['filobaslik_tr']; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-10 mx-auto border">
                        <div class="form-row">
                            <div class="col-lg-4 border-right p-3">
                                <label id="siteayarfont">Filo Başlık EN</label>
                            </div>
                            <div class="col-lg-8 p-2">
                                <input type="text" name="filobaslik_en" class="form-control"
                                       value="<?= $sonuc['filobaslik_en']; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-10 mx-auto border">
                        <div class="form-row">
                            <div class="col-lg-4 border-right p-3">
                                <label id="siteayarfont">Filo Üst Başlık TR</label>
                            </div>
                            <div class="col-lg-8 p-2">
                                <input type="text" name="filoUstBaslik_tr" class="form-control"
                                       value="<?= $sonuc['filoUstBaslik_tr']; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-10 mx-auto border">
                        <div class="form-row">
                            <div class="col-lg-4 border-right p-3">
                                <label id="siteayarfont">Filo Üst Başlık EN</label>
                            </div>
                            <div class="col-lg-8 p-2">
                                <input type="text" name="filoUstBaslik_en" class="form-control"
                                       value="<?= $sonuc['filoUstBaslik_en']; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-10 mx-auto border">
                        <div class="form-row">
                            <div class="col-lg-4 border-right p-3">
                                <label id="siteayarfont">Yorumlar Başlık TR</label>
                            </div>
                            <div class="col-lg-8 p-2">
                                <input type="text" name="yorumbaslik_tr" class="form-control"
                                       value="<?= $sonuc['yorumbaslik_tr']; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-10 mx-auto border">
                        <div class="form-row">
                            <div class="col-lg-4 border-right p-3">
                                <label id="siteayarfont">Yorumlar Başlık EN</label>
                            </div>
                            <div class="col-lg-8 p-2">
                                <input type="text" name="yorumbaslik_en" class="form-control"
                                       value="<?= $sonuc['yorumbaslik_en']; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-10 mx-auto border">
                        <div class="form-row">
                            <div class="col-lg-4 border-right p-3">
                                <label id="siteayarfont">Yorumlar Üst Başlık TR</label>
                            </div>
                            <div class="col-lg-8 p-2">
                                <input type="text" name="yorumUstBaslik_tr" class="form-control"
                                       value="<?= $sonuc['yorumUstBaslik_tr']; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-10 mx-auto border">
                        <div class="form-row">
                            <div class="col-lg-4 border-right p-3">
                                <label id="siteayarfont">Yorumlar Üst Başlık EN</label>
                            </div>
                            <div class="col-lg-8 p-2">
                                <input type="text" name="yorumUstBaslik_en" class="form-control"
                                       value="<?= $sonuc['yorumUstBaslik_en']; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-10 mx-auto border">
                        <div class="form-row">
                            <div class="col-lg-4 border-right p-3">
                                <label id="siteayarfont">İletişim Başlık TR</label>
                            </div>
                            <div class="col-lg-8 p-2">
                                <input type="text" name="iletisimbaslik_tr" class="form-control"
                                       value="<?= $sonuc['iletisimbaslik_tr']; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-10 mx-auto border">
                        <div class="form-row">
                            <div class="col-lg-4 border-right p-3">
                                <label id="siteayarfont">İletişim Başlık EN</label>
                            </div>
                            <div class="col-lg-8 p-2">
                                <input type="text" name="iletisimbaslik_en" class="form-control"
                                       value="<?= $sonuc['iletisimbaslik_en']; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-10 mx-auto border">
                        <div class="form-row">
                            <div class="col-lg-4 border-right p-3">
                                <label id="siteayarfont">İletişim Üst Başlık TR</label>
                            </div>
                            <div class="col-lg-8 p-2">
                                <input type="text" name="iletisimUstBaslik_tr" class="form-control"
                                       value="<?= $sonuc['iletisimUstBaslik_tr']; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-10 mx-auto border">
                        <div class="form-row">
                            <div class="col-lg-4 border-right p-3">
                                <label id="siteayarfont">İletişim Üst Başlık EN</label>
                            </div>
                            <div class="col-lg-8 p-2">
                                <input type="text" name="iletisimUstBaslik_en" class="form-control"
                                       value="<?= $sonuc['iletisimUstBaslik_en']; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-10 mx-auto border">
                        <div class="form-row">
                            <div class="col-lg-4 border-right p-3">
                                <label id="siteayarfont">Hizmetler Başlık TR</label>
                            </div>
                            <div class="col-lg-8 p-2">
                                <input type="text" name="hizmetlerbaslik_tr" class="form-control"
                                       value="<?= $sonuc['hizmetlerbaslik_tr']; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-10 mx-auto border">
                        <div class="form-row">
                            <div class="col-lg-4 border-right p-3">
                                <label id="siteayarfont">Hizmetler Başlık EN</label>
                            </div>
                            <div class="col-lg-8 p-2">
                                <input type="text" name="hizmetlerbaslik_en" class="form-control"
                                       value="<?= $sonuc['hizmetlerbaslik_en']; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-10 mx-auto border">
                        <div class="form-row">
                            <div class="col-lg-4 border-right p-3">
                                <label id="siteayarfont">Hizmetler Üst Başlık TR</label>
                            </div>
                            <div class="col-lg-8 p-2">
                                <input type="text" name="hizmetlerUstBaslik_tr" class="form-control"
                                       value="<?= $sonuc['hizmetlerUstBaslik_tr']; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-10 mx-auto border">
                        <div class="form-row">
                            <div class="col-lg-4 border-right p-3">
                                <label id="siteayarfont">Hizmetler Üst Başlık EN</label>
                            </div>
                            <div class="col-lg-8 p-2">
                                <input type="text" name="hizmetlerUstBaslik_en" class="form-control"
                                       value="<?= $sonuc['hizmetlerUstBaslik_en']; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-10 mx-auto border">
                        <div class="form-row">
                            <div class="col-lg-4 border-right p-3">
                                <label id="siteayarfont">Videolar Başlık TR</label>
                            </div>
                            <div class="col-lg-8 p-2">
                                <input type="text" name="videobaslik_tr" class="form-control"
                                       value="<?= $sonuc['videobaslik_tr']; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-10 mx-auto border">
                        <div class="form-row">
                            <div class="col-lg-4 border-right p-3">
                                <label id="siteayarfont">Videolar Başlık EN</label>
                            </div>
                            <div class="col-lg-8 p-2">
                                <input type="text" name="videobaslik_en" class="form-control"
                                       value="<?= $sonuc['videobaslik_en']; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-10 mx-auto border">
                        <div class="form-row">
                            <div class="col-lg-4 border-right p-3">
                                <label id="siteayarfont">Videolar Üst Başlık TR</label>
                            </div>
                            <div class="col-lg-8 p-2">
                                <input type="text" name="videoUstBaslik_tr" class="form-control"
                                       value="<?= $sonuc['videoUstBaslik_tr']; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-10 mx-auto border">
                        <div class="form-row">
                            <div class="col-lg-4 border-right p-3">
                                <label id="siteayarfont">Videolar Üst Başlık EN</label>
                            </div>
                            <div class="col-lg-8 p-2">
                                <input type="text" name="videoUstBaslik_en" class="form-control"
                                       value="<?= $sonuc['videoUstBaslik_en']; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-10 mx-auto border">
                        <div class="form-row">
                            <div class="col-lg-4 border-right p-3">
                                <label id="siteayarfont">Harita Bilgisi</label>
                            </div>
                            <div class="col-lg-8 p-2">
                                <input type="text" name="haritabilgi" class="form-control"
                                       value="<?= $sonuc['haritabilgi']; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-10 mx-auto border">
                        <div class="form-row">
                            <div class="col-lg-4 border-right p-3">
                                <label id="siteayarfont">Footer Bilgisi</label>
                            </div>
                            <div class="col-lg-8 p-2">
                                <input type="text" name="footer" class="form-control"
                                       value="<?= $sonuc['footer']; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-10 mx-auto border">
                        <div class="form-row">
                            <div class="col-lg-4 border-right p-3">
                                <label id="siteayarfont">Mesaj Tercih</label>
                            </div>
                            <div class="col-lg-8 p-2">
                                <div class="row">
                                    <div class="col-lg-4 pt-1 border-right">
                                        <label>Sadece Mail</label>
                                        <input type="radio" name="mesajtercih" class="mt-2"
                                               value="1" <?php echo ($sonuc['mesajtercih'] == 1) ? "checked='checked'" : ""; ?>>
                                    </div>
                                    <div class="col-lg-4 pt-1 border-right">
                                        <label>Mail ve Mesaj</label>
                                        <input type="radio" name="mesajtercih" class="mt-2"
                                               value="2" <?php echo ($sonuc['mesajtercih'] == 2) ? "checked='checked'" : ""; ?>>
                                    </div>
                                    <div class="col-lg-4 pt-1">
                                        <label>Sadece Mesaj</label>
                                        <input type="radio" name="mesajtercih" class="mt-2"
                                               value="3" <?php echo ($sonuc['mesajtercih'] == 3) ? "checked='checked'" : ""; ?>>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-lg-10 mx-auto mt-2 border-bottom">
                        <button type="submit" name="buton" class="btn btn-info">Güncelle</button>
                    </div>

                </div>


            </form>
        <?php
        endif;
    }


    public function sifrele($veri)
    {

        return base64_encode(gzdeflate(gzcompress(serialize($veri))));
    }


    public function coz($veri)
    {

        return unserialize(gzuncompress(gzinflate(base64_decode($veri))));
    }


    public function kuladial($vt)
    {
        $cookid = $_COOKIE['kulbilgi'];
        $cozduk = self::coz($cookid);
        $sorgusonuc = self::sorgum($vt, "select * from yonetim where id=$cozduk", 1);
        return $sorgusonuc['kulad'];
    }


    public function giriskontrol($kulad, $sifre, $vt)
    {
        $sifrelihal = md5(sha1(md5($sifre)));
        $sor = $vt->prepare("select * from yonetim where kulad='$kulad' and sifre='$sifrelihal'");
        $sor->execute();
        if ($sor->rowCount() == 0):
            echo '<div class="container-fluid bg-white">
            <div class="alert alert-danger border border-dark mt-4 col-md-5 mx-auto p-3 text-dark font-14 font-weight-bold">
            <img src="assets/images/load.gif" style="height: 100px" class="mr-3"> Bilgiler Hatalı</div>
            </div>';
            header("refresh:2,url=index.php");
        else:
            $gelendeger = $sor->fetch();
            $sor = $vt->prepare("update yonetim set aktif=1 where kulad='$kulad' and sifre='$sifrelihal'");
            $sor->execute();

            echo '<div class="container-fluid bg-white">
            <div class="alert alert-success border border-dark mt-4 col-md-5 mx-auto p-3 text-dark font-14 font-weight-bold">
            <img src="assets/images/load.gif" style="height: 100px" class="mr-3"> Giriş Yapılıyor</div>
            </div>';
            header("refresh:2,url=control.php");

            $id = self::sifrele($gelendeger['id']);
            setcookie("kulbilgi", $id, time() + 60 * 60 * 24);
        endif;
    }


    public function cikis($vt)
    {
        $cookid = $_COOKIE['kulbilgi'];
        $cozduk = self::coz($cookid);
        self::sorgum($vt, "update yonetim set aktif=0 where id=$cozduk", 0);
        setcookie("kulbilgi", $cookid, time() - 5);
        echo '<div class="container-fluid bg-white">
            <div class="alert alert-info border border-dark mt-4 col-md-5 mx-auto p-3 text-dark font-14 font-weight-bold">
            <img src="assets/images/load.gif" style="height: 100px" class="mr-3"> Çıkış Yapılıyor</div>
            </div>';
        header("refresh:2,url=index.php");
    }


    public function kontrolet($sayfa)
    {
        if (isset($_COOKIE['kulbilgi'])):
            if ($sayfa == "ind"): header("Location:control.php"); endif;

        else:
            if ($sayfa == "cot"): header("Location:index.php"); endif;

        endif;
    }


    //intro bölümü
    public function introayar($vt)
    {
        echo '<div class="row text-center">
                <div class="col-lg-12 border-bottom"><h3 class="float-left mt-3 text-dark mb-2">
                <a href="control.php?sayfa=introresimekle" class="ti-plus bg-dark text-white p-1 m-2"></a>
                INTRO RESIMLERİ</h3>
                </div>';
        $introbilgiler = self::sorgum($vt, "select * from intro", 2);
        while ($sonbilgi = $introbilgiler->fetch(PDO::FETCH_ASSOC)):
            echo '<div class="col-lg-4">
                    <div class="row border border-light p-1 m-1">
                    <div class="col-lg-12">
                    <img src="../' . $sonbilgi["resimyol"] . '">
                    <kbd class="bg-white p-2" style="position: absolute; bottom: 10px; right: 10px">
                    <a href="control.php?sayfa=introresimguncelle&id=' . $sonbilgi["id"] . '" class="ti-reload m-2 text-success" style="font-size: 25px"></a>
                    <a href="control.php?sayfa=introresimsil&id=' . $sonbilgi["id"] . '" class="ti-trash m-2 text-danger" style="font-size: 25px"></a>
                    </kbd>
                    </div>
                    
                    </div>
                    </div>';
        endwhile;

        echo '</div>';

    }


    public function introresimekleme($vt)
    {
        echo '<div class="row text-center">
                <div class="col-lg-12">';

        if ($_POST):

            if ($_FILES["dosya"]["name"] == ""):
                echo '<div class="alert alert-danger mt-1">Dosya Yüklenmedi. Boş Olamaz</div>';
                header("refresh:2,url=control.php?sayfa=introresimekle");
            else:
                if ($_FILES["dosya"]["size"] > (1024 * 1024 * 5)):
                    echo '<div class="alert alert-danger mt-1">Dosyanın boyutu çok fazla</div>';
                    header("refresh:2,url=control.php?sayfa=introresimekle");
                else:
                    $izinverilen = array("image/png", "image/jpeg");

                    if (!in_array($_FILES["dosya"]["type"], $izinverilen)):
                        echo '<div class="alert alert-danger mt-1">İzin verilen uzantı değil</div>';
                        header("refresh:2,url=control.php?sayfa=introresimekle");
                    else:
                        $dosyaninyolu = '../public/img/carousel/' . $_FILES["dosya"]["name"];
                        move_uploaded_file($_FILES["dosya"]["tmp_name"], $dosyaninyolu);
                        echo '<div class="alert alert-success mt-1">Dosya Başarıyla Yüklendi</div>';
                        header("refresh:2,url=control.php?sayfa=introayar");

                        $dosyaninyolu2 = str_replace('../', '', $dosyaninyolu);
                        self::sorgum($vt, "insert into intro (resimyol) VALUES('$dosyaninyolu2')", 0);
                    endif;

                endif;

            endif;
        else:
            ?>
            <div class="col-lg-4 mx-auto mt-2">
                <div class="card card-bordered">
                    <div class="card-body">
                        <h5 class="title border-bottom">İntro Resim Yükleme</h5>
                        <form action="" method="post" enctype="multipart/form-data">
                            <p class="card-text">
                                <input type="file" name="dosya" class="form-control">
                            </p>
                            <input type="submit" class="btn btn-primary mb-1" name="buton" value="Yükle">
                        </form>
                        <p class="card-text text-left text-danger border-top">* İzin verilen formatlar: jpg-png <br/>
                            * İzin verilen max boyut: 5mb</p>
                    </div>
                </div>
            </div>

        <?php

        endif;
        echo '</div></div>';
    }


    public function introsil($vt)
    {
        $introid = $_GET['id'];
        $verial = self::sorgum($vt, "select * from intro where id=$introid", 1);

        echo '<div class="row text-center">
                <div class="col-lg-12">';

        unlink("../" . $verial['resimyol']);
        self::sorgum($vt, "delete from intro where id=$introid", 0);
        echo '<div class="alert alert-success mt-1">Dosya Başarıyla Silindi</div>';
        echo '</div></div>';
        header("refresh:2,url=control.php?sayfa=introayar");
    }


    public function introresimeguncelleme($vt)
    {

        $gelenintroid = $_GET['id'];
        echo '<div class="row text-center">
                <div class="col-lg-12">';
        if ($_POST):
            $formdangelenid = $_POST['introid'];
            if ($_FILES["dosya"]["name"] == ""):
                echo '<div class="alert alert-danger mt-1">Dosya Yüklenmedi. Boş Olamaz</div>';
                header("refresh:2,url=control.php?sayfa=introayar");
            else:
                if ($_FILES["dosya"]["size"] > (1024 * 1024 * 5)):
                    echo '<div class="alert alert-danger mt-1">Dosyanın boyutu çok fazla</div>';
                    header("refresh:2,url=control.php?sayfa=introayar");
                else:
                    $izinverilen = array("image/png", "image/jpeg");

                    if (!in_array($_FILES["dosya"]["type"], $izinverilen)):
                        echo '<div class="alert alert-danger mt-1">İzin verilen uzantı değil</div>';
                        header("refresh:2,url=control.php?sayfa=introayar");
                    else:
                        $resimyolunabak = self::sorgum($vt, "select * from intro where id=$gelenintroid", 1);
                        $dbgelenyol = '../' . $resimyolunabak["resimyol"];
                        unlink($dbgelenyol);

                        $dosyaninyolu = '../public/img/carousel/' . $_FILES["dosya"]["name"];
                        move_uploaded_file($_FILES["dosya"]["tmp_name"], $dosyaninyolu);

                        $dosyaninyolu2 = str_replace('../', '', $dosyaninyolu);
                        self::sorgum($vt, "update intro set resimyol='$dosyaninyolu2' where id=$gelenintroid", 0);

                        echo '<div class="alert alert-success mt-1">Dosya Başarıyla Güncellendi</div>';
                        header("refresh:2,url=control.php?sayfa=introayar");


                    endif;
                endif;
            endif;
        else:
            ?>
            <div class="col-lg-4 mx-auto mt-2">
                <div class="card card-bordered">
                    <div class="card-body">
                        <h5 class="title border-bottom">İntro Resim Güncelleme</h5>
                        <form action="" method="post" enctype="multipart/form-data">
                            <p class="card-text">
                                <input type="file" name="dosya" class="form-control">
                                <input type="hidden" name="introid" value="<?php echo $gelenintroid; ?>">
                            </p>
                            <input type="submit" class="btn btn-primary mb-1" name="buton" value="Yükle">
                        </form>
                        <p class="card-text text-left text-danger border-top">* İzin verilen formatlar: jpg-png <br/>
                            * İzin verilen max boyut: 5mb</p>
                    </div>
                </div>
            </div>

        <?php

        endif;
        echo '</div></div>';
    }


    //Araç filosu
    public function aracayar($vt)
    {
        echo '<div class="row text-center">
                <div class="col-lg-12 border-bottom"><h3 class="float-left mt-3 text-dark mb-2">
                <a href="control.php?sayfa=aracresimekle" class="ti-plus bg-dark text-white p-1 m-2"></a>
                ARAÇ FİLO RESIMLERİ</h3></div>';
        $aracbilgiler = self::sorgum($vt, "select * from filomuz", 2);
        while ($sonbilgi = $aracbilgiler->fetch(PDO::FETCH_ASSOC)):
            echo '<div class="col-lg-4">
                    <div class="row border border-light p-1 m-1">
                    <div class="col-lg-12">
                    <img src="../' . $sonbilgi["resimyol"] . '">
                    <kbd class="bg-white p-2" style="position: absolute; bottom: 10px; right: 10px">
                    <a href="control.php?sayfa=aracresimguncelle&id=' . $sonbilgi["id"] . '" class="ti-reload m-2 text-success" style="font-size: 25px"></a>
                    <a href="control.php?sayfa=aracresimsil&id=' . $sonbilgi["id"] . '" class="ti-trash m-2 text-danger" style="font-size: 25px"></a>
                    </kbd>
                    </div>
                    
                    </div>
                    </div>';
        endwhile;

        echo '</div>';

    }


    public function aracresimekleme($vt)
    {
        echo '<div class="row text-center">
                <div class="col-lg-12">';

        if ($_POST):

            if ($_FILES["dosya"]["name"] == ""):
                echo '<div class="alert alert-danger mt-1">Dosya Yüklenmedi. Boş Olamaz</div>';
                header("refresh:2,url=control.php?sayfa=aracresimekle");
            else:
                if ($_FILES["dosya"]["size"] > (1024 * 1024 * 5)):
                    echo '<div class="alert alert-danger mt-1">Dosyanın boyutu çok fazla</div>';
                    header("refresh:2,url=control.php?sayfa=aracresimekle");
                else:
                    $izinverilen = array("image/png", "image/jpeg");

                    if (!in_array($_FILES["dosya"]["type"], $izinverilen)):
                        echo '<div class="alert alert-danger mt-1">İzin verilen uzantı değil</div>';
                        header("refresh:2,url=control.php?sayfa=aracresimekle");
                    else:
                        $dosyaninyolu = '../public/img/filo/' . $_FILES["dosya"]["name"];
                        move_uploaded_file($_FILES["dosya"]["tmp_name"], $dosyaninyolu);
                        echo '<div class="alert alert-success mt-1">Dosya Başarıyla Yüklendi</div>';
                        header("refresh:2,url=control.php?sayfa=aracayar");

                        $dosyaninyolu2 = str_replace('../', '', $dosyaninyolu);
                        self::sorgum($vt, "insert into filomuz (resimyol) VALUES('$dosyaninyolu2')", 0);
                    endif;

                endif;

            endif;
        else:
            ?>
            <div class="col-lg-4 mx-auto mt-2">
                <div class="card card-bordered">
                    <div class="card-body">
                        <h5 class="title border-bottom">Araç Filo Resim Yükleme</h5>
                        <form action="" method="post" enctype="multipart/form-data">
                            <p class="card-text">
                                <input type="file" name="dosya" class="form-control">
                            </p>
                            <input type="submit" class="btn btn-primary mb-1" name="buton" value="Yükle">
                        </form>
                        <p class="card-text text-left text-danger border-top">* İzin verilen formatlar: jpg-png <br/>
                            * İzin verilen max boyut: 5mb</p>
                    </div>
                </div>
            </div>

        <?php

        endif;
        echo '</div></div>';
    }


    public function aracsil($vt)
    {
        $aracid = $_GET['id'];
        $verial = self::sorgum($vt, "select * from filomuz where id=$aracid", 1);

        echo '<div class="row text-center">
                <div class="col-lg-12">';

        unlink("../" . $verial['resimyol']);
        self::sorgum($vt, "delete from filomuz where id=$aracid", 0);
        echo '<div class="alert alert-success mt-1">Dosya Başarıyla Silindi</div>';
        echo '</div></div>';
        header("refresh:2,url=control.php?sayfa=aracayar");
    }


    public function aracresimeguncelleme($vt)
    {

        $gelenaracid = $_GET['id'];
        echo '<div class="row text-center">
                <div class="col-lg-12">';
        if ($_POST):
            $formdangelenid = $_POST['aracid'];
            if ($_FILES["dosya"]["name"] == ""):
                echo '<div class="alert alert-danger mt-1">Dosya Yüklenmedi. Boş Olamaz</div>';
                header("refresh:2,url=control.php?sayfa=aracayar");
            else:
                if ($_FILES["dosya"]["size"] > (1024 * 1024 * 5)):
                    echo '<div class="alert alert-danger mt-1">Dosyanın boyutu çok fazla</div>';
                    header("refresh:2,url=control.php?sayfa=aracayar");
                else:
                    $izinverilen = array("image/png", "image/jpeg");

                    if (!in_array($_FILES["dosya"]["type"], $izinverilen)):
                        echo '<div class="alert alert-danger mt-1">İzin verilen uzantı değil</div>';
                        header("refresh:2,url=control.php?sayfa=aracayar");
                    else:
                        $resimyolunabak = self::sorgum($vt, "select * from filomuz where id=$gelenaracid", 1);
                        $dbgelenyol = '../' . $resimyolunabak["resimyol"];
                        unlink($dbgelenyol);

                        $dosyaninyolu = '../public/img/filo/' . $_FILES["dosya"]["name"];
                        move_uploaded_file($_FILES["dosya"]["tmp_name"], $dosyaninyolu);

                        $dosyaninyolu2 = str_replace('../', '', $dosyaninyolu);
                        self::sorgum($vt, "update filomuz set resimyol='$dosyaninyolu2' where id=$gelenaracid", 0);

                        echo '<div class="alert alert-success mt-1">Dosya Başarıyla Güncellendi</div>';
                        header("refresh:2,url=control.php?sayfa=aracayar");


                    endif;
                endif;
            endif;
        else:
            ?>
            <div class="col-lg-4 mx-auto mt-2">
                <div class="card card-bordered">
                    <div class="card-body">
                        <h5 class="title border-bottom">Araç Resim Güncelleme</h5>
                        <form action="" method="post" enctype="multipart/form-data">
                            <p class="card-text">
                                <input type="file" name="dosya" class="form-control">
                                <input type="hidden" name="aracid" value="<?php echo $gelenaracid; ?>">
                            </p>
                            <input type="submit" class="btn btn-primary mb-1" name="buton" value="Yükle">
                        </form>
                        <p class="card-text text-left text-danger border-top">* İzin verilen formatlar: jpg-png <br/>
                            * İzin verilen max boyut: 5mb</p>
                    </div>
                </div>
            </div>

        <?php

        endif;
        echo '</div></div>';
    }


    //mesajlar
    private function mailgetir($vt, $veriler)
    {
        $sor = $vt->prepare("select* from $veriler[0] where durum=$veriler[1]");
        $sor->execute();
        return $sor;

    }


    public function gelenmesajlar($vt)
    {
        echo '
            <div class="row">
            <div class="col-lg-12 mt-2">
            <div class="card">
            <div class="card-body">
            
            <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
            <a href="#gelen" id="gelen-tab" data-toggle="tab" class="nav-link active" role="tab" aria-controls="gelen" 
            aria-selected="true"><kbd>' . self::mailgetir($vt, array("gelenmail", 0))->rowCount() . '</kbd> Gelen Mesajlar</a></li>
            
            <li class="nav-item">
            <a href="#okunmus" id="okunmus-tab" data-toggle="tab" class="nav-link" role="tab" aria-controls="okunmus" 
            aria-selected="false"><kbd>' . self::mailgetir($vt, array("gelenmail", 1))->rowCount() . '</kbd> Okunmuş Mesajlar</a></li>
            
            <li class="nav-item">
            <a href="#arsiv" id="arsiv-tab" data-toggle="tab" class="nav-link" role="tab" aria-controls="arsiv" 
            aria-selected="false"><kbd>' . self::mailgetir($vt, array("gelenmail", 2))->rowCount() . '</kbd> Arşivlenmiş Mesajlar</a></li>
            </ul>
            
            <div class="tab-content mt-3" id="benimTab">
            <div class="tab-pane fade show active" id="gelen" role="tabpanel" aria-labelledby="gelen-tab">';
        $sonuc = self::mailgetir($vt, array("gelenmail", 0));
        if ($sonuc->rowCount() != 0):
            while ($sonucson = $sonuc->fetch(PDO::FETCH_ASSOC)):
                echo '<div class="row">
                            <div class="col-lg-12 bg-light mt-2 font-weight-bold" style="border-radius: 5px; border:1px solid #eeeeee;">
                            <div class="row border-bottom">
                            <div class="col-lg-1 p-1">Ad & Ünvan</div>
                            <div class="col-lg-2 p-1 text-primary">' . $sonucson["ad"] . '</div>
                            <div class="col-lg-1 p-1">Mail Adresi</div>
                            <div class="col-lg-2 p-1 text-primary">' . $sonucson["mailadres"] . '</div>
                            <div class="col-lg-1 p-1">Konu</div>
                            <div class="col-lg-2 p-1 text-primary">' . $sonucson["konu"] . '</div>
                            <div class="col-lg-1 p-1">Tarih</div>
                            <div class="col-lg-1 p-1 text-primary">' . $sonucson["zaman"] . '</div>
                            <div class="col-lg-1 p-1">
                            <a href="control.php?sayfa=mesajoku&id=' . $sonucson["id"] . '"><i class="fa fa-folder-open border-right pr-2 text-dark" style="font-size: 20px;"></i></a>
                            <a href="control.php?sayfa=mesajarsivle&id=' . $sonucson["id"] . '"><i class="fa fa-share border-right pr-2 text-dark" style="font-size: 20px;"></i></a>
                            <a href="control.php?sayfa=mesajsil&id=' . $sonucson["id"] . '"><i class="fa fa-trash pr-2 text-dark" style="font-size: 20px;"></i></a>
                            </div>
                        </div>
                        </div>
                        </div>';

            endwhile;

        else:
            echo '<div class="alert alert-info">Gelen Mesaj Yok</div>';
        endif;
        echo '</div>

            <div class="tab-pane fade" id="okunmus" role="tabpanel" aria-labelledby="okunmus-tab">';
        $sonuc = self::mailgetir($vt, array("gelenmail", 1));
        if ($sonuc->rowCount() != 0):
            while ($sonucson = $sonuc->fetch(PDO::FETCH_ASSOC)):
                echo '<div class="row">
                            <div class="col-lg-12 bg-light mt-2 font-weight-bold" style="border-radius: 5px; border:1px solid #eeeeee;">
                            <div class="row border-bottom">
                            <div class="col-lg-1 p-1">Ad & Ünvan</div>
                            <div class="col-lg-2 p-1 text-primary">' . $sonucson["ad"] . '</div>
                            <div class="col-lg-1 p-1">Mail Adresi</div>
                            <div class="col-lg-2 p-1 text-primary">' . $sonucson["mailadres"] . '</div>
                            <div class="col-lg-1 p-1">Konu</div>
                            <div class="col-lg-2 p-1 text-primary">' . $sonucson["konu"] . '</div>
                            <div class="col-lg-1 p-1">Tarih</div>
                            <div class="col-lg-1 p-1 text-primary">' . $sonucson["zaman"] . '</div>
                            <div class="col-lg-1 p-1">
                            <a href="control.php?sayfa=mesajoku&id=' . $sonucson["id"] . '"><i class="fa fa-folder-open border-right pr-2 text-dark" style="font-size: 20px;"></i></a>
                            <a href="control.php?sayfa=mesajarsivle&id=' . $sonucson["id"] . '"><i class="fa fa-share border-right pr-2 text-dark" style="font-size: 20px;"></i></a>
                            <a href="control.php?sayfa=mesajsil&id=' . $sonucson["id"] . '"><i class="fa fa-trash pr-2 text-dark" style="font-size: 20px;"></i></a>
                            </div>
                        </div>
                        </div>
                        </div>';

            endwhile;

        else:
            echo '<div class="alert alert-info">Okunmuş Mesaj Yok</div>';
        endif;
        echo '</div>
            
            <div class="tab-pane fade" id="arsiv" role="tabpanel" aria-labelledby="arsiv-tab">';
        $sonuc = self::mailgetir($vt, array("gelenmail", 2));
        if ($sonuc->rowCount() != 0):
            while ($sonucson = $sonuc->fetch(PDO::FETCH_ASSOC)):
                echo '<div class="row">
                            <div class="col-lg-12 bg-light mt-2 font-weight-bold" style="border-radius: 5px; border:1px solid #eeeeee;">
                            <div class="row border-bottom">
                            <div class="col-lg-1 p-1">Ad & Ünvan</div>
                            <div class="col-lg-2 p-1 text-primary">' . $sonucson["ad"] . '</div>
                            <div class="col-lg-1 p-1">Mail Adresi</div>
                            <div class="col-lg-2 p-1 text-primary">' . $sonucson["mailadres"] . '</div>
                            <div class="col-lg-1 p-1">Konu</div>
                            <div class="col-lg-2 p-1 text-primary">' . $sonucson["konu"] . '</div>
                            <div class="col-lg-1 p-1">Tarih</div>
                            <div class="col-lg-1 p-1 text-primary">' . $sonucson["zaman"] . '</div>
                            <div class="col-lg-1 p-1">
                            <a href="control.php?sayfa=mesajoku&id=' . $sonucson["id"] . '"><i class="fa fa-folder-open border-right pr-2 text-dark" style="font-size: 20px;"></i></a>
                            <a href="control.php?sayfa=mesajarsivle&id=' . $sonucson["id"] . '"><i class="fa fa-share border-right pr-2 text-dark" style="font-size: 20px;"></i></a>
                            <a href="control.php?sayfa=mesajsil&id=' . $sonucson["id"] . '"><i class="fa fa-trash pr-2 text-dark" style="font-size: 20px;"></i></a>
                            </div>
                        </div>
                        </div>
                        </div>';

            endwhile;

        else:
            echo '<div class="alert alert-info">Arşivlenmiş Mesaj Yok</div>';
        endif;
        echo '</div>
            </div>
            
            </div>
            </div>
            </div>            
            </div>
        ';
    }


    public function mesajdetay($vt, $id)
    {

        $mesajbilgi = self::sorgum($vt, "select * from gelenmail where id=$id", 1);

        echo '<div class="row m-2">
                            <div class="col-lg-12 bg-light mt-2 font-weight-bold" style="border-radius: 5px; border:1px solid #eeeeee;">
                            <div class="row border-bottom">
                            <div class="col-lg-1 p-1">Ad & Ünvan</div>
                            <div class="col-lg-2 p-1 text-primary">' . $mesajbilgi["ad"] . '</div>
                            <div class="col-lg-1 p-1">Mail Adresi</div>
                            <div class="col-lg-2 p-1 text-primary">' . $mesajbilgi["mailadres"] . '</div>
                            <div class="col-lg-1 p-1">Konu</div>
                            <div class="col-lg-2 p-1 text-primary">' . $mesajbilgi["konu"] . '</div>
                            <div class="col-lg-1 p-1">Tarih</div>
                            <div class="col-lg-1 p-1 text-primary">' . $mesajbilgi["zaman"] . '</div>
                            <div class="col-lg-1 p-1">
                            <a href="control.php?sayfa=mesajarsivle&id=' . $mesajbilgi["id"] . '"><i class="fa fa-share border-right pr-2 text-dark" style="font-size: 20px;"></i></a>
                            <a href="control.php?sayfa=mesajsil&id=' . $mesajbilgi["id"] . '"><i class="fa fa-trash pr-2 text-dark" style="font-size: 20px;"></i></a>
                            </div>
                            
                            </div>
                                                        
                            <div class="row text-left p-2">
                            <div class="col-lg-12">' . $mesajbilgi["mesaj"] . '</div>
                            </div>
                            
                        
                        </div>
                        </div>';
        //mesaj durum güncellendi
        self::sorgum($vt, "update gelenmail set durum=1 where id=$id", 0);
    }


    public function mesajarsivle($vt, $id)
    {

        echo '<div class="row m-2">
                <div class="col-lg-12 bg-light mt-2 font-weight-bold" style="border-radius: 5px; border:1px solid #eeeeee;">       
                    <div class="alert alert-info mt-2 mb-2">Mesaj Arşivlendi</div>
                </div>
              </div>';
        header("refresh:1,url=control.php?sayfa=gelenmesaj");

        self::sorgum($vt, "update gelenmail set durum=2 where id=$id", 0);
    }


    public function mesajsil($vt, $id)
    {

        echo '<div class="row m-2">
                <div class="col-lg-12 bg-light mt-2 font-weight-bold" style="border-radius: 5px; border:1px solid #eeeeee;">       
                    <div class="alert alert-info mt-2 mb-2">Mesaj Silindi</div>
                </div>
              </div>';
        header("refresh:1,url=control.php?sayfa=gelenmesaj");

        self::sorgum($vt, "delete from gelenmail where id=$id", 0);
    }


}
