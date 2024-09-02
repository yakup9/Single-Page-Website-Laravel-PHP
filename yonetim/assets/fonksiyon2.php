<?php

include_once 'fonksiyon.php';

class yonetim2 extends yonetim
{

    protected $tercihArray = array("Açık", "Kapalı");

    //Hakkımızda
    public function hakkimizda($vt)
    {
        echo '<div class="row text-center">
                <div class="col-lg-12 border-bottom"><h3 class="mt-3 text-info">HAKKIMIZDA AYARLARI</h3></div>';

        if (!$_POST):


            $sonbilgi = self::sorgum($vt, "select * from hakkimizda", 1);
            echo '<div class="col-lg-8 mx-auto">
                    <div class="row border border-light p-1 m-1">
                    
                    <div class="col-lg-3 border-bottom bg-light" id="hakkimizdayazilar">
                    Resim
                    </div>
                    <div class="col-lg-9 border-bottom">
                    <img width="200" src="../' . $sonbilgi["resim"] . '"><br>
                    <form action="" method="post" enctype="multipart/form-data">
                    <input type="file" name="dosya" class="form-control">
                    </div>
                    
                    <div class="col-lg-3 border-bottom bg-light pt-2" id="hakkimizdayazilarn">
                    TR - Başlık
                    </div>
                    <div class="col-lg-9 border-bottom">
                    <input type="text" name="baslik_tr" class="form-control" value="' . $sonbilgi["baslik_tr"] . '">
                    </div>
                    
                    <div class="col-lg-3 border-bottom bg-light pt-2" id="hakkimizdayazilarn">
                    EN - Başlık
                    </div>
                    <div class="col-lg-9 border-bottom">
                    <input type="text" name="baslik_en" class="form-control" value="' . $sonbilgi["baslik_en"] . '">
                    </div>
                    
                    <div class="col-lg-3 border-bottom bg-light" id="hakkimizdayazilar">
                    TR - İçerik
                    </div>
                    <div class="col-lg-9 border-bottom">
                    <textarea name="icerik_tr" cols="30" class="form-control" rows="10">' . $sonbilgi["icerik_tr"] . '</textarea>
                    </div>
                    
                    <div class="col-lg-3 border-bottom bg-light" id="hakkimizdayazilar">
                    EN - İçerik
                    </div>
                    <div class="col-lg-9 border-bottom">
                    <textarea name="icerik_en" cols="30" class="form-control" rows="10">' . $sonbilgi["icerik_en"] . '</textarea>
                    </div>
                    
                    <div class="col-lg-12 border-top">
                    <input type="submit" name="guncel" value="Güncelle" class="btn btn-primary m-2">
                    </form>
                    </div>
                    
                  
                    </div>
                    </div></div>';

        else:

            $baslik_tr = htmlspecialchars($_POST['baslik_tr']);
            $baslik_en = htmlspecialchars($_POST['baslik_en']);
            $icerik_tr = htmlspecialchars($_POST['icerik_tr']);
            $icerik_en = htmlspecialchars($_POST['icerik_en']);

            if (@$_FILES["dosya"]["name"] != ""):

                if ($_FILES["dosya"]["size"] < (1024 * 1024 * 5)):

                    $izinverilen = array("image/png", "image/jpeg");
                    if (in_array($_FILES["dosya"]["type"], $izinverilen)):

                        $dosyaninyolu = '../public/img/' . $_FILES["dosya"]["name"];
                        move_uploaded_file($_FILES["dosya"]["tmp_name"], $dosyaninyolu);
                        $veritabaniicin = str_replace('../', '', $dosyaninyolu);
                    endif;
                endif;
            endif;

            if (@$_FILES["dosya"]["name"] != ""):
                self::sorgum($vt, "update hakkimizda set baslik_tr='$baslik_tr', baslik_en='$baslik_en', icerik_tr='$icerik_tr', icerik_en='$icerik_en', resim='$veritabaniicin'", 0);
                echo '<div class="alert alert-success mt-1">Güncelleme Başarılı</div>';
                header("refresh:1,url=control.php?sayfa=hakkimizda");
            else:
                self::sorgum($vt, "update hakkimizda set baslik_tr='$baslik_tr', baslik_en='$baslik_en', icerik_tr='$icerik_tr', icerik_en='$icerik_en'", 0);
                echo '<div class="alert alert-success mt-1">Güncelleme Başarılı</div>';
                header("refresh:1,url=control.php?sayfa=hakkimizda");
            endif;

        endif;

    }


    //Hizmetlerimiz
    public function hizmetler($vt)
    {
        echo '<div class="row text-center">
                <div class="col-lg-12 border-bottom"><h3 class="float-left mt-3 text-info">Hizmetlerimiz</h3><a href="control.php?sayfa=hizmetekle" class="btn btn-success m-2 float-right">Yeni Hizmet Ekle</a></div>';
        $hizmetbilgiler = self::sorgum($vt, "select * from hizmetler", 2);
        while ($sonbilgi = $hizmetbilgiler->fetch(PDO::FETCH_ASSOC)):
            echo '<div class="col-lg-6">
                    <div class="row border border-light p-1 m-1 bg-light">
                    <div class="col-lg-11 pt-3">
                    <h5>' . $sonbilgi["baslik_tr"] . ' - ' . $sonbilgi["baslik_en"] . '</h5>
                    </div>
                    <div class="col-lg-1 text-right">
                    <a href="control.php?sayfa=hizmetguncelle&id=' . $sonbilgi["id"] . '" class="fa fa-edit m-2 text-success" style="font-size: 25px"></a>
                    <a href="control.php?sayfa=hizmetsil&id=' . $sonbilgi["id"] . '" class="fa fa-trash m-2 text-danger" style="font-size: 25px"></a>
                    </div>
                    <div class="col-lg-12 border">
                    ' . $sonbilgi["icerik_tr"] . '
                    </div>
                    <div class="col-lg-12 border">
                    ' . $sonbilgi["icerik_en"] . '
                    </div>
                    
                    </div>
                    </div>';
        endwhile;

        echo '</div>';

    }


    public function hizmetekle($vt)
    {
        echo '<div class="row text-center">
                <div class="col-lg-12 border-bottom"><h3 class="mt-3 text-info">Hizmet Ekle</h3></div>';

        if (!$_POST):


            echo '
                <div class="col-lg-12">
                    <div class="row border border-light p-1 m-1 bg-light">
                    <div class="col-lg-3 pt-3">
                    <label id="hakkimizdayazilarn">TR Başlık</label>
                    <form action="" method="post">
                    <input type="text" name="baslik_tr" class="form-control">
                    </div>
                    <div class="col-lg-3 pt-3">
                    <label id="hakkimizdayazilarn">EN Başlık</label>
                    <input type="text" name="baslik_en" class="form-control">
                    </div>
                    <div class="col-lg-9 pt-3">
                    <label id="hakkimizdayazilarn">TR İçerik</label>
                    <textarea name="icerik_tr" cols="30" class="form-control" rows="10"></textarea>
                    </div>
                    <div class="col-lg-9 pt-3">
                    <label id="hakkimizdayazilarn">EN İçerik</label>
                    <textarea name="icerik_en" cols="30" class="form-control" rows="10"></textarea>
                    </div>
                    
                    <div class="col-lg-12 m-2">
                    <input type="submit" class="btn btn-primary" name="" value="Kaydet">
                    </form>
                    </div>
                    
                    </div>
                    </div>';

        else:
            $baslik_tr = htmlspecialchars($_POST['baslik_tr']);
            $baslik_en = htmlspecialchars($_POST['baslik_en']);
            $icerik_tr = htmlspecialchars($_POST['icerik_tr']);
            $icerik_en = htmlspecialchars($_POST['icerik_en']);

            if ($baslik_tr == "" && $baslik_en == "" && $icerik_tr == "" && $icerik_en == ""):
                echo '<div class="alert alert-warning mt-1">Veriler Boş Olamaz</div>';
                header("refresh:1,url=control.php?sayfa=hizmetler");
            else:
                self::sorgum($vt, "insert into hizmetler (baslik_tr,baslik_en,icerik_tr,icerik_en) VALUES ('$baslik_tr','$baslik_en','$icerik_tr','$icerik_en')", 0);
                echo '<div class="alert alert-success mt-1">Ekleme Başarılı</div>';
                header("refresh:1,url=control.php?sayfa=hizmetler");
            endif;
        endif;

        echo '</div>';

    }


    public function hizmeteguncelleme($vt)
    {
        echo '<div class="row text-center">
                <div class="col-lg-12 border-bottom"><h3 class="mt-3 text-info">Hizmet Güncelle</h3></div>';

        $kayitid = $_GET['id'];
        $kayitbilgial = self::sorgum($vt, "select * from hizmetler where id=$kayitid", 1);
        if (!$_POST):

            echo '
                <div class="col-lg-12">
                    <div class="row border border-light p-1 m-1 bg-light">
                    <div class="col-lg-3 pt-3">
                    <label id="hakkimizdayazilarn">TR Başlık</label>
                    <form action="" method="post">
                    <input type="text" name="baslik_tr" class="form-control" value="' . $kayitbilgial['baslik_tr'] . '">
                    </div>
                    <div class="col-lg-3 pt-3">
                    <label id="hakkimizdayazilarn">EN Başlık</label>
                    <input type="text" name="baslik_en" class="form-control" value="' . $kayitbilgial['baslik_en'] . '">
                    </div>
                    <div class="col-lg-9 pt-3">
                    <label id="hakkimizdayazilarn">TR İçerik</label>
                    <textarea name="icerik_tr" cols="30" class="form-control" rows="10">' . $kayitbilgial['icerik_tr'] . '</textarea>
                    </div>
                    <div class="col-lg-9 pt-3">
                    <label id="hakkimizdayazilarn">EN İçerik</label>
                    <textarea name="icerik_en" cols="30" class="form-control" rows="10">' . $kayitbilgial['icerik_en'] . '</textarea>
                    </div>
                    
                    <div class="col-lg-12 m-2">
                    <input type="hidden" name="kayitidsi" value="' . $kayitid . '">
                    <input type="submit" class="btn btn-primary" name="" value="Güncelle">
                    </form>
                    </div>
                    
                    </div>
                    </div>';

        else:
            $baslik_tr = htmlspecialchars($_POST['baslik_tr']);
            $baslik_en = htmlspecialchars($_POST['baslik_en']);
            $icerik_tr = htmlspecialchars($_POST['icerik_tr']);
            $icerik_en = htmlspecialchars($_POST['icerik_en']);
            $kayitidsi = htmlspecialchars($_POST['kayitidsi']);

            if ($baslik_tr == "" && $baslik_en == "" && $icerik_tr == "" && $icerik_en == ""):
                echo '<div class="alert alert-warning mt-1">Veriler Boş Olamaz</div>';
                header("refresh:1,url=control.php?sayfa=hizmetler");
            else:
                self::sorgum($vt, "update hizmetler set baslik_tr='$baslik_tr',baslik_en='$baslik_en',icerik_tr='$icerik_tr',icerik_en='$icerik_en' where id=$kayitidsi", 0);
                echo '<div class="alert alert-success mt-1">Güncelleme Başarılı</div>';
                header("refresh:1,url=control.php?sayfa=hizmetler");
            endif;
        endif;

        echo '</div>';

    }


    public function hizmetsil($vt)
    {
        $hizmetid = $_GET['id'];
        self::sorgum($vt, "delete from hizmetler where id=$hizmetid", 0);
        echo '<div class="alert alert-success mt-1">Başarıyla Silindi</div>';
        header("refresh:1,url=control.php?sayfa=hizmetler");
    }


    //Referanslar
    public function referansayar($vt)
    {
        echo '<div class="row text-center">
                <div class="col-lg-12 border-bottom"><h3 class="float-left mt-3 text-info">INTRO RESIMLERİ</h3><a href="control.php?sayfa=referansresimekle" class="btn btn-success m-2 float-right">Yeni Resim Ekle</a></div>';
        $referansbilgiler = self::sorgum($vt, "select * from referanslar", 2);
        while ($sonbilgi = $referansbilgiler->fetch(PDO::FETCH_ASSOC)):
            echo '<div class="col-lg-3">
                    <div class="row border border-light p-1 m-1">
                    <div class="col-lg-10">
                    <img src="../' . $sonbilgi["resimyol"] . '">
                    </div>
                    
                    <div class="col-lg-2 text-left">
                    <a href="control.php?sayfa=referansresimsil&id=' . $sonbilgi["id"] . '" class="fa fa-trash m-2 text-danger" style="font-size: 25px"></a>
                    </div>
                    
                    </div>
                    </div>';
        endwhile;

        echo '</div>';

    }


    public function referansresimekleme($vt)
    {
        echo '<div class="row text-center">
                <div class="col-lg-12">';

        if ($_POST):

            if ($_FILES["dosya"]["name"] == ""):
                echo '<div class="alert alert-danger mt-1">Dosya Yüklenmedi. Boş Olamaz</div>';
                header("refresh:2,url=control.php?sayfa=referansresimekle");
            else:
                if ($_FILES["dosya"]["size"] > (1024 * 1024 * 5)):
                    echo '<div class="alert alert-danger mt-1">Dosyanın boyutu çok fazla</div>';
                    header("refresh:2,url=control.php?sayfa=referansresimekle");
                else:
                    $izinverilen = array("image/png", "image/jpeg");

                    if (!in_array($_FILES["dosya"]["type"], $izinverilen)):
                        echo '<div class="alert alert-danger mt-1">İzin verilen uzantı değil</div>';
                        header("refresh:2,url=control.php?sayfa=referansresimekle");
                    else:
                        $dosyaninyolu = '../public/img/referans/' . $_FILES["dosya"]["name"];
                        move_uploaded_file($_FILES["dosya"]["tmp_name"], $dosyaninyolu);
                        echo '<div class="alert alert-success mt-1">Dosya Başarıyla Yüklendi</div>';
                        header("refresh:2,url=control.php?sayfa=referansayar");

                        $dosyaninyolu2 = str_replace('../', '', $dosyaninyolu);
                        self::sorgum($vt, "insert into referanslar (resimyol) VALUES('$dosyaninyolu2')", 0);
                    endif;

                endif;

            endif;
        else:
            ?>
            <div class="col-lg-4 mx-auto mt-2">
                <div class="card card-bordered">
                    <div class="card-body">
                        <h5 class="title border-bottom">Referans Resim Yükleme</h5>
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


    public function referanssil($vt)
    {
        $referansid = $_GET['id'];
        $verial = self::sorgum($vt, "select * from referanslar where id=$referansid", 1);

        echo '<div class="row text-center">
                <div class="col-lg-12">';

        unlink("../" . $verial['resimyol']);
        self::sorgum($vt, "delete from referanslar where id=$referansid", 0);
        echo '<div class="alert alert-success mt-1">Dosya Başarıyla Silindi</div>';
        echo '</div></div>';
        header("refresh:2,url=control.php?sayfa=referansayar");
    }


    //Yorumlarımız
    public function yorumlar($vt)
    {
        echo '<div class="row text-center">
                <div class="col-lg-12 border-bottom"><h3 class="float-left mt-3 text-info">Yorumlarımız</h3><a href="control.php?sayfa=yorumekle" class="btn btn-success m-2 float-right">Yeni Yorum Ekle</a></div>';
        $yorumbilgiler = self::sorgum($vt, "select * from yorumlar", 2);
        while ($sonbilgi = $yorumbilgiler->fetch(PDO::FETCH_ASSOC)):
            echo '<div class="col-lg-6">
                    <div class="row border border-light p-1 m-1 bg-light">
                    <div class="col-lg-11 pt-3">
                    <h5>' . $sonbilgi["isim"] . '</h5>
                    </div>
                    <div class="col-lg-1 text-right">
                    <a href="control.php?sayfa=yorumguncelle&id=' . $sonbilgi["id"] . '" class="fa fa-edit m-2 text-success" style="font-size: 25px"></a>
                    <a href="control.php?sayfa=yorumsil&id=' . $sonbilgi["id"] . '" class="fa fa-trash m-2 text-danger" style="font-size: 25px"></a>
                    </div>
                    <div class="col-lg-12 border">
                    ' . $sonbilgi["icerik"] . '
                    </div>
                    
                    </div>
                    </div>';
        endwhile;

        echo '</div>';

    }


    public function yorumekle($vt)
    {
        echo '<div class="row text-center">
                <div class="col-lg-12 border-bottom"><h3 class="mt-3 text-info">Yorum Ekle</h3></div>';

        if (!$_POST):


            echo '
                <div class="col-lg-12">
                    <div class="row border border-light p-1 m-1 bg-light">
                    <div class="col-lg-3 pt-3">
                    <label id="hakkimizdayazilarn">Başlık</label>
                    <form action="" method="post">
                    <input type="text" name="isim" class="form-control">
                    </div>
                    <div class="col-lg-9 pt-3">
                    <label id="hakkimizdayazilarn">İçerik</label>
                    <textarea name="icerik" cols="30" class="form-control" rows="10"></textarea>
                    </div>
                    
                    <div class="col-lg-12 m-2">
                    <input type="submit" class="btn btn-primary" name="" value="Kaydet">
                    </form>
                    </div>
                    
                    </div>
                    </div>';

        else:
            $isim = htmlspecialchars($_POST['isim']);
            $icerik = htmlspecialchars($_POST['icerik']);

            if ($isim == "" && $icerik == ""):
                echo '<div class="alert alert-warning mt-1">Veriler Boş Olamaz</div>';
                header("refresh:1,url=control.php?sayfa=yorumlar");
            else:
                self::sorgum($vt, "insert into yorumlar (isim,icerik) VALUES ('$isim','$icerik')", 0);
                echo '<div class="alert alert-success mt-1">Ekleme Başarılı</div>';
                header("refresh:1,url=control.php?sayfa=yorumlar");
            endif;
        endif;

        echo '</div>';

    }


    public function yorumguncelleme($vt)
    {
        echo '<div class="row text-center">
                <div class="col-lg-12 border-bottom"><h3 class="mt-3 text-info">Yorum Güncelle</h3></div>';

        $kayitid = $_GET['id'];
        $kayitbilgial = self::sorgum($vt, "select * from yorumlar where id=$kayitid", 1);
        if (!$_POST):

            echo '
                <div class="col-lg-12">
                    <div class="row border border-light p-1 m-1 bg-light">
                    <div class="col-lg-3 pt-3">
                    <label id="hakkimizdayazilarn">Başlık</label>
                    <form action="" method="post">
                    <input type="text" name="isim" class="form-control" value="' . $kayitbilgial['isim'] . '">
                    </div>
                    <div class="col-lg-9 pt-3">
                    <label id="hakkimizdayazilarn">İçerik</label>
                    <textarea name="icerik" cols="30" class="form-control" rows="10">' . $kayitbilgial['icerik'] . '</textarea>
                    </div>
                    
                    <div class="col-lg-12 m-2">
                    <input type="hidden" name="kayitidsi" value="' . $kayitid . '">
                    <input type="submit" class="btn btn-primary" name="" value="Güncelle">
                    </form>
                    </div>
                    
                    </div>
                    </div>';

        else:
            $isim = htmlspecialchars($_POST['isim']);
            $icerik = htmlspecialchars($_POST['icerik']);
            $kayitidsi = htmlspecialchars($_POST['kayitidsi']);

            if ($isim == "" && $icerik == ""):
                echo '<div class="alert alert-warning mt-1">Veriler Boş Olamaz</div>';
                header("refresh:1,url=control.php?sayfa=yorumlar");
            else:
                self::sorgum($vt, "update yorumlar set isim='$isim',icerik='$icerik' where id=$kayitidsi", 0);
                echo '<div class="alert alert-success mt-1">Güncelleme Başarılı</div>';
                header("refresh:1,url=control.php?sayfa=yorumlar");
            endif;
        endif;

        echo '</div>';

    }


    public function yorumsil($vt)
    {
        $yorumid = $_GET['id'];
        self::sorgum($vt, "delete from yorumlar where id=$yorumid", 0);
        echo '<div class="alert alert-success mt-1">Başarıyla Silindi</div>';
        header("refresh:1,url=control.php?sayfa=yorumlar");
    }


    //mail ayarlar
    public function mailayar($baglanti)
    {
        $sonuc = self::sorgum($baglanti, "select * from gelenmailayar", 1);

        if ($_POST):
            $host = htmlspecialchars($_POST['host']);
            $mailadres = htmlspecialchars($_POST['mailadres']);
            $sifre = htmlspecialchars($_POST['sifre']);
            $port = htmlspecialchars($_POST['port']);
            $aliciadres = htmlspecialchars($_POST['aliciadres']);

            $guncelleme = $baglanti->prepare("update gelenmailayar set host=?,mailadres=?,sifre=?,port=?,aliciadres=?");
            $guncelleme->bindParam(1, $host, PDO::PARAM_STR);
            $guncelleme->bindParam(2, $mailadres, PDO::PARAM_STR);
            $guncelleme->bindParam(3, $sifre, PDO::PARAM_STR);
            $guncelleme->bindParam(4, $port, PDO::PARAM_STR);
            $guncelleme->bindParam(5, $aliciadres, PDO::PARAM_STR);
            $guncelleme->execute();

            echo '<div class="alert alert-success mt-5">
                    Mail ayarları başarıyla güncellendi
                </div>';
            header("refresh:1,url=control.php?sayfa=mailayar");

        else:
            ?>
            <form action="control.php?sayfa=mailayar" method="post">
                <div class="card-body">
                    <div class="col-lg-6 mx-auto">
                        <div class="col-lg-12 mx-auto">
                            <h3 class="text-info">MAİL AYARLARI ></h3>
                        </div>
                        <div class="col-lg-12 mx-auto mt-2 border">
                            <div class="form-row">
                                <div class="col-lg-4 border-right p-3">
                                    <label id="siteayarfont">Host</label>
                                </div>
                                <div class="col-lg-8 p-2">
                                    <input type="text" name="host" class="form-control" value="<?= $sonuc['host']; ?>">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 mx-auto border">
                            <div class="form-row">
                                <div class="col-lg-4 border-right p-3">
                                    <label id="siteayarfont">Mail Adres</label>
                                </div>
                                <div class="col-lg-8 p-2">
                                    <input type="text" name="mailadres" class="form-control"
                                           value="<?= $sonuc['mailadres']; ?>">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 mx-auto border">
                            <div class="form-row">
                                <div class="col-lg-4 border-right p-3">
                                    <label id="siteayarfont">Host Şifre</label>
                                </div>
                                <div class="col-lg-8 p-2">
                                    <input type="text" name="sifre" class="form-control"
                                           value="<?= $sonuc['sifre']; ?>">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 mx-auto border">
                            <div class="form-row">
                                <div class="col-lg-4 border-right p-3">
                                    <label id="siteayarfont">Port</label>
                                </div>
                                <div class="col-lg-8 p-2">
                                    <input type="text" name="port" class="form-control"
                                           value="<?= $sonuc['port']; ?>">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 mx-auto border">
                            <div class="form-row">
                                <div class="col-lg-4 border-right p-3">
                                    <label id="siteayarfont">Alıcı Mail Adres</label>
                                </div>
                                <div class="col-lg-8 p-2">
                                    <input type="text" name="aliciadres" class="form-control"
                                           value="<?= $sonuc['aliciadres']; ?>">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 mx-auto mt-2">
                            <button type="submit" name="buton" class="btn btn-info">Güncelle</button>
                        </div>

                    </div>


            </form>
        <?php
        endif;
    }


    //kullanıcı ayarlar
    public function ayarlar($baglanti)
    {
        $id = self::coz($_COOKIE['kulbilgi']);
        $sonuc = self::sorgum($baglanti, "select * from yonetim where id=$id", 1);

        if ($_POST):
            @$kulad = htmlspecialchars($_POST['kulad']);
            @$eskisif = htmlspecialchars($_POST['sifre']);
            @$yenisif = htmlspecialchars($_POST['yenisifre']);
            @$yenisif2 = htmlspecialchars($_POST['yenisifre2']);

            if (empty($kulad) || empty($eskisif) || empty($yenisif) || empty($yenisif2)):

                echo '<div class="alert alert-danger mt-2">Hiçbir alan boş geçilemez</div>';
                header("refresh:1,url=control.php?sayfa=ayarlar");
            else:

                $sifrelihal = md5(sha1(md5($eskisif)));
                if ($sonuc['sifre'] != $sifrelihal):

                    echo '<div class="alert alert-danger mt-2">Eski Şifre Hatalı</div>';
                    header("refresh:1,url=control.php?sayfa=ayarlar");
                else:

                    if ($yenisif != $yenisif2):

                        echo '<div class="alert alert-danger mt-2">Yeni Şifreler Uyuşmuyor</div>';
                        header("refresh:1,url=control.php?sayfa=ayarlar");
                    else:
                        $yenisifson = md5(sha1(md5($yenisif)));
                        $guncelleme = $baglanti->prepare("update yonetim set kulad=?,sifre=? where id=$id");

                        $guncelleme->bindParam(1, $kulad, PDO::PARAM_STR);
                        $guncelleme->bindParam(2, $yenisifson, PDO::PARAM_STR);
                        $guncelleme->execute();

                        echo '<div class="alert alert-success mt-5">
                    Bilgiler Başarıyla Güncellendi
                </div>';
                        header("refresh:1,url=control.php?sayfa=ayarlar");

                    endif;


                endif;

            endif;

        else:
            ?>
            <form action="control.php?sayfa=ayarlar" method="post">
                <div class="card-body">
                    <div class="col-lg-6 mx-auto">
                        <div class="col-lg-12 mx-auto">
                            <h3 class="text-info">KULLANICI AYARLARI ></h3>
                        </div>
                        <div class="col-lg-12 mx-auto mt-2 border">
                            <div class="form-row">
                                <div class="col-lg-4 border-right p-3">
                                    <label id="siteayarfont">Kullanıcı Adı</label>
                                </div>
                                <div class="col-lg-8 p-2">
                                    <input type="text" name="kulad" class="form-control"
                                           value="<?= $sonuc['kulad']; ?>">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 mx-auto border">
                            <div class="form-row">
                                <div class="col-lg-4 border-right p-3">
                                    <label id="siteayarfont">Şifre</label>
                                </div>
                                <div class="col-lg-8 p-2">
                                    <input type="password" name="sifre" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 mx-auto border">
                            <div class="form-row">
                                <div class="col-lg-4 border-right p-3">
                                    <label id="siteayarfont">Yeni Şifre</label>
                                </div>
                                <div class="col-lg-8 p-2">
                                    <input type="password" name="yenisifre" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 mx-auto border">
                            <div class="form-row">
                                <div class="col-lg-4 border-right p-3">
                                    <label id="siteayarfont">Yeni Şifre Tekrar</label>
                                </div>
                                <div class="col-lg-8 p-2">
                                    <input type="password" name="yenisifre2" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 mx-auto mt-2">
                            <button type="submit" name="buton" class="btn btn-info">Değiştir</button>
                        </div>

                    </div>


            </form>
        <?php
        endif;
    }


    //kullanıcı ekleme ve silme
    public function kullistele($vt)
    {

        $al = self::sorgum($vt, "select * from yonetim", 2);

        echo '
            <div class="row">
            <div class="col-lg-6 mt-5 mx-auto">
            <div class="card">
            <div class="card-body">
            <h4 class="header-title">
            <a href="control.php?sayfa=yonekle"><i class="ti-plus bg-dark p-1 text-white mr-2 mt-3"></i></a>
            Kullanıcılar</h4>
            <div class="single-table">
            <div class="table-responsive">
            <table class="table text-center border">
            <thead class="text-uppercase">
            <tr>
            <th scope="col" class="border-right">Kullanıcı Adı</th>
            <th scope="col">İşlem</th>
            </tr>
            </thead>
            <tbody>';

        while ($yonson = $al->fetch(PDO::FETCH_ASSOC)):

            echo '<tr>
            <th scope="row" class="border-right">' . $yonson['kulad'] . '</th>
            <th scope="row"><a href="control.php?sayfa=yonsil&id=' . $yonson['id'] . '"><i class="ti-trash text-danger" style="font-size: 18px;"></i></a></th>
            </tr>';
        endwhile;

        echo '</tbody>
            </table>
</div>
</div>
</div>
</div>
</div>
</div>
        
        ';
    }


    public function yonsil($vt, $id)
    {

        echo '<div class="row m-2">
                <div class="col-lg-12 bg-light mt-2 font-weight-bold" style="border-radius: 5px; border:1px solid #eeeeee;">       
                    <div class="alert alert-info mt-2 mb-2">Yönetici Silindi</div>
                </div>
              </div>';
        header("refresh:1,url=control.php?sayfa=kullaniciayar");

        self::sorgum($vt, "delete from yonetim where id=$id", 0);
    }


    public function yonekle($baglanti)
    {

        if ($_POST):
            @$kulad = htmlspecialchars($_POST['kulad']);
            @$yenisif = htmlspecialchars($_POST['yenisifre']);
            @$yenisif2 = htmlspecialchars($_POST['yenisifre2']);

            if (empty($kulad) || empty($yenisif) || empty($yenisif2)):

                echo '<div class="alert alert-danger mt-2">Hiçbir alan boş geçilemez</div>';
                header("refresh:1,url=control.php?sayfa=yonekle");
            else:

                if ($yenisif != $yenisif2):

                    echo '<div class="alert alert-danger mt-2">Şifreler Uyuşmuyor</div>';
                    header("refresh:1,url=control.php?sayfa=yonekle");
                else:
                    $yenisifson = md5(sha1(md5($yenisif)));
                    $ekle = $baglanti->prepare("insert into yonetim (kulad,sifre) VALUES (?,?)");

                    $ekle->bindParam(1, $kulad, PDO::PARAM_STR);
                    $ekle->bindParam(2, $yenisifson, PDO::PARAM_STR);
                    $ekle->execute();

                    echo '<div class="alert alert-success mt-5">
                    Yönetici Eklendi
                </div>';
                    header("refresh:1,url=control.php?sayfa=kullaniciayar");

                endif;


            endif;

        else:
            ?>
            <form action="control.php?sayfa=yonekle" method="post">
                <div class="card-body">
                    <div class="col-lg-6 mx-auto">
                        <div class="col-lg-12 mx-auto">
                            <h3 class="text-info">YÖNETİCİ EKLE ></h3>
                        </div>
                        <div class="col-lg-12 mx-auto mt-2 border">
                            <div class="form-row">
                                <div class="col-lg-4 border-right p-3">
                                    <label id="siteayarfont">Kullanıcı Adı</label>
                                </div>
                                <div class="col-lg-8 p-2">
                                    <input type="text" name="kulad" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 mx-auto border">
                            <div class="form-row">
                                <div class="col-lg-4 border-right p-3">
                                    <label id="siteayarfont">Yeni Şifre</label>
                                </div>
                                <div class="col-lg-8 p-2">
                                    <input type="password" name="yenisifre" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 mx-auto border">
                            <div class="form-row">
                                <div class="col-lg-4 border-right p-3">
                                    <label id="siteayarfont">Yeni Şifre Tekrar</label>
                                </div>
                                <div class="col-lg-8 p-2">
                                    <input type="password" name="yenisifre2" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 mx-auto mt-2">
                            <button type="submit" name="buton" class="btn btn-info">Kaydet</button>
                        </div>

                    </div>


            </form>
        <?php
        endif;
    }


    //Tasarim Yönetimi
    private function tasarimgetir($gelenTercih, $radioName)
    {
        foreach ($this->tercihArray as $key => $value):
            if ($gelenTercih == $key):
                echo '<label>' . $value . '<input type = "radio" name = "' . $radioName . '" value = "' . $key . '" checked = "checked" class="form-control" ></label>';
            else:
                echo '<label>' . $value . '<input type = "radio" name = "' . $radioName . '" value = "' . $key . '" class="form-control" ></label>';
            endif;
        endforeach;
    }


    public function tasarimYonetim($vt)
    {
        echo '<div class="row text-center">
                <div class="col-lg-12 border-bottom"><h3 class="mt-3 text-info">Tasarım Yönetimi</h3></div>';

        $kayitbilgial = self::sorgum($vt, "select * from tasarim", 1);
        if (!$_POST):

            echo '
                <div class="col-lg-12">
                    <div class="row border border-light p-1 m-1 bg-light">
                    <form action="" method="post">
                    <div class="col-lg-6 pt-2">
                    <label id="hakkimizdayazilarn">HİZMETLER</label> ';

            self::tasarimgetir($kayitbilgial['hiztercih'], "hiztercih");

            echo '</div>
                    <div class="col-lg-6 pt-2">
                    <label id="hakkimizdayazilarn">REFERANSLAR</label>';

            self::tasarimgetir($kayitbilgial['reftercih'], "reftercih");

            echo '</div>
                   <div class="col-lg-6 pt-2">
                    <label id="hakkimizdayazilarn">YORUMLAR</label>';

            self::tasarimgetir($kayitbilgial['yorumtercih'], "yorumtercih");

            echo '</div>
                   
                    <div class="col-lg-6 pt-2">
                    <label id="hakkimizdayazilarn">VİDEOLAR</label>';

            self::tasarimgetir($kayitbilgial['videotercih'], "videotercih");

            echo '</div>
                   
                   <div class="col-lg-6 pt-2">
                    <label id="hakkimizdayazilarn">BÜLTEN</label>';

            self::tasarimgetir($kayitbilgial['bultentercih'], "bultentercih");

            echo '</div>
                    
                    <div class="col-lg-12 m-2">
                    <input type="hidden" name="kayitidsi" value="' . $kayitbilgial['id'] . '">
                    <input type="submit" class="btn btn-primary" name="" value="Güncelle">
                    </div>
                     </form>
                    </div>
                    </div>';

        else:
            $hiztercih = $_POST['hiztercih'];
            $reftercih = $_POST['reftercih'];
            $yorumtercih = $_POST['yorumtercih'];
            $videotercih = $_POST['videotercih'];
            $bultentercih = $_POST['bultentercih'];
            $kayitidsi = $_POST['kayitidsi'];

            self::sorgum($vt, "update tasarim set hiztercih=$hiztercih,reftercih=$reftercih,yorumtercih=$yorumtercih, videotercih=$videotercih, bultentercih=$bultentercih where id=$kayitidsi", 0);
            echo '<div class="alert alert-success mt-1">Güncelleme Başarılı</div>';
            header("refresh:1,url=control.php?sayfa=tas");
        endif;

        echo '</div>';

    }


    //Veritaban bakım
    public function bakim($db)
    {
        echo '<div class="row text-center">
                <div class="col-lg-12 text-center">';

        if ($_POST):

            $tablolar = $this->sorgum($db, "SHOW TABLES", 2);
            while ($tabloson = $tablolar->fetch(PDO::FETCH_ASSOC)):
                $db->query("REPAIR TABLE " . $tabloson['Tables_in_kurumsal']);
                $db->query("OPTIMIZE TABLE " . $tabloson['Tables_in_kurumsal']);
                echo '<div class="alert alert-success mt-1 col-lg-4 mx-auto"><b>' . $tabloson['Tables_in_kurumsal'] . '</b> 
                        tablosuna işlem yapıldı.</div>';
            endwhile;
            echo '</div>';

            $zaman = date('d/m/Y - H:i');
            self::sorgum($db, "update ayarlar set bakimzaman='$zaman'", 0);

        else:

            ?>
            <div class="col-lg-4 mx-auto mt-2">
                <div class="card card-bordered">
                    <div class="card-body">
                        <h5 class="title border-bottom">Veritabanı Bakım</h5>
                        <form action="" method="post">
                            <input type="submit" class="btn btn-primary mb-1" name="buton" value="Bakımı Başlat">
                        </form>

                        <?php

                        $zamanbak = self::sorgum($db, "select bakimzaman from ayarlar", 1);
                        echo '<div class="alert alert-warning mt-1 mx-auto">En son bakım: <b>' . $zamanbak['bakimzaman'] . '</b> 
                        tarihinde yapıldı.</div>';

                        ?>
                    </div>
                </div>
            </div>

        <?php
        endif;
        echo '</div>';


    }

}
