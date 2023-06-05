<?php 
require( 'funlibs.php' );
$con=new Database;
session_start();
?>
<style>
table {
      border-collapse: collapse;
    }
.table, .td, .th {
          border: 1px solid #DDD ;
          padding:1px;

        }
.th2{ 
    border-top: 1px solid #ddd; 
  }
.td2 {
         
               font-size:12px; 
               vertical-align:middle; padding:0px;line-height:15px;
               font-family: Times, serif;

           }
ol {
  display: block;
  list-style-type: decimal;
  margin-top: 0;
  margin-bottom: 1em;
  margin-left: 0;
  margin-right: 0;
  padding-left: 1px;
}
ol.d {list-style-type: lower-alpha;
}

.titik {
padding-left : 15px;
}

.ol {
  counter-reset: item;
  margin-left: 0;
  padding-left: 0;
}
.kurung {
  display: block;
  margin-bottom: .5em;
  margin-left: 2em;
}
.kurung::before {
  display: inline-block;
  content: counter(item) ") ";
  counter-increment: item;
  width: 2em;
  margin-left: -2em;
}
.pasal{
  text-align: center;
}
 
.borderheader {
  border: 0.5px solid #DCDCDC;
}
.borderbody {
  border: 1px solid #DCDCDC;
}

{
        margin: 0;
        padding: 0;
        text-indent: 0;
    }
    
    h1 {
        color: black;
        font-family: Times, serif;
        font-style: normal;
        font-weight: bold;
        text-decoration: none;
        font-size: 10.5pt;
    }
    
    .s1 {
        color: black;
        font-family: Times, serif;
        font-style: normal;
        font-weight: normal;
        text-decoration: none;
        font-size: 10.5pt;
    }
    
    .s2 {
        color: black;
        font-family: Times, serif;
        font-style: normal;
        font-weight: normal;
        text-decoration: underline;
        font-size: 10.5pt;
    }
    
    h2 {
        color: black;
        font-family: Times, serif;
        font-style: normal;
        font-weight: bold;
        text-decoration: none;
        font-size: 9pt;
    }
    
    p {
        color: black;
        font-family: Times, serif;
        font-style: normal;
        font-weight: normal;
        text-decoration: none;
        font-size: 9pt;
        margin: 0pt;
    }
    
    li {
        display: block;
    }
    
    #l1 {
        padding-left: 0pt;
        counter-reset: c1 1;
    }
    
    #l1> li>*:first-child:before {
        counter-increment: c1;
        content: counter(c1, decimal)". ";
        color: black;
        font-style: normal;
        font-weight: normal;
        text-decoration: none;
    }
    
    #l1> li:first-child>*:first-child:before {
        counter-increment: c1 0;
    }
</style>
<?php
          // $selmodagent = $con->select("people a join clients b on a.clientid=b.id","a.*,b.name as namaclient","a.id = '$_GET[id]'");
          $selmodagent = $con->select("(select a.name as namepeople, c.name as namedept, b.title,b.mobile,b.statusid,b.id as iddtl,b.typereq,a.email,b.alasanbutuh,b.tgl_butuh1,b.tgl_butuh2,b.akunakses,b.websiteakses,b.hasilpengecekanaset,b.assetid from people a join people_dtl_request b on a.id=b.peopleid join clients c on b.clientid=c.id
where b.id = '$_GET[id]' ORDER BY b.id DESC) a","*","");
          foreach ($selmodagent as $mg) {}
           
          // $selapp = $con->select("trapprove a join mtpegawai b on a.id_pegawai=b.id_pegawai","b.nama_pegawai","a.id_req = $mg[id_req]");
          // foreach ($selapp as $app) {}
          foreach($con->select("people","count(id) as jmluser","YEAR(created_date) = YEAR(now())") as $juser){}

?>
<body>
  <table cellpadding="0" cellspacing="0" style="width:98%;" border="1">
      <tr>
          <td style="width: 25%;" rowspan="3" class="borderheader"><img src="assets/images/logo-eratex-djaja.png" style="height:height:50px; width:100px" >
          </td>
          <td style="width:45%;font-size:20px;" align="center" class="td2 borderheader" rowspan="3">
            <h3 style="padding: 0px;">Form<h3 style="padding: 0px;margin-top:5px; margin-bottom:2px;">Penutupan Akun</h3><h4 style="font-style: normal; margin-bottom:1px;">PT. ERATEX DJAJA TBK</h4></h3>

          </td>
          <td style="width:12%;margin: 0px;" class="td2 borderheader">&nbsp;Ref. No</td>
          <td style="width:18%;" class="td2 borderheader">&nbsp;: _ _ _ _ _ _</td>
         <!--  <td style="width:18%;" class="td2 borderheader">&nbsp;: F-E-ITD-<?=sprintf('%03s', $juser['jmluser']+1)?>-<?=sprintf('%02s', $juser['jmluser']+1)?></td> -->
      </tr>
      <tr>
          <td style="width:12%;margin: 0px;" class="td2 borderheader">&nbsp;Tanggal Terbit</td>
          <td style="width:18%;margin: 0px;" class="td2 borderheader">&nbsp;: <?=date('d-m-Y');?></td>
      </tr>
      <tr>
          <td style="width:12%" class="td2 borderheader">&nbsp;Halaman</td>
          <td style="width:18%" class="td2 borderheader">&nbsp;: 1</td>
      </tr>
      
  </table>
  <br>
  <table cellpadding="0" cellspacing="0" style="width:98%;" border="1">
      <tr>
        <td style="width:50%; vertical-align: top;">
            <p style="padding-left: 3px;"><h1 style="padding-top: 6pt;padding-left: 8pt;text-indent: 0pt;text-align: left;">Tahap 1, Pengisian oleh pemohon</h1></p>
            <p class="s1" style="padding-top: 6pt;padding-left: 8pt;text-indent: 0pt;text-align: left;">Nama : <b><?=$mg['namepeople'].$mg['typereq']?></b> </p>
            <p class="s1" style="padding-top: 5pt;padding-left: 8pt;text-indent: 0pt;text-align: left;">Department : <b><?=$mg['namedept']?></b></p>
            <p class="s1" style="padding-top: 5pt;padding-left: 8pt;text-indent: 0pt;text-align: left;">Jabatan : <b><?=$mg['title']?></b></p>
            <p class="s1" style="padding-top: 5pt;padding-left: 8pt;text-indent: 0pt;text-align: left;">Alamat Email : <b><?=$mg['email']?></b></p>
            <p class="s1" style="padding-top: 5pt;padding-left: 8pt;text-indent: 0pt;text-align: left;">Alasan Kebutuhan : <b><?=$mg['alasanbutuh']?></b></p>
            <!-- <p class="s1" style="padding-top: 5pt;padding-left: 8pt;text-indent: 0pt;text-align: left;">_ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ <span class="s2">&nbsp; </span></p> -->
          <?php if($mg['tgl_butuh2'] == '0000-00-00' || $mg['tgl_butuh2'] == '') { ?>
            <p style="padding-left: 3px;"><h1 style="padding-top: 6pt;padding-left: 8pt;text-indent: 0pt;text-align: left;">Sifat Kebutuhan</h1></p>
            <p class="s1" style="padding-top: 5pt;padding-left: 8pt;text-indent: 0pt;text-align: left;">( ) Tanggal _ _ _ _ _ _ _ _ s/d _ _ _ _ _ _ _ _ _</p>
            <p class="s1" style="padding-top: 5pt;padding-left: 8pt;text-indent: 0pt;text-align: left;">(<b>V</b>) Selama menjabat</p>
          <?php } else {?>
            <p style="padding-left: 3px;"><h1 style="padding-top: 6pt;padding-left: 8pt;text-indent: 0pt;text-align: left;">Sifat Kebutuhan</h1></p>
            <p class="s1" style="padding-top: 5pt;padding-left: 8pt;text-indent: 0pt;text-align: left;">(<b>V</b>) Tanggal &nbsp; <b><?=$mg['tgl_butuh1']?></b> &nbsp; s/d &nbsp; <b><?=$mg['tgl_butuh2']?></b> </p>
            <p class="s1" style="padding-top: 5pt;padding-left: 8pt;text-indent: 0pt;text-align: left;">( ) Selama menjabat</p>
          <?php } ?>
            <p style="padding-left: 3px;"><h1 style="padding-top: 5pt;padding-left: 8pt;text-indent: 0pt;text-align: left;">Website yang akan diakses</h1></p>
          <?php if($mg['websiteakses'] == ''){ ?>
            <p class="s1" style="padding-top: 5pt;padding-left: 8pt;text-indent: 0pt;text-align: left;">_ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ <span class="s2">&nbsp; </span>_ _</p>
            <p class="s1" style="padding-top: 5pt;padding-left: 8pt;text-indent: 0pt;line-height: 150%;text-align: left;">_ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ </p>
          <?php } else { ?>
            <p class="s1" style="padding-top: 5pt;padding-left: 8pt;text-indent: 0pt;text-align: left;">
            <?=$mg['websiteakses'];?> 
            </p>
          <?php }
          ?>
            <br>
            <p style="padding-left: 3px;"><b>Dengan menandatangani Formulir ini,<br> pemohon menyatakan setuju dan bersedia <br>mematuhi ketentuan IT-Policy No.2016-2</b></p>
            <p style="padding-top: 10pt;padding-left: 3px;line-height: 150%;text-align: left;">_ _ _ _ _ _ _ _ , _ _ _ _ _ _ _ _ 20_ _ </p>
            <br>
            <p class="s1" style="padding-left: 12pt;text-indent: 10pt;"><b>Pemohon</b></p>
            <p style="text-indent: 0pt;text-align: left;line-height: 40px;">
                <br/>
            </p>
            <p class="s1" style="padding-left: 11pt;text-indent: 11pt;text-align: left;">( <b><?=$mg['name']?></b> )</p>
        </td>
        <td style="width:50%">
            <p style="padding-left: 3px;"><h1 style="padding-top: 4pt;padding-left: 4pt;text-indent: 0pt;text-align: justify;">Akun Yang Diminta</h1></p>
          <?php $expakun = explode(';',$mg['akunakses']);
                $jmlexp = count($expakun);
              for($i=1;$i<=$jmlexp;$i++){
                  foreach($con->select("akunminta","*","idakunminta=$expakun[$i]") as $aks){
                  if($i % 2 == 0){$br = "<br>";}else{$br="";}
                  
             ?>
              <span style="color: black;font-family: Times, serif;font-style: normal;font-weight: normal;text-decoration: none;font-size: 9pt;margin: 0pt;">(<b>V</b>) <?=$aks['namaakunminta']."&nbsp;&nbsp;".$br?></span>
          <?php }} ?>
            <p class="s1" style="padding-left: 2pt;text-indent: 0pt;line-height: 12pt;text-align: left;">( ) Lainnya……………….</p>
            <p style="padding-left: 4pt;text-indent: 0pt;text-align: left;" />
            <br>
            <p class="s1" style="padding-left: 4pt;text-indent: 0pt;text-align: justify;">* Dept head perlu mengevaluasi relevansi/efektivitas <br>pemakaian akun Internet/Skype/Email oleh masing-<br>masing individu pada departemen</p>
            <p style="padding-left: 3px;"><h1 style="padding-top: 8pt;padding-left: 4pt;text-indent: 0pt;text-align: left;">Tahap 2, Evaluasi dan persetujuan oleh Dept.Head 
              <br><br>Dengan ini diharapkan bantuan Dept.Head pemohon <br>untuk mengevaluasi permintaan dan kebutuhan <br>yang dideskripsikan oleh pemohon, <br>dan mengevaluasi kembali hak akses personal2 <br>pada departemen yang anda pimpin.</h1></p>
            <table>
              <tr>
                <td align="center" style="width: 50%;">
                    <p style="padding-left: 3px;"><h1 style="padding-top: 2pt;padding-left: 8pt;text-indent: 0pt;text-align: center;">Telah dievaluasi &amp; <br>permohonan disetujui</h1></p>
                    <p style="text-indent: 0pt;text-align: left;">
                        <br/>
                    </p>
                    <h1 style="padding-top: 8pt;padding-left: 11pt;text-indent: 0pt;text-align: center;">(  Supervisor )</h1>
                    
                </td>
                <td align="center">
                    <h1 style="padding-top: 2pt;padding-left: 5pt;text-indent: 0pt;text-align: center;">Diketahui<br>&nbsp;</h1>
                    <p style="text-indent: 0pt;text-align: left;">
                        <br/>
                    </p>
                    <h1 style="padding-top: 8pt;padding-left: 5pt;text-indent: 5pt;text-align: center;">( Dept. Head/Manager)</h1>
                </td>
              </tr>
            </table>
            <p style="padding-left: 3px;"><h1 style="text-indent: 0pt;line-height: 12pt;text-align: left;">Bagian ini diisi oleh IT-Dept</h1></p>
            <p class="s1" style="padding-left: 3px;line-height: 12pt;text-align: left;">( ) dokumen telah diisi dengan lengkap</p>
            <p class="s1" style="padding-left: 3px;text-align: left;">( ) sudah dievaluasi oleh Dept-Head pemohon</p>
            <p class="s1" style="padding-left: 3px;line-height: 12pt;text-align: left;">( ) permohanan ditolak dengan alasan _ _ _ _ _ _ _ _</p>
            <p class="s1" style="padding-left: 3px;text-align: justify;">_ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ <br>Diterima &amp; diperiksa: _ _ _ _ _ _ _ _ _ tanggal _ _ _ _ _ _ _ </p>
            <p style="padding-left: 3px;"><b>Konfirmasi hasil proses</b></p>
            <p class="s1" style="padding-left: 3px;line-height: 12pt;text-align: justify;">Oleh : _ _ _ _ _ _ _ _ _ _ _ Kepada : _ _ _ _ _ _ _ _</p>
            <p class="s1" style="padding-left: 3px;line-height: 12pt;text-align: justify;">Tgl. : _ _ _ _ _ _ _ _ Via : _ _ _ _ _ <span class="s2">&nbsp; </span>_ _ _ _</p>
            <p style="padding-left: 3px;text-indent: 0pt;text-align: left;">
                <br/>
            </p>
        </td>
      </tr>
      <tr>
        <td colspan="2">
            <p style="padding-left: 3px;padding-bottom: 5px;"><h2 style="margin: 0px;padding: 0px;">IT-Policy tentang Pemakaian Fasilitas Komunikasi Komputer (2016-02)</h2></p>
            <ol style="margin: 0px;padding: 0px;">
                <li data-list-text="1.">
                    <p style="padding-left: 3pt;text-indent: -3pt;text-align: left;">PIC wajib menggunakan segala media komunikasi data yang telah disediakan secara optimal sesuai dengan kepentingan perusahaan.</p>
                </li>
                <li data-list-text="2.">
                    <p style="padding-left: 3pt;text-indent: -18pt;text-align: left;">PIC wajib menjaga kerahasiaan password masing-masing, dan tidak boleh diberitahukan ke pihak lain dengan alasan apapun.</p>
                </li>
                <li data-list-text="3.">
                    <p style="padding-left: 3pt;text-indent: -18pt;text-align: left;">PIC wajib menggunakan alamat email perusahaan untuk segala komunikasi bisnis yang berhubungan dengan kepentingan bisnis perusahaan</p>
                </li>
                <li data-list-text="4.">
                    <p style="padding-left: 3pt;text-indent: -18pt;text-align: left;">PIC wajib melakukan pemeriksaan Email minimum 2 kali sehari, yaitu pada masuk pagi, dan setiap masuk istirahat siang.</p>
                </li>
                <li data-list-text="5.">
                    <p style="padding-left: 3pt;text-indent: -18pt;text-align: left;">PIC tidak diperbolehkan untuk menggunakan email perusahaan untuk kegiatan mailing list maupun forum diskusi, tanpa persetujuan atasan dan IT-Dept.</p>
                </li>
                <li data-list-text="6.">
                    <p style="padding-left: 3pt;text-indent: -18pt;text-align: left;">PIC tidak diperbolehkan menggunakan fasilitas komunikasi perusahaan untuk kegiatan-kegiatan yang bertentangan dengan hukum dan etika seperti mengirim/mengakses media pornografi, program-program jahat,spam, pesan-pesan yang mengancam, maupun berbau sara serta pelecehan seksual, dan segala hal yang melanggar UU ITE (Undang Undang Republik Indonesia. No 11 Tahun 2008. Tentang Informasi dan Transaksi Elektronik), etika public dan hak cipta.</p>
                </li>
                <li data-list-text="7.">
                    <p style="padding-left: 3pt;text-indent: -18pt;text-align: left;">PIC tidak diperbolehkan untuk menggunakan jaringan komunikasi komputer untuk mengirimkan data perusahaan ke tujuan yang tidak berkaitan dengan kebijakan perusahaan.</p>
                </li>
                <li data-list-text="8.">
                    <p style="padding-left: 3pt;text-indent: -18pt;text-align: left;">PIC tidak berhak meminjamkan, membagi, mengalihkan fasilitas hak akses komunikasi komputer yang dimiliki kepada pihak lain tanpa alasan persetujuan dari IT-Dept</p>
                </li>
                <li data-list-text="9.">
                    <p style="padding-left: 3pt;text-indent: -18pt;text-align: left;">PIC-IT support wajib menghapus account yang berkaitan dengan PIC yang telah melakukan pemutusan kerja dengan perusahaan untuk menghindari penyalahgunaan.</p>
                </li>
                <li data-list-text="10.">
                    <p style="padding-left: 3pt;text-indent: -18pt;line-height: 10pt;text-align: left;"><b>PIC-IT berhak mencabut hak pemakaian fasilitas komunikasi komputer jika ditemukan pelanggaran-pelanggaran terkait dengan Policy ini</b></p></li>
            </ol>
            
        </td>
      </tr>
  </table>

    
</body>
<br>
<br />
<br><br>

<?php 
$datenow = date('d-m-Y H:i:s');
echo "<i><b>Dicetak tanggal</b> : $datenow </i>"; 
    $seluser = $con->select("r_user_login a JOIN m_pegawai b ON a.ID_PEGAWAI = b.id_pegawai","b.nama_pegawai","a.ID = '$valsupp1[id_user]'"); 
    foreach ($seluser as $sus){}
echo "<i><b>Dibuat oleh</b> : $sus[nama_pegawai]</i>";
    $seluser1 = $con->select("r_user_login a JOIN m_pegawai b ON a.ID_PEGAWAI = b.id_pegawai","b.nama_pegawai","a.ID = '$_SESSION[ID_LOGIN]'"); 
    foreach ($seluser1 as $sus1){}
echo "<i>  <b>Dicetak oleh</b> : $sus1[nama_pegawai]</i>";
?>
</font>
</p> -->
