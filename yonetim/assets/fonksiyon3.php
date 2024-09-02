<?php

include_once 'fonksiyon.php';

class yonetim3 extends yonetim
{

//    protected $maillerimiz = array();

    protected $idler = array();

    //Linkler
    public function linkayar($vt)
    {
        echo '<div class="row text-center">
                <div class="col-lg-12 border-bottom"><h3 class="float-left mt-3 text-info">Link Kontrol</h3>
                <a href="control.php?sayfa=linkekle" class="btn btn-success m-2 float-right">Yeni Link Ekle</a></div>';
        $linkbilgiler = parent::sorgum($vt, "select * from linkler", 2);
        while ($sonbilgi = $linkbilgiler->fetch(PDO::FETCH_ASSOC)):
            echo '<div class="col-lg-6">
                    <div class="row card-bordered p-1 m-1 bg-light">
                    <div class="col-lg-10 pt-2">
                    <h5><kbd class="float-left">Sira: ' . $sonbilgi["siralama"] . '</kbd> ' . $sonbilgi["ad_tr"] . ' - ' . $sonbilgi["ad_en"] . '</h5>
                    </div>
                    <div class="col-lg-2 text-right">
                    <a href="control.php?sayfa=linkguncelle&id=' . $sonbilgi["id"] . '" class="fa fa-edit m-2 text-success" style="font-size: 20px"></a>
                    <a href="control.php?sayfa=linksil&id=' . $sonbilgi["id"] . '" class="fa fa-trash m-2 text-danger" style="font-size: 20px"></a>
                    </div>
                    <div class="col-lg-12 border">
                    ' . $sonbilgi["etiket"] . '
                    </div>
                    
                    </div>
                    </div>';
        endwhile;

        echo '</div>';

    }


    public function linkekle($vt)
    {
        $linkbilgiler = parent::sorgum($vt, "select * from linkler order by siralama desc LIMIT 1", 2);
        $sonbilgi = $linkbilgiler->fetch(PDO::FETCH_ASSOC);
        $sayi = $sonbilgi['siralama'] + 1;
        echo '<div class="row text-center">
                <div class="col-lg-12 border-bottom"><h3 class="mt-3 text-info">Link Ekle</h3></div>';

        if (!$_POST):


            echo '
                <div class="col-lg-12">
                    <div class="row border border-light p-1 m-1 bg-light">
                    <div class="col-lg-3 pt-3">
                    <label id="hakkimizdayazilarn">TR Link</label>
                    <form action="" method="post">
                    <input type="text" name="ad_tr" class="form-control">
                    </div>
                    <div class="col-lg-3 pt-3">
                    <label id="hakkimizdayazilarn">EN Link</label>
                    <input type="text" name="ad_en" class="form-control">
                    </div>
                    <div class="col-lg-3 pt-3">
                    <label id="hakkimizdayazilarn">Etiket</label>
                    <input type="text" name="etiket" class="form-control">
                    </div>
                    <div class="col-lg-3 pt-3">
                    <label id="hakkimizdayazilarn">Link Sırası</label>
                    <select name="sira" class="form-control">
                    <option value="' . $sayi . '">' . $sayi . '</option>
                    </select>
                    </div>
                    
                    <div class="col-lg-12 m-2">
                    <input type="submit" class="btn btn-primary" name="" value="Kaydet">
                    </form>
                    </div>
                    
                    </div>
                    </div>';

        else:
            $ad_tr = htmlspecialchars($_POST['ad_tr']);
            $ad_en = htmlspecialchars($_POST['ad_en']);
            $etiket = htmlspecialchars($_POST['etiket']);
            $siralama = htmlspecialchars($_POST['sira']);

            if ($ad_tr == "" && $ad_en == "" && $etiket == ""):
                echo '<div class="alert alert-warning mt-1">Veriler Boş Olamaz</div>';
                header("refresh:1,url=control.php?sayfa=linkayar");
            else:
                parent::sorgum($vt, "insert into linkler (ad_tr,ad_en,etiket,siralama) VALUES ('$ad_tr','$ad_en','$etiket','$siralama')", 0);
                echo '<div class="alert alert-success mt-1">Ekleme Başarılı</div>';
                header("refresh:1,url=control.php?sayfa=linkayar");
            endif;
        endif;

        echo '</div>';

    }


    public function linkguncelle($vt)
    {

        $linklerebak = parent::sorgum($vt, "select * from linkler", 2);


        echo '<div class="row text-center">
                <div class="col-lg-12 border-bottom"><h3 class="mt-3 text-info">Link Güncelle</h3></div>';

        $kayitid = $_GET['id'];
        $kayitbilgial = parent::sorgum($vt, "select * from linkler where id=$kayitid", 1);
        if (!$_POST):

            echo '
                <div class="col-lg-12">
                    <div class="row border border-light p-1 m-1 bg-light">
                    <div class="col-lg-3 pt-3">
                    <label id="hakkimizdayazilarn">TR Link</label>
                    <form action="" method="post">
                    <input type="text" name="ad_tr" class="form-control" value="' . $kayitbilgial['ad_tr'] . '">
                    </div>
                    <div class="col-lg-3 pt-3">
                    <label id="hakkimizdayazilarn">EN Link</label>
                    <input type="text" name="ad_en" class="form-control" value="' . $kayitbilgial['ad_en'] . '">
                    </div>
                    <div class="col-lg-3 pt-3">
                    <label id="hakkimizdayazilarn">Etiket</label>
                    <input type="text" name="etiket" class="form-control" value="' . $kayitbilgial['etiket'] . '">
                    </div>
                    <div class="col-lg-3 pt-3">
                    <label id="hakkimizdayazilarn">Link Sırası: ' . $kayitbilgial['siralama'] . '</label>
                    <select name="gideceksira" class="form-control">';
            while ($sonbilgi = $linklerebak->fetch(PDO::FETCH_ASSOC)):
                if ($sonbilgi['siralama'] != $kayitbilgial['siralama']):
                    echo '<option value = "' . $sonbilgi['siralama'] . '" >' . $sonbilgi['siralama'] . ' - ' . $sonbilgi['ad_tr'] . '</option >';
                endif;
            endwhile;

            echo '</select>
                    </div>
                    
                    <div class="col-lg-12 m-2">
                    <input type="hidden" name="kayitidsi" value="' . $kayitid . '">
                    <input type="hidden" name="mevcutsira" value="' . $kayitbilgial['siralama'] . '">
                    <input type="submit" class="btn btn-primary" name="" value="Güncelle">
                    </form>
                    </div>
                    
                    </div>
                    </div>';

        else:
            $ad_tr = htmlspecialchars($_POST['ad_tr']);
            $ad_en = htmlspecialchars($_POST['ad_en']);
            $etiket = htmlspecialchars($_POST['etiket']);
            $mevcutsira = htmlspecialchars($_POST['mevcutsira']);
            $gideceksira = htmlspecialchars($_POST['gideceksira']);
            $kayitidsi = htmlspecialchars($_POST['kayitidsi']);

            if ($ad_tr == "" && $ad_en == "" && $etiket == ""):
                echo '<div class="alert alert-warning mt-1">Veriler Boş Olamaz</div>';
                header("refresh:1,url=control.php?sayfa=linkayar");
            else:

                parent::sorgum($vt, "update linkler set siralama=$mevcutsira where siralama=$gideceksira", 0);

                parent::sorgum($vt, "update linkler set ad_tr='$ad_tr',ad_en='$ad_en',etiket='$etiket', siralama=$gideceksira where id=$kayitidsi", 0);
                echo '<div class="alert alert-success mt-1">Güncelleme Başarılı</div>';
                header("refresh:1,url=control.php?sayfa=linkayar");
            endif;
        endif;

        echo '</div>';

    }


    public function linksil($vt)
    {
        $linkid = $_GET['id'];
        parent::sorgum($vt, "delete from linkler where id=$linkid", 0);
        echo '<div class="alert alert-success mt-1">Başarıyla Silindi</div>';
        header("refresh:1,url=control.php?sayfa=linkayar");
    }


    //Video yonetimi
    public function videolar($vt)
    {
        echo '<div class="row text-center">
                <div class="col-lg-12 border-bottom"><h3 class="float-left mt-3 text-dark mb-2">
                <a href="control.php?sayfa=videoekle" class="ti-plus bg-dark text-white p-1 m-2"></a>
                VİDEOLAR</h3>
                
                <h6 class="float-right mt-3 text-dark mb-2">
                <a href="control.php?sayfa=videolar&tercih=1" class="ti-check bg-success text-white p-1 m-2"></a>
                <a href="control.php?sayfa=videolar&tercih=0" class="ti-close bg-danger text-white p-1 m-2"></a>
                </h6>
                </div>';
        $aldi = @$_GET['tercih'];
        if ($aldi != ""):
            $videobilgiler = parent::sorgum($vt, "select * from videolar where durum=$aldi", 2);
        else:
            $videobilgiler = parent::sorgum($vt, "select * from videolar", 2);
        endif;
        while ($sonbilgi = $videobilgiler->fetch(PDO::FETCH_ASSOC)):

            echo '<div class="col-lg-4 col-md-4 p-1">
                    <div class="row p-1 m-1">
                    <div class="col-lg-12">
                    <div class="embed-responsive embed-responsive-16by9">
                    <iframe src="https://www.youtube.com/embed/' . $sonbilgi['link'] . '" allowfullscreen class="embed-responsive-item"></iframe>
                    </div>
                    <kbd class="bg-white p-2 text-dark" style="position: absolute; bottom: 20px; right: 10px">
                    Sira: ' . $sonbilgi["siralama"] . ' Durum: ' . $sonbilgi["durum"] . '
                    <a href="control.php?sayfa=videoguncelle&id=' . $sonbilgi["id"] . '" class="ti-reload m-2 text-success" style="font-size: 25px"></a>
                    <a href="control.php?sayfa=videosil&id=' . $sonbilgi["id"] . '" class="ti-trash m-2 text-danger" style="font-size: 25px"></a>
                    </kbd>
                </div></div></div>';
        endwhile;

        echo '</div>';

    }


    public function videoekle($vt)
    {
        echo '<div class="row text-center">
                <div class="col-lg-12">';

        if ($_POST):
            $videoyol = htmlspecialchars(strip_tags($_POST['videoyol']));
            $siralama = htmlspecialchars(strip_tags($_POST['siralama']));
            $durum = htmlspecialchars(strip_tags($_POST['durum']));

            if (empty($videoyol) || empty($siralama)):
                echo '<div class="alert alert-danger mt-2">Alanlar Boş Olamaz</div>';
                header("refresh:1,url=control.php?sayfa=videolar");

            else:
                parent::sorgum($vt, "insert into videolar (link,siralama,durum) VALUES('$videoyol',$siralama,$durum)", 0);
                echo '<div class="alert alert-success mt-1">Ekleme Başarılı</div>';
                header("refresh:1,url=control.php?sayfa=videolar");
            endif;
        else:
            ?>
            <div class="col-lg-4 mx-auto mt-2">
                <div class="card card-bordered">
                    <div class="card-body">
                        <h5 class="title border-bottom">Video Ekleme Formu</h5>
                        <form action="" method="post">
                            <p class="card-text">
                                <input type="text" required name="videoyol" class="form-control"
                                       placeholder="Video yolu">
                            </p>
                            <p class="card-text">
                                <input type="number" required name="siralama" class="form-control"
                                       placeholder="Video sırası">
                            </p>
                            <p class="card-text">
                                <select name="durum" class="form-control">
                                    <option value="1">Aktif</option>
                                    <option value="0">Pasif</option>
                                </select>
                            </p>
                            <input type="submit" class="btn btn-primary mb-1" name="buton" value="Ekle">
                        </form>
                    </div>
                </div>
            </div>

        <?php

        endif;
        echo '</div></div>';
    }


    public function videosil($vt)
    {
        $videoid = $_GET['id'];

        echo '<div class="row text-center">
                <div class="col-lg-12">';
        parent::sorgum($vt, "delete from videolar where id=$videoid", 0);
        echo '<div class="alert alert-success mt-1">Video Başarıyla Silindi</div>';
        echo '</div></div>';
        header("refresh:1,url=control.php?sayfa=videolar");
    }


    public function videoguncelle($vt)
    {
        $gelenvideoid = $_GET['id'];
        $videobilgiler = parent::sorgum($vt, "select * from videolar where id=$gelenvideoid", 2);
        $sonbilgi = $videobilgiler->fetch(PDO::FETCH_ASSOC);
        $tumvideolar = parent::sorgum($vt, "select * from videolar", 2);

        echo '<div class="row text-center">
                <div class="col-lg-12">';

        if ($_POST):
            $videoyol = htmlspecialchars(strip_tags($_POST['videoyol']));
            $siralama = htmlspecialchars(strip_tags($_POST['siralama']));
            $mevcutsira = htmlspecialchars(strip_tags($_POST['mevcutsira']));
            $durum = htmlspecialchars(strip_tags($_POST['durum']));

            if (empty($videoyol) || empty($siralama)):
                echo '<div class="alert alert-danger mt-2">Alanlar Boş Olamaz</div>';
                header("refresh:1,url=control.php?sayfa=videolar");

            else:
                parent::sorgum($vt, "update videolar set siralama=$mevcutsira where siralama=$siralama", 0);
                parent::sorgum($vt, "update videolar set link='$videoyol',siralama=$siralama,durum=$durum where id=$gelenvideoid", 0);
                echo '<div class="alert alert-success mt-1">VİDEO GÜNCELLENDİ</div>';
                header("refresh:1,url=control.php?sayfa=videolar");
            endif;
        else:
            ?>
            <div class="col-lg-4 mx-auto mt-2">
                <div class="card card-bordered">
                    <div class="card-body">
                        <h5 class="title border-bottom">Video Güncelleme Formu</h5>
                        <form action="" method="post">
                            <p class="card-text text-primary"> Video Linki
                                <input type="text" required name="videoyol" class="form-control"
                                       value="<?php echo $sonbilgi['link'] ?>">
                            </p>
                            <p class="card-text text-primary"> Video Sırası: <?php echo $sonbilgi['siralama']; ?>
                                <select name="siralama" class="form-control">
                                    <?php
                                    while ($tumvideoson = $tumvideolar->fetch(PDO::FETCH_ASSOC)):
                                        if ($tumvideoson['siralama'] != $sonbilgi['siralama']):
                                            echo '<option value="' . $tumvideoson['siralama'] . '">' . $tumvideoson['siralama'] . '</option>';
                                        endif;
                                    endwhile;
                                    ?>
                                </select>

                            </p>
                            <p class="card-text text-primary"> Video Durum
                                <select name="durum" class="form-control">
                                    <?php
                                    if ($sonbilgi['durum'] == 0):
                                        echo '<option value="1">Aktif</option><option value="0" selected="selected">Pasif</option>';
                                    else:
                                        echo '<option value="1" selected="selected">Aktif</option><option value="0">Pasif</option>';
                                    endif;
                                    ?>
                                </select>
                            </p>
                            <input type="hidden" name="mevcutsira" value=" <?php echo $sonbilgi['siralama']; ?>">
                            <input type="submit" class="btn btn-primary mb-1" name="buton" value="Güncelle">
                        </form>
                    </div>
                </div>
            </div>

        <?php

        endif;
        echo '</div></div>';
    }


    //Bülten
    public function satirsayisi($db)
    {
        return parent::sorgum($db, "select * from bulten", 2)->rowCount();
    }


    public function Aramaformu($db)
    {
        $mail = $_POST['mail'];

        if ($mail == ""):
            echo '<div class="col-lg-12 text-center mt-3 mb-3">
                <div class="alert alert-danger">Mail Adresi Girilmedi</div>
       </div>';
            header("refresh:1,url=control.php?sayfa=bulten");
        else:
            $sorgusonuc = parent::sorgum($db, "select * from bulten where mail LIKE '%$mail%'", 2);

            while ($sonuclar = $sorgusonuc->fetch(PDO::FETCH_ASSOC)):
                echo '<div class="col-lg-2">
            <div class="row border font-weight-bold p-2">
            <div class="col-lg-8">' . $sonuclar['mail'] . '</div>
            <div class="col-lg-4 p-0 text-right">
            <a href="control.php?sayfa=bulten&icislem=sil&id=' . $sonuclar["id"] . '" class="ti-trash text-danger" style="font-size: 15px"></a>
            <a href="control.php?sayfa=bulten&icislem=guncelle&id=' . $sonuclar["id"] . '" class="fa fa-edit text-success" style="font-size: 15px"></a>
            </div>
            </div>
            </div>';
            endwhile;
        endif;
    }


    public function MailSil($db)
    {
        parent::sorgum($db, "delete from bulten where id=" . $_GET["id"], 0);
        echo '<div class="col-lg-12 mt-3"><div class="alert alert-success mt-1">Başarıyla Silindi</div></div>';
        header("refresh:1,url=control.php?sayfa=bulten");
    }


    public function MailGuncelle($db)
    {
        echo '<div class="col-lg-12 mt-3">';

        $gelenbilgi = parent::sorgum($db, "select * from bulten where id=" . $_GET["id"], 2);
        $mevcutkayit = $gelenbilgi->fetch(PDO::FETCH_ASSOC);
        if (!$_POST):

            echo '
                <div class="col-lg-12">
                    <div class="row border border-light p-1 m-1 bg-light">
                    <div class="col-lg-6 pt-3">
                    <label id="hakkimizdayazilarn">Mail Adresi</label>
                    <form action="" method="post">
                    <input type="text" name="mail" class="form-control" value="' . $mevcutkayit['mail'] . '">
                    </div>
                    
                    <div class="col-lg-6 m-2">
                    <input type="hidden" name="kayitidsi" value="' . $_GET["id"] . '">
                    <input type="submit" class="btn btn-primary" name="" value="Güncelle">
                    </form>
                    </div>
                    
                    </div>
                    </div>';

        else:
            $mail = htmlspecialchars($_POST['mail']);
            $kayitidsi = htmlspecialchars($_POST['kayitidsi']);

            if ($mail == ""):
                echo '<div class="alert alert-warning mt-1">Veriler Boş Olamaz</div>';
                header("refresh:1,url=control.php?sayfa=bulten");
            else:
                self::sorgum($db, "update bulten set mail='$mail' where id=$kayitidsi", 0);
                echo '<div class="alert alert-success mt-1">Güncelleme Başarılı</div>';
                header("refresh:1,url=control.php?sayfa=bulten");
            endif;
        endif;
        echo '</div>';
    }


//    public function ciktiVer($db)
//    {
//
//        $tercih = $_POST['tercih'];
//        if ($tercih == "excel"):
//
//
//            echo '<div class="col-lg-12 mt-3"><div class="alert alert-success mt-1">Excel Dosyası İçeri Aktarıldı</div></div>';
//            header("refresh:1,url=control.php?sayfa=bulten");
//        else:
//            $mailler = parent::sorgum($db, "select * from bulten", 2);
//            while ($sonuc = $mailler->fetch(PDO::FETCH_ASSOC)):
//                $this->maillerimiz[] = $sonuc['mail'] . "\r\n";
//            endwhile;
//            $dosyaAd = date("d.m.Y");
//            $dt = fopen("bulten/" . $dosyaAd . ".txt", "w");
//            foreach ($this->maillerimiz as $deger):
//                fwrite($dt, $deger);
//            endforeach;
//            fclose($dt);
//            echo '<div class="col-lg-12 mt-3"><div class="alert alert-success mt-1">Txt Dosyası İçeri Aktarıldı</div></div>';
//            header("refresh:2,url=control.php?sayfa=bulten");
//        endif;
//    } //txt olarak çıktı alma işlem,


    public function bakim($db)
    {
        $deger = parent::sorgum($db, "select max(id) as id from bulten GROUP BY mail HAVING COUNT(*)>1", 2);

        if ($deger->rowCount() != 0):
            while ($d = $deger->fetch(PDO::FETCH_ASSOC)):
                $this->idler[] = $d["id"];
            endwhile;
            parent::sorgum($db, "Delete from bulten where ID IN (" . implode(",", $this->idler) . ")");
            echo '<div class="col-lg-6 mx-auto">Toplam mükerrer sayı: ' . $deger->rowCount() . "<br>";
            echo '<div class="alert alert-success mt-1">Mükerrer Kayıtlar Silindi</div></div>';
            header("refresh:1,url=control.php?sayfa=bulten");

        else:
            echo '<div class="alert alert-info mt-1">Mükerrer Kayıt Yok</div>';
            header("refresh:1,url=control.php?sayfa=bulten");
        endif;
    }


    public function bulten($vt)
    {
        echo '<div class="row text-center">
                <div class="col-lg-12 border-bottom"><h3 class="float-left mt-3 text-info">Bülten Ayarları </h3></div>
                <div class="col-lg-12">
                    <div class="row pt-2 bg-light border-dark">
                    
                    <div class="col-lg-3">
                    <form action="control.php?sayfa=bulten&icislem=ara" method="post">
                    <input type="text" name="mail" required class="form-control" placeholder="Aranacak mail adresi">
                    </div>
                    <div class="col-lg-1 border-right">
                    <input type="submit" name="btn" class="btn btn-success" value="ARA">
                    </form>
                    </div>
                                       
                    <div class="col-lg-3">
                    <form action="cikti.php" method="post">
                    <label class="font-weight-bold">Çıktı Formatı</label> <br>
                    <label class="text-success font-weight-bold">Excel</label> <input type="radio" name="tercih" class="m-1" value="excel">
                    <label class="text-info font-weight-bold">Txt</label> <input type="radio" name="tercih" class="m-1" value="txt" checked="checked">
                    </div>
                    <div class="col-lg-1 border-right">
                    <input type="submit" name="btn" class="btn btn-success" value="AKTAR">
                    </form>
                    </div>
                    
                    <div class="col-lg-2 border-right">
                    <h6 class="pt-2">Toplam Kayıt: <label class="text-danger">' . self::satirsayisi($vt) . '</label></h6>
                    </div>
                    
                    <div class="col-lg-2">
                    <form action="control.php?sayfa=bulten&icislem=bakim" method="post">
                    <input type="submit" name="btn" class="btn btn-success" value="BAKIM">
                    </form>
                    </div>
                    
                    </div>
                    </div>';


        echo '<div class="col-lg-12">
                    <div class="row pt-2 bg-light border-dark">';

        $icislem = @$_GET['icislem'];
        switch ($icislem):
            case "ara":
                self::Aramaformu($vt);
                break;
            case "sil":
                self::MailSil($vt);
                break;
            case "guncelle":
                self::MailGuncelle($vt);
                break;
            case "bakim":
                self::bakim($vt);
                break;
        endswitch;

        echo '</div></div></div>';
    }

}
