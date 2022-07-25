<?php

require ('../fpdf/fpdf.php');
include "../../db_con/koneksi.php";

if(!isset($_POST['nip'])) return;
$id = htmlentities(trim( $_POST['id'] ));
$nip = htmlentities(trim( $_POST['nip'] ));
$nama = htmlentities(trim( $_POST['nama'] ));
$tanggal_lahir = htmlentities(trim( $_POST['tanggal_lahir'] ));
$unit_kerja = htmlentities(trim( $_POST['unit_kerja'] ));
$pangkat_lama = htmlentities(trim( $_POST['pangkat_lama'] ));
$pangkat_baru = htmlentities(trim( $_POST['pangkat_baru'] ));
$masa_kerja_golongan = htmlentities(trim( $_POST['masa_kerja_golongan'] ));
$masa_kerja_pensiun = htmlentities(trim( $_POST['masa_kerja_pensiun'] ));
$berhenti_awal_bulan = htmlentities(trim( $_POST['berhenti_awal_bulan'] ));
$pensiun_tmt = htmlentities(trim( $_POST['pensiun_tmt'] ));
$pensiun_pokok = htmlentities(trim( $_POST['pensiun_pokok'] ));

$query = "UPDATE table_pensiun SET nama='$nama',tanggal_lahir='$tanggal_lahir',unit_kerja='$unit_kerja',pangkat_lama='$pangkat_lama',pangkat_baru='$pangkat_baru',masa_kerja_golongan='$masa_kerja_golongan',masa_kerja_pensiun='$masa_kerja_pensiun',berhenti_awal_bulan='$berhenti_awal_bulan',pensiun_tmt='$pensiun_tmt',pensiun_pokok='$pensiun_pokok' WHERE id = '$id'";
$result = mysqli_query($con, $query);


$nip = $_POST['nip'];
$query = "SELECT table_pensiun.*, data_pegawai.*, DAY(data_pegawai.tanggal_lahir) hari_lahir, MONTH(data_pegawai.tanggal_lahir) bulan_lahir, YEAR(data_pegawai.tanggal_lahir) tahun_lahir FROM table_pensiun LEFT JOIN data_pegawai ON data_pegawai.nip = table_pensiun.nip WHERE table_pensiun.nip = '".$nip."'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);

// $pangkat_tujuan = preg_replace("/[^a-zA-Z0-9]+/", "", $row['golongan_pangkat_tujuan']);

// $query = "SELECT * FROM table_gajih WHERE table_gajih.pangkat = '".$pangkat_tujuan."'";
// $result = mysqli_query($con, $query);
// $pangkat = mysqli_fetch_array($result);

function namaBulan($bulan) {
    if ($bulan == '01') {
    $bulan = 'Januari';
    } elseif ($bulan == '02') {
    $bulan = 'Februari';
    } elseif ($bulan == '03') {
    $bulan = 'Maret';
    } elseif ($bulan == '04') {
    $bulan = 'April';
    } elseif ($bulan == '05') {
    $bulan = 'Mei';
    } elseif ($bulan == '06') {
    $bulan = 'Juni';
    } elseif ($bulan == '07') {
    $bulan = 'Juli';
    } elseif ($bulan == '08') {
    $bulan = 'Agustus';
    } elseif ($bulan == '09') {
    $bulan = 'September';
    } elseif ($bulan == '10') {
    $bulan = 'Oktober';
    } elseif ($bulan == '11') {
    $bulan = 'November';
    } elseif ($bulan == '12') {
    $bulan = 'Desember';
    };
    return $bulan;
}

class Pdf extends FPDF

{

    function letak($gambar,$x = 10, $y = 8, $h = 21)
    {
        //memasukkan gambar untuk header
        $this->Image($gambar, $x, $y, $h, 24);
        //menggeser posisi sekarang
    }

    function judul1()
    {      
        $this->SetFont('Times', 'B', '14');       
    }

    function judul2()
    {       
        $this->SetFont('Times', 'B', '18');       
    }
    
    function judul3()
    {       
        $this->SetFont('Times', 'B', '18');         
    }

    function judul4()
    {
        $this->SetFont('Times', 'B', '12');  
    }

    function garis()
    {
        $width = $this->GetPageWidth();
        $this->SetLineWidth(0.7);
        $this->Line(10, 36, $width-10, 36);
        $this->SetLineWidth(0.4);
        $this->Line(10, 35, $width-10, 35);
    }

    function teks3($teks1)
    {       
        $this->SetFont('Arial', 'B', '11');            
    }

    
    function teks4($teks1)
    {    
        $this->SetFont('Arial', '', '11');        
    }

    // function MyMultiCell($w, $h, $txt, $border=0, $align='J', $fill=false)
    function MyMultiCell($w,$h,$text,$border=0,$ln=0,$align='L',$fill=false)
    {
        // Store reset values for (x,y) positions
        $x = $this->GetX() + $w;
        $y = $this->GetY();

        // Make a call to FPDF's MultiCell
        $this->MultiCell($w,$h,$text,$border,$align,$fill);

        // Reset the line position to the right, like in Cell
        if( $ln==0 )
        {
            $this->SetXY($x,$y);
        }
    }

}


//instantisasi objek

$pdf = new Pdf();
$pdf->SetMargins(10,8,10);
$width = $pdf->GetPageWidth();
$width_wm = $pdf->GetPageWidth()-20;
//Mulai dokumen

$pdf->AddPage('P', 'legal');

//meletakkan gambar

$pdf->letak('garuda.jpg', ($width/2)-10.5);

//membuat garis ganda tebal dan tipis
// $pdf->garis();

$pdf->Ln(25);
//Cop Surat
$pdf->judul4();
// $pdf->Cell($width_wm,6,'PETIKAN',0,1, 'C');
// $pdf->Ln(0);
$pdf->Cell($width_wm,6,'KEPUTUSAN BUPATI TAPIN',0,1, 'C');
$pdf->Cell($width_wm,6,'NOMOR : : 882/0299-Dapeninfo/BKPSDM',0,1, 'C');
$pdf->Cell($width_wm,6,'TENTANG',0,1, 'C');
$pdf->Cell($width_wm,6,'PEMBERIAN KENAIKAN PANGKAT PENGABDIAN, PEMBERHENTIAN',0,1, 'C');
$pdf->Cell($width_wm,6,'DAN PEMBERIAN PENSIUN PEGAWAI NEGERI SIPIL YANG MENCAPAI BATAS USIA PENSIUN',0,1, 'C');
$pdf->Cell($width_wm,6,'BUPATI TAPIN',0,1, 'C');
$pdf->Ln(5);

$pdf->SetFont('Times', '', '11');
$pdf->MyMultiCell(50,4, 'Menimbang',0,0,'L', false);
$pdf->MyMultiCell($width_wm-50,4, ": bahwa pegawai negeri sipil yang namanya tercantum dalam keputusan ini telah mencapaai batas usia  pensiun dan telah memenuhi syarat untuk diberikan kenaikan pangkat pengabdian dan diberhentikan dengan hormat sebagai pegawai negeri sipil dengan hak pensiun;",0,0,'L', false);
$pdf->Ln(20);
$pdf->MyMultiCell(50,4, 'Mengingat',0,0,'L', false);
$pdf->MyMultiCell($width_wm-50,4, ": 1. Undang-undang Nomor 05 Tahun 2014;
2. Undang-undang Nomor 23 Tahun 2014;
3. Peraturan Pemerintah Nomor 7 Tahun 1977 jo. Peraturan Pemerintah Nomor 15 Tahun 2019;
4. Peraturan Pemerintah Nomor 11 Tahun 2017;
5. Keputusan Kepala BKN Nomor 7 Tahun 2019;",0,0,'L', false);
$pdf->Ln(25);
$pdf->MyMultiCell(50,4, 'Memperhatikan',0,0,'L', false);
$pdf->MyMultiCell($width_wm-50,4, ": Pertimbangan Teknis Kepala Badan Kepegawaian Negara/ Kepala Kantor Regional Badan Kepegawaian Negara Nomor PH-26305000170 Tanggal 13-12-2021");

$pdf->Ln(10);
$pdf->SetFont('Times', 'B', '12');
$pdf->Cell($width_wm,6,'MEMUTUSKAN',0,1, 'C');

$pdf->SetFont('Times', '', '11');

$pdf->Ln(4);
$pdf->MyMultiCell(50,4, 'Menetapkan',0,0,'L', false);
$pdf->MyMultiCell($width_wm-50,4, ":",0,0,'L', false);

$pdf->SetFont('Times', '', '12');
$pdf->Ln(6);
$pdf->MyMultiCell(50,4, 'KESATU',0,0,'L', false);
$pdf->MyMultiCell(5,4, '1. ',0,0,'L', false);
$pdf->MyMultiCell($width_wm-55,4, "Memberikan kenaikan pangkat pengabdian kepada pegawai negeri sipil yang namanya tercantum dalam lajur 1 sehingga menjadi sebagaimana tercantum dalam lajur 5 dengan gaji pokok menjadi sebagaimana tercantum dalam lajur 7 Keputusan ini.",0,0,'L', false);
$pdf->Ln(18);
$pdf->MyMultiCell(50,4, '',0,0,'L', false);
$pdf->MyMultiCell(5,4, '2. ',0,0,'L', false);
$pdf->MyMultiCell($width_wm-55,4, "Memberhentikan dengan hormat sebagai pegawai negeri sipil yang namanya tercantum dalam lajur 1 pada akhir bulan sebagaimana tercantum pada lajur 9 Keputusan ini, disertai ucapan terima kasih atas jasa-jasa selama bekerja pada Pemerintah Republik Indonesia.",0,0,'L', false);
$pdf->Ln(18);
$pdf->MyMultiCell(50,4, '',0,0,'L', false);
$pdf->MyMultiCell(5,4, '3. ',0,0,'L', false);
$pdf->MyMultiCell($width_wm-55,4, "Terhitung mulai tanggal sebagaimana tercantum dalam lajur 10, kepada yang bersangkutan diberikan pensiun pokok sebulan sebesar sebagaimana tercantum dalam lajur 11 Keputusan ini.",0,0,'L', false);
$pdf->Ln(18);
$pdf->MyMultiCell(30,4, '',0,0,'L', false);
$pdf->MyMultiCell(10,4, 'A.',0,0,'L', false);
$pdf->MyMultiCell($width_wm-40,4, 'PENERIMA PENSIUN',0,0,'L', false);


$pdf->Ln(10);
$pdf->SetFont('Times', '', '11');
$pdf->MyMultiCell(10,6, '',0,0,'R', false);
$pdf->MyMultiCell(10,6, '1.',1,0,'C', false);
$pdf->MyMultiCell(50,6, 'NAMA',1,0,'L', false);
$pdf->MyMultiCell($width_wm-70,6, ": " . $row['gelar_depan'] . " " . $row['nama'] . " " . $row['gelar_belakang'] ,1,0,'L', false);

$pdf->Ln(6);
$pdf->MyMultiCell(10,6, '',0,0,'R', false);
$pdf->MyMultiCell(10,6, '2.',1,0,'C', false);
$pdf->MyMultiCell(50,6, 'NIP',1,0,'L', false);
$pdf->MyMultiCell($width_wm-70,6, ": " . $row['nip'],1,0,'L', false);

$pdf->Ln(6);
$pdf->MyMultiCell(10,6, '',0,0,'R', false);
$pdf->MyMultiCell(10,6, '3.',1,0,'C', false);
$pdf->MyMultiCell(50,6, 'TANGGAL LAHIR',1,0,'L', false);
$pdf->MyMultiCell($width_wm-70,6, ": " . $row['tanggal_lahir'],1,0,'L', false);

$pdf->Ln(6);
$pdf->MyMultiCell(10,6, '',0,0,'R', false);
$pdf->MyMultiCell(10,6, '4.',1,0,'C', false);
$pdf->MyMultiCell(50,6, 'UNIT KERJA',1,0,'L', false);
$pdf->MyMultiCell($width_wm-70,6, ": " . $row['unit_kerja_induk'],1,0,'L', false);

$pdf->Ln(6);
$pdf->MyMultiCell(10,12, '',0,0,'R', false);
$pdf->MyMultiCell(10,12, '5.',1,0,'C', false);
$pdf->MyMultiCell(50,6, 'PANGKAT/GOL.RUANG LAMA',1,0,'L', false);
$pdf->MyMultiCell($width_wm-70,12, ": " . $row['pangkat_lama'] ,1,0,'L', false);

$pdf->Ln(12);
$pdf->MyMultiCell(10,12, '',0,0,'R', false);
$pdf->MyMultiCell(10,12, '6.',1,0,'C', false);
$pdf->MyMultiCell(50,6, 'PANGKAT/GOL.RUANG BARU',1,0,'L', false);
$pdf->MyMultiCell($width_wm-70,12, ": " . $row['pangkat_baru'] ,1,0,'L', false);

$pdf->Ln(12);
$pdf->MyMultiCell(10,6, '',0,0,'R', false);
$pdf->MyMultiCell(10,6, '7.',1,0,'C', false);
$pdf->MyMultiCell(50,6, 'MASA KERJA GOLONGAN',1,0,'L', false);
$pdf->MyMultiCell($width_wm-70,6, ": " . $row['masa_kerja_golongan'],1,0,'L', false);

$pdf->Ln(6);
$pdf->MyMultiCell(10,6, '',0,0,'R', false);
$pdf->MyMultiCell(10,6, '8.',1,0,'C', false);
$pdf->MyMultiCell(50,6, 'MASA KERJA PENSIUN',1,0,'L', false);
$pdf->MyMultiCell($width_wm-70,6, ": " . $row['masa_kerja_pensiun'],1,0,'L', false);

$pdf->Ln(6);
$pdf->MyMultiCell(10,6, '',0,0,'R', false);
$pdf->MyMultiCell(10,6, '9.',1,0,'C', false);
$pdf->MyMultiCell(50,6, 'BERHENTI AKHIR BULAN',1,0,'L', false);
$pdf->MyMultiCell($width_wm-70,6, ": " . $row['berhenti_awal_bulan'],1,0,'L', false);

$pdf->Ln(6);
$pdf->MyMultiCell(10,6, '',0,0,'R', false);
$pdf->MyMultiCell(10,6, '10.',1,0,'C', false);
$pdf->MyMultiCell(50,6, 'PENSIUN TMT',1,0,'L', false);
$pdf->MyMultiCell($width_wm-70,6, ": " . $row['pensiun_tmt'],1,0,'L', false);

$pdf->Ln(6);
$pdf->MyMultiCell(10,6, '',0,0,'R', false);
$pdf->MyMultiCell(10,6, '11.',1,0,'C', false);
$pdf->MyMultiCell(50,6, 'PENSIUN POKOK',1,0,'L', false);
$pdf->MyMultiCell($width_wm-70,6, ": " . $row['pensiun_pokok'],1,0,'L', false);

$pdf->Ln(10);
$pdf->MyMultiCell(30,4, '',0,0,'L', false);
$pdf->MyMultiCell(10,4, 'B.',0,0,'L', false);
$pdf->MyMultiCell($width_wm-40,4, 'Keluarga penerima pensiun yang bersangkutan pada saat diberhentikan dengan hormat sebagai pegawai negeri sipil dengan hak pensiun sebagaimana tercantum dalam daftar keluarga.',0,0,'L', false);

$pdf->Ln(10);
$pdf->MyMultiCell(30,4, 'KEDUA',0,0,'L', false);
$pdf->MyMultiCell(5,4, ':',0,0,'L', false);
$pdf->MyMultiCell($width_wm-35,4, "Apabila penerima pensiun meninggal dunia kepada isteri (isteri-isteri)/suami, anak (anak-anak) yang tercantum dalam Keputusan ini diberikan pensiun pokok sebesar 36% (tiga puluh enam persen) dari Rp 5.105.300 : 1 = Rp 1.837.908 (dibulatkan)  Rp 1.850.100 sebulan, terhitung mulai bulan berikutnya penerima pensiun pegawai negeri sipil meninggal dunia dengan ketentuan:",0,0,'L', false);
$pdf->Ln(18);
$pdf->MyMultiCell(35,4, '',0,0,'L', false);
$pdf->MyMultiCell(5,4, '1.',0,0,'L', false);
$pdf->MyMultiCell($width_wm-40,4, "Pemberian dan pembayaran pensiun janda/duda dihentikan pada akhir bulan janda/duda yang bersangkutan menikah lagi atau berakhir apabila meninggal dunia dan tidak terdapat lagi anak yang memenuhi syarat untuk menerima pensiun",0,0,'L', false);
$pdf->AddPage();
$pdf->MyMultiCell(35,4, '',0,0,'L', false);
$pdf->MyMultiCell(5,4, '2.',0,0,'L', false);
$pdf->MyMultiCell($width_wm-40,4, "Apabila janda/duda menikah lagi atau meninggal dunia, selama masih terdapat anak/anak-anak yang berusia di bawah 25 tahun tidak berpenghasilan sendiri belum pernah menikah, pensiun janda/duda itu dibayarkan kepada dan atas nama anak pertama tersebut di atas untuk kepentingan anak-anak lainnya terhitung mulai bulan berikutnya terjadinya pernikahan/kematian",0,0,'L', false);
$pdf->Multicell(0,22,"");
$pdf->MyMultiCell(35,4, '',0,0,'L', false);
$pdf->MyMultiCell(5,4, '3.',0,0,'L', false);
$pdf->MyMultiCell($width_wm-40,4, "Apabila janda yang bersangkutan kemudian bercerai lagi, maka pensiun janda yang pembayarannya telah dihentikan, dibayarkan kembali mulai bulan berikutnya perceraian itu berlaku sah.",0,0,'L', false);
$pdf->Ln(15);
$pdf->MyMultiCell(30,4, 'KETIGA',0,0,'L', false);
$pdf->MyMultiCell(5,4, ':',0,0,'L', false);
$pdf->MyMultiCell($width_wm-35,4, "Selain pensiun pokok tersebut diberikan tunjangan keluarga, tunjangan pangan, dan tunjangan lain sesuai ketentuan perundang-
undangan",0,0,'L', false);
$pdf->Ln(15);
$pdf->MyMultiCell(30,4, 'KEEMPAT',0,0,'L', false);
$pdf->MyMultiCell(5,4, ':',0,0,'L', false);
$pdf->MyMultiCell($width_wm-35,4, "Apabila dikemudian hari terdapat kekeliruan dalam Keputusan ini akan diadakan perbaikan dan perhitungan kembali sebagaimana mestinya.",0,0,'L', false);
$pdf->Ln(15);
$pdf->MyMultiCell(30,4, 'KELIMA',0,0,'L', false);
$pdf->MyMultiCell(5,4, ':',0,0,'L', false);
$pdf->MyMultiCell($width_wm-35,4, "Keputusan ini mulai berlaku pada tanggal ditetapkan.",0,0,'L', false);

$pdf->Ln(15);
$pdf->MyMultiCell($width_wm,4, 'ASLI Keputusan ini diberikan kepada yang bersangkutan dengan alamat :
-',0,0,'L', false);


$pdf->Ln(20);
$pdf->MyMultiCell($width_wm/3,4, '',0,0,'L', false);
$pdf->MyMultiCell($width_wm/3,4, '',0,0,'L', false);
$pdf->MyMultiCell($width_wm/3,4, 'Ditetapkan di Tapin',0,0,'L', false);
$pdf->Ln(4);
$pdf->MyMultiCell($width_wm/3,4, '',0,0,'L', false);
$pdf->MyMultiCell($width_wm/3,4, '',0,0,'L', false);
$pdf->MyMultiCell($width_wm/3,4, 'Pada tanggal '.date('d').' ' . namaBulan(date('m')) . ' ' . date('Y'),0,0,'L', false);

$pdf->SetFont('Times', 'B', '11');
$pdf->Ln(6);
$pdf->MyMultiCell($width_wm/3,4, '',0,0,'L', false);
$pdf->MyMultiCell($width_wm/3,4, '',0,0,'L', false);
$pdf->MyMultiCell($width_wm/3,4, 'BUPATI TAPIN',0,0,'C', false);
$pdf->Ln(30);
$pdf->MyMultiCell($width_wm/3,4, '',0,0,'L', false);
$pdf->MyMultiCell($width_wm/3,4, '',0,0,'L', false);
$pdf->MyMultiCell($width_wm/3,4, 'H.M. ARIFIN ARPAN',0,0,'C', false);
$pdf->Ln(6);
$pdf->SetFont('Times', '', '11');
$pdf->MyMultiCell($width_wm,4, 'TEMBUSAN Keputusan ini disampaikan kepada
1. Kepala Kantor Regional VIII Badan Kepegawaian Negara Banjarmasin;
2. Kepala Kantor PT. TASPEN (Persero) di Banjarmasin;
3. Kepala Badan Keuangan dan Aset Daerah Kab. Tapin;
4. Pertinggal;',0,0,'L', false);




$pdf->Output('sk_pensiun.pdf', 'I');