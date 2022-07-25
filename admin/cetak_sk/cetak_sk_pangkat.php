<?php

require ('../fpdf/fpdf.php');
include "../../db_con/koneksi.php";

if(!isset($_POST['nip'])) return;

$id = htmlentities(trim( $_POST['id'] ));
$jabatan = htmlentities(trim( $_POST['jabatan'] ));
$pendidikan = htmlentities(trim( $_POST['pendidikan'] ));
$masa_kerja_golongan = htmlentities(trim( $_POST['masa_kerja_golongan'] ));
$gaji_pokok = htmlentities(trim( $_POST['gaji_pokok'] ));

$query = "UPDATE `table_pangkat` SET `pendidikan`='$pendidikan',`jabatan`='$jabatan',`masa_kerja_golongan`='$masa_kerja_golongan',`gaji_pokok`='$gaji_pokok' WHERE id = '$id'";
$result = mysqli_query($con, $query);

$nip = $_POST['nip'];
$query = "SELECT table_pangkat.*, data_pegawai.*, DAY(data_pegawai.tanggal_lahir) hari_lahir, MONTH(data_pegawai.tanggal_lahir) bulan_lahir, YEAR(data_pegawai.tanggal_lahir) tahun_lahir FROM `table_pangkat` LEFT JOIN data_pegawai ON data_pegawai.nip = table_pangkat.nip WHERE table_pangkat.nip = '".$nip."'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);

$pangkat_tujuan = preg_replace("/[^a-zA-Z0-9]+/", "", $row['golongan_pangkat_tujuan']);

$query = "SELECT * FROM `table_gajih` WHERE table_gajih.pangkat = '".$pangkat_tujuan."'";
$result = mysqli_query($con, $query);
$pangkat = mysqli_fetch_array($result);

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
$pdf->Cell($width_wm,6,'PETIKAN',0,1, 'C');
$pdf->Ln(0);
$pdf->Cell($width_wm,6,'KEPUTUSAN BUPATI TAPIN',0,1, 'C');
$pdf->Cell($width_wm,6,'Nomor : 823.3/208-Dapeninfo/BKPSDM',0,1, 'C');
$pdf->Cell($width_wm,6,'TENTANG',0,1, 'C');
$pdf->Cell($width_wm,6,'KENAIKAN PANGKAT PEGAWAI NEGARA SIPIL',0,1, 'C');
$pdf->Cell($width_wm,6,'BUPATI TAPIN',0,1, 'C');
$pdf->Ln(5);

$pdf->SetFont('Times', '', '11');
$pdf->MyMultiCell(50,4, 'Menimbang',0,0,'L', false);
$pdf->MyMultiCell($width_wm-50,4, ": bahwa Pegawai Negara Sipil yang Namanya tersebut dalam Keputusan ini, memenuhi syarat dan dipandang cakap untuk dinaikan pangkat;",0,0,'L', false);
$pdf->Ln(10);
$pdf->MyMultiCell(50,4, 'Mengingat',0,0,'L', false);
$pdf->MyMultiCell($width_wm-50,4, ": 1. Undang-undang Nomor 8 Tahun 1974;
  2. Undang-undang Nomor 5 Tahun 2014;
  3. Peraturan Pemerintah Nomor 7 Tahun 1977 jo. Peraturan Pemerintah Nomor 15 Tahun 2019;
  4. Peraturan Pemerintah Nomor 11 Tahun 2017;",0,0,'L', false);
$pdf->Ln(21);
$pdf->MyMultiCell(50,4, 'Memperhatikan',0,0,'L', false);
$pdf->MyMultiCell($width_wm-50,4, ": Pertimbangan teknis Kepala Kantor Regional VIII BKN Nomor IG-26305000356  tanggal  02 Maret 2022");

$pdf->Ln(10);
$pdf->SetFont('Times', 'B', '12');
$pdf->Cell($width_wm,6,'MEMUTUSKAN',0,1, 'C');

$pdf->SetFont('Times', '', '11');

$pdf->Ln(4);
$pdf->MyMultiCell(50,4, 'Menetapkan',0,0,'L', false);
$pdf->MyMultiCell($width_wm-50,4, ":",0,0,'L', false);

$pdf->SetFont('Times', '', '12');
$pdf->Ln(6);
$pdf->MyMultiCell(50,4, 'PERTAMA',0,0,'L', false);
$pdf->MyMultiCell($width_wm-50,4, ": Pegawai Negeri Sipil tersebut dibawah ini :",0,0,'L', false);

$pdf->SetFont('Times', '', '11');
$pdf->Ln(8);
$pdf->MyMultiCell(10,4, '',0,0,'R', false);
$pdf->MyMultiCell(10,4, '1.',0,0,'R', false);
$pdf->MyMultiCell(50,4, 'Nama',0,0,'L', false);
$pdf->MyMultiCell($width_wm-70,4, ": " . trim($row['gelar_depan'] . " " . $row['nama'] . " " . $row['gelar_belakang']) ,0,0,'L', false);

$pdf->Ln(4);
$pdf->MyMultiCell(10,4, '',0,0,'R', false);
$pdf->MyMultiCell(10,4, '2.',0,0,'R', false);
$pdf->MyMultiCell(50,4, 'Tempat/ Tanggal Lahir',0,0,'L', false);
$pdf->MyMultiCell($width_wm-70,4, ": " . $row['tempat_lahir'] . ", " . $row['hari_lahir'] . " " . namaBulan($row['bulan_lahir']) . " " . $row['tahun_lahir'], 0,0,'L', false);

$pdf->Ln(4);
$pdf->MyMultiCell(10,4, '',0,0,'R', false);
$pdf->MyMultiCell(10,4, '3.',0,0,'R', false);
$pdf->MyMultiCell(50,4, 'NIP',0,0,'L', false);
$pdf->MyMultiCell($width_wm-70,4, ": " . $row['nip'],0,0,'L', false);

$pdf->Ln(4);
$pdf->MyMultiCell(10,4, '',0,0,'R', false);
$pdf->MyMultiCell(10,4, '4.',0,0,'R', false);
$pdf->MyMultiCell(50,4, 'Pendidikan',0,0,'L', false);
$pdf->MyMultiCell($width_wm-70,4, ": " . $row['pendidikan'],0,0,'L', false);

$pdf->Ln(4);
$pdf->MyMultiCell(10,4, '',0,0,'R', false);
$pdf->MyMultiCell(10,4, '5.',0,0,'R', false);
$pdf->MyMultiCell(50,4, 'Pangkat Lama/Gol. Ruang/TMT',0,0,'L', false);
$pdf->MyMultiCell($width_wm-70,4, ": " . $row['gol_awal_cpns'] . "/" . $row['tmt_cpns'],0,0,'L', false);

$pdf->Ln(8);
$pdf->MyMultiCell(10,4, '',0,0,'R', false);
$pdf->MyMultiCell(10,4, '6.',0,0,'R', false);
$pdf->MyMultiCell(50,4, 'Jabatan',0,0,'L', false);
$pdf->MyMultiCell($width_wm-70,4, ": " . $row['jabatan'],0,0,'L', false);

$pdf->Ln(4);
$pdf->MyMultiCell(10,4, '',0,0,'R', false);
$pdf->MyMultiCell(10,4, '7.',0,0,'R', false);
$pdf->MyMultiCell(50,4, 'Masa Kerja Golongan',0,0,'L', false);
$pdf->MyMultiCell($width_wm-70,4, ": " . $row['masa_kerja_golongan'],0,0,'L', false);

$pdf->Ln(4);
$pdf->MyMultiCell(10,4, '',0,0,'R', false);
$pdf->MyMultiCell(10,4, '8.',0,0,'R', false);
$pdf->MyMultiCell(50,4, 'Gaji Pokok',0,0,'L', false);
$pdf->MyMultiCell($width_wm-70,4, ": " . $row['gaji_pokok'],0,0,'L', false);

$pdf->Ln(4);
$pdf->MyMultiCell(10,4, '',0,0,'R', false);
$pdf->MyMultiCell(10,4, '9.',0,0,'R', false);
$pdf->MyMultiCell(50,4, 'Unit Kerja',0,0,'L', false);
$pdf->MyMultiCell($width_wm-70,4, ": " . $row['unit_kerja'],0,0,'L', false);

$pdf->Ln(10);
$pdf->MyMultiCell(10,4, '',0,0,'R', false);
$pdf->MyMultiCell(10,4, '10.',0,0,'R', false);
$pdf->MyMultiCell(50,4, 'Instansi Induk',0,0,'L', false);
$pdf->MyMultiCell($width_wm-70,4, ": " . $row['unit_kerja_induk'],0,0,'L', false);

$pdf->Ln(10);
$pdf->MyMultiCell($width_wm,4, "Terhitung mulai tanggal ".date("d-m-Y")." dinaikkan pangkatnya menjadi ".$pangkat['golongan']." golongan ruang ".$row['golongan_pangkat_tujuan'].", dalam masa kerja golongan , dan diberikan gaji pokok sebesar Rp.".$pangkat['gaji_pokok']." ditambah dengan penghasilan lain berdasarkan ketentuan Peraturan Perundang-undangan yang berlaku.",0,0,'L', false);
$pdf->Ln(20);
$pdf->MyMultiCell(50,4, 'KEDUA',0,0,'L', false);
$pdf->MyMultiCell($width_wm-50,4, ": Apabila dikemudian hari ternyata terdapat kekeliruan dalam Keputusan Gubernur ini,   akan diadakan perbaikan dan penghitungan kembali sebagiamana mestinya.",0,0,'L', false);

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

$pdf->Output('sk_pensiun.pdf', 'I');