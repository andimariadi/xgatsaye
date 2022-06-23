<?php

require ('../admin/fpdf/fpdf.php');
include "../db_con/koneksi.php";


class Pdf extends FPDF

{

    function letak($gambar)
    {
        //memasukkan gambar untuk header
        $this->Image($gambar, 10, 8, 21, 24);
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
        $this->SetFont('Times', '', '12');  
    }

    function garis()
    {
        $this->SetLineWidth(0.7);
        $this->Line(10.1, 36, 344.8, 36);
        $this->SetLineWidth(0.4);
        $this->Line(10, 35, 345, 35);
    }

    function teks3($teks1)
    {       
        $this->SetFont('Arial', 'B', '11');            
    }

    
    function teks4($teks1)
    {    
        $this->SetFont('Arial', '', '11');        
    }

}


//instantisasi objek

$pdf = new Pdf();
$pdf->SetMargins(5,8,5);

//Mulai dokumen

$pdf->AddPage('L', 'legal');

//meletakkan gambar

$pdf->letak('../admin/fpdf/logoo.png');

//membuat garis ganda tebal dan tipis
$pdf->garis();

//Cop Surat
$pdf->judul1('');
$pdf->Cell(125,3,'',0,0);
$pdf->Cell(0,6,'PEMERINTAH KABUPATEN TAPIN',0,1);

$pdf->judul2('');
$pdf->Cell(95.7,0,'',0,0);
$pdf->Cell(0,9,'BADAN KEPEGAWAIAN DAN PENGEMBANGAN',0,1);

$pdf->judul3('');
$pdf->Cell(127,0,'',0,0);
$pdf->Cell(0,5,'SUMBER DAYA MANUSIA',0,1);

$pdf->judul4('');
$pdf->Cell(110,0,'',0,0);
$pdf->Cell(0,7,'Jalan Brigjen H. Hasan Basry No. 22, Kode Pos 71111, RANTAU',0,1);

// Setting font
$pdf->SetFont('Arial','',11);

// Batas Atas

$pdf->SetFont('TIMES','B',12);
$pdf->Cell(130,3,'',0,0);
$pdf->Cell(10, 20, 'DATA DAFTAR PENSIUN');
$pdf->Ln(15);

$pdf->SetFont('Arial','',11);
$pdf->Cell(8,6, 'NO',1,0,'C');
$pdf->Cell(55,6, 'NAMA',1,0,'C');
$pdf->Cell(41,6, 'NIP',1,0,'C');
$pdf->Cell(45,6, 'Tempat Tanggal Lahir',1,0,'C');
$pdf->Cell(35,6, 'Pangkat/Gol',1,0,'C');
$pdf->Cell(40,6, 'Jabatan',1,0,'C');
$pdf->Cell(40,6, 'TMT Terakhir Jabatan',1);
$pdf->Cell(35,6, 'Tanggal Pensiun',1,0,'C');
$pdf->Cell(40,6, 'Kategori Pensiun',1,0,'C');

$where = "";
if($_GET['tahun'] != 'semua') {
    $where = "WHERE YEAR(created_at) = '".$_GET['tahun']."'";
}

$query = "SELECT 
    table_pensiun.tmt_terakhir_jabatan, 
    table_pensiun.tanggal_pensiun, 
    table_pensiun.kategori_pensiun,  
    data_pegawai.nama,
    data_pegawai.nip,
    data_pegawai.tempat_lahir,
    data_pegawai.tanggal_lahir,
    data_pegawai.gol_akhir,
    data_pegawai.nama_jabatan_fungsional_umum
    FROM table_pensiun LEFT JOIN data_pegawai ON table_pensiun.nip = data_pegawai.nip {$where} ORDER BY tanggal_pensiun DESC";


$result = mysqli_query($con, $query);        
$no = 1;
while($row = mysqli_fetch_array($result)){
    $pdf->Ln(6);
    $pdf->SetFont('Arial','',11);
    $pdf->Cell(8,6, $no++. ".",1,0,'C');
    $pdf->Cell(55,6,$row['nama'],1,0,'L');
    $pdf->Cell(41,6,$row['nip'],1,0,'C');
    $pdf->Cell(45,6,$row['tempat_lahir']. ', ' . date('d F Y', strtotime($row['tanggal_lahir'])),1,0,'C');
    $pdf->Cell(35,6,$row['gol_akhir'],1,0,'C');
    $pdf->Cell(40,6,$row['nama_jabatan_fungsional_umum'],1,0,'C');
    $pdf->Cell(40,6,$row['tmt_terakhir_jabatan'],1,0,'C');
    $pdf->Cell(35,6,$row['tanggal_pensiun'],1,0,'C');
    $pdf->MultiCell(40, 6, $row['kategori_pensiun'], 1);
        
        // 10,6,$row['kategori_pensiun'],1,0,'C');
}
    
$pdf->Output();