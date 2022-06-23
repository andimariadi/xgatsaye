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
$pdf->SetMargins(10,8,10);

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
$pdf->Cell(10, 20, 'DATA DAFTAR AJUAN BERKALA');
$pdf->Ln(15);

$pdf->SetFont('Arial','',11);
$pdf->Cell(8,6, 'NO',1,0,'C');
$pdf->Cell(35,6, 'TANGGAL',1,0,'C');
$pdf->Cell(41,6, 'NIP',1,0,'C');
$pdf->Cell(70,6, 'NAMA',1,0,'C');
$pdf->Cell(136,6, 'UNIT KERJA INDUK',1,0,'C');
$pdf->Cell(45,6, 'KETERANGAN',1,0,'C');



$query = mysqli_query($con,"SELECT * FROM ajuan_usul_berkala INNER JOIN data_pegawai ON ajuan_usul_berkala.nip = data_pegawai.nip ORDER BY ajuan_usul_berkala.nip DESC");
    
    

$no = 1;
    while($row = mysqli_fetch_array($query)){

     
    
    $pdf->Ln(6);
    $pdf->SetFont('Arial','',11);
    $pdf->Cell(8,6, $no++. ".",1,0,'C');
    $pdf->Cell(35,6,$row['tanggal'],1,0,'C');
    $pdf->Cell(41,6,$row['nip'],1,0,'C');
    $pdf->Cell(70,6,$row['nama'],1,0,'L');
    $pdf->Cell(136,6,$row['unit_kerja_induk'],1,0,'L');
    $pdf->Cell(45,6,$row['keterangan'],1,0,'C');
   
    } 

            
$pdf->Output();