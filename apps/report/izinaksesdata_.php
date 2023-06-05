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
          $selmodagent = $con->select("(select a.name as namepeople, c.name as namedept, b.title,b.mobile,b.statusid,b.id as iddtl,b.typereq,a.email,b.alasanbutuh,b.tgl_butuh1,b.tgl_butuh2,b.akunakses,b.websiteakses,b.hasilpengecekanaset,b.assetid,e.name as namelocation,DATE(b.created_date) created_date from people a join people_dtl_request b on a.id=b.peopleid join clients c on b.clientid=c.id left join assets d on b.assetid=d.id left join locations e on d.locationid=e.id
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
            <h3 style="padding: 0px;">Form<h3 style="padding: 0px;margin-top:5px; margin-bottom:2px;">Izin Akses Data</h3><h4 style="font-style: normal; margin-bottom:1px;">PT. ERATEX DJAJA TBK</h4></h3>

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
  <p style="padding-left: 3px;"><h1 style="padding-top: 6pt;padding-left: 8pt;text-indent: 0pt;text-align: left;">A. Informasi Pengguna</h1></p>
  <table cellpadding="0" cellspacing="0" style="width:98%;" border="1">
    <tr>
        <td style="width:20%; vertical-align: top;padding: 2pt;text-indent: 0pt;text-align: left;font-size: 12px;" class="s1">Nama</td>
        <td style="width:2%; vertical-align: top;padding: 2pt;text-indent: 0pt;text-align: left;font-size: 12px;" class="s1">:</td>
        <td style="width:28%; vertical-align: top;padding: 2pt;text-indent: 0pt;text-align: left;font-size: 12px;" class="s1"><?=$mg['namepeople']?></td>
        <td style="width:8%; vertical-align: top;padding: 2pt;text-indent: 0pt;text-align: left;font-size: 12px;" class="s1">Node</td>
        <td style="width:2%; vertical-align: top;padding: 2pt;text-indent: 0pt;text-align: left;font-size: 12px;" class="s1">:</td>
        <td style="width:40%; vertical-align: top;padding: 2pt;text-indent: 0pt;text-align: left;font-size: 12px;" class="s1"> 
            <?php foreach ($con->select("people_izinakses a left join assets b on a.assetid=b.id","b.name as nameaset,a.assetid","peopledtlid = $_GET[id] group by b.name,a.assetid") as $nd) {

                echo "- ".$nd['nameaset']."<br>";
            } ?>
        </td>
    </tr>
    <tr>
        <td style="vertical-align: top;padding: 2pt;text-indent: 0pt;text-align: left;font-size: 12px;">Department</td>
        <td style="vertical-align: top;padding: 2pt;text-indent: 0pt;text-align: left;font-size: 12px;">:</td>
        <td colspan="4" style="vertical-align: top;padding: 2pt;text-indent: 0pt;text-align: left;font-size: 12px;"><?=$mg['namedept']?></td>
    </tr>
    <tr>
        <td style="vertical-align: top;padding: 2pt;text-indent: 0pt;text-align: left;font-size: 12px;">Site</td>
        <td style="vertical-align: top;padding: 2pt;text-indent: 0pt;text-align: left;font-size: 12px;">:</td>
        <td colspan="4" style="vertical-align: top;padding: 2pt;text-indent: 0pt;text-align: left;font-size: 12px;"><?=$mg['namelocation']?></td>
    </tr>
  </table>
  <br>
  <p style="padding-top: 4pt;padding-left: 8pt;padding-bottom: 8pt;text-indent: 0pt;text-align: left;font-size: 14px;">Pada hari ini tanggal <b><?=date('d-m-Y',strtotime($mg['created_date']))?></b> dengan ini mengajukan izin Akses Data terhadap File/Folder/Server *) yang terdapat pada kolom B.1, untuk keperluan : </p>
  <p style="padding-left: 3px;"><h1 style="padding-top: 6pt;padding-left: 8pt;text-indent: 0pt;text-align: left;">B. Informasi File/Folder/Akses</h1></p>

  <p style="margin-left: 40px;font-size: 14px;">1. Informasi File/Folder
    <table cellpadding="0" cellspacing="0" style="width:98%;padding-top: 6pt;padding-bottom: 6pt;margin-left: 20px;font-size: 12px;" border="1">
      <tr>
        <th style="width:5%; vertical-align: top;">No</th>
        <th style="width:25%; vertical-align: top;">File/Folder/Server</th>
        <th style="width:25%; vertical-align: top;">Lokasi</th>
        <th style="width:15%; vertical-align: top;">Hak Akses</th>
        <th style="width:25%; vertical-align: top;">Keterangan</th>
      </tr>
      <?php
        $na = 1; 
        foreach($con->select("people_izinakses","*,case when hak_akses = 1 then 'Full Akses' when hak_akses=2 then 'Read Only' end hakakses","peopledtlid = '$_GET[id]'") as $inf){ ?>
      <tr>
          <td><?=$na;?></td>
          <td><?=$inf['filefolder'];?></td>
          <td><?=$inf['lokasi'];?></td>
          <td><?=$inf['hakakses'];?></td>
          <td><?=$inf['remark'];?></td>
      </tr>
    <?php } ?>
    </table>
  </p>
  <p style="margin-left: 40px;font-size: 14px;">2. Daftar Anggota Yang Akses
    <table cellpadding="0" cellspacing="0" style="width:98%;padding-top: 6pt;padding-bottom: 6pt;margin-left: 20px;font-size: 12px;" border="1">
      <tr>
        <th style="width:5%; vertical-align: top;">No</th>
        <th style="width:30%; vertical-align: top;">User / Node</th>
        <th style="width:30%; vertical-align: top;">Dept / Team</th>
        <th style="width:30%; vertical-align: top;">Permission</th>
      </tr>
    <?php
        $na = 1; 
        foreach($con->select("people_dtl_request a join people b on a.peopleid=b.id left join clients c on a.clientid=c.id","b.name as namepeople,c.name as namedept","a.id = '$_GET[id]'") as $inu){ ?>
      <tr>
          <td><?=$na;?></td>
          <td><?=$inu['namepeople']?></td>
          <td><?=$inu['namedept']?></td>
          <td><?=$inf['hakakses'];?></td>
      </tr>
    <?php } ?>
    </table>
  </p>
  <!-- <p style="padding-left: 3px;"><u>Keterangan</u></p> -->
  <br><br>
  <table cellpadding="0" cellspacing="0" style="width:98%;" border="1">
      <tr>
        <td>
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
  <br>
  <table cellpadding="0" cellspacing="0" style="width:98%;padding-top: 6pt;padding-bottom: 6pt; font-size: 12px;" border="1">
      <tr>
        <td align="center" style="width:25%; vertical-align: top;padding: 4pt;">Diterima,</td>
        <td align="center" style="width:25%; vertical-align: top;padding: 4pt;">Disetujui,</td>
        <td align="center" style="width:25%; vertical-align: top;padding: 4pt;">Disetujui,</td>
        <td align="center" style="width:25%; vertical-align: top;padding: 4pt;">Dibuat,</td>
      </tr>
      <tr >
          <td style="height:50px;" align="center">&nbsp;</td>
          <td align="center">&nbsp;</td>
          <td align="center">&nbsp;</td>
          <td align="center">ttd <br><?=$mg['namepeople'];?></td>
      </tr>
      <tr>
        <td align="center" style="width:25%; vertical-align: top;padding: 4pt;">PIC IT</td>
        <td align="center" style="width:25%; vertical-align: top;padding: 4pt;">Dept. Head</td>
        <td align="center" style="width:25%; vertical-align: top;padding: 4pt;">Dept. Head PIC</td>
        <td align="center" style="width:25%; vertical-align: top;padding: 4pt;">PIC</td>
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
