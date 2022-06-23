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
$pdf->Cell(10, 20, 'DATA DAFTAR PROSES BERKALA');
$pdf->Ln(15);

$pdf->SetFont('Arial','',11);
$pdf->Cell(20,12, 'Tanggal',1,0,'C');
$pdf->Cell(55,12, 'Nama',1,0,'C');
$pdf->Cell(41,12, 'NIP',1,0,'C');
$pdf->Cell(21,12, 'Pangkat',1,0,'C');
// $pdf->MyMultiCell(25,6, 'Unit Kerja Induk',1,0,'C');
$pdf->MyMultiCell(25,6, 'Form Usul Berkala',1,0,'C');
$pdf->MyMultiCell(25,6, 'SK Berkala Terakhir',1,0,'C');
$pdf->MyMultiCell(35,6, 'SK Pangkat Terakhir',1,0,'C');
$pdf->MyMultiCell(35,6, 'SK Pemangku Jabatan',1,0,'C');
$pdf->Cell(35,12, 'Admin',1,0,'C');

$where = "";
if($_GET['tahun'] != 'semua') {
    $where = "WHERE YEAR(tanggal) = '".$_GET['tahun']."'";
}



$query = "SELECT proses_usul_berkala.tanggal, proses_usul_berkala.nip, data_pegawai.nama, data_pegawai.gol_akhir, data_pegawai.unit_kerja_induk, proses_usul_berkala.keterangan, proses_usul_berkala.keterangan, proses_usul_berkala.kategori, berkas_ajuan_usul_berkala.form, berkas_ajuan_usul_berkala.sk_berkala_terakhir, berkas_ajuan_usul_berkala.sk_pangkat_terakhir, berkas_ajuan_usul_berkala.sk_pemangku_jabatan, berkas_ajuan_usul_berkala.file_path, berkas_ajuan_usul_berkala.admin
FROM proses_usul_berkala 
INNER JOIN data_pegawai ON proses_usul_berkala.nip = data_pegawai.nip 
LEFT JOIN berkas_ajuan_usul_berkala ON berkas_ajuan_usul_berkala.nip = proses_usul_berkala.nip 
".$where."
ORDER BY tanggal DESC";
$result = mysqli_query($con, $query);
$pdf->Ln(6);
while($row = mysqli_fetch_array($result)){  
    $form = $row['form'] == 'true' ? "ADA" : "TIDAK ADA";
    $sk_berkala_terakhir = $row['sk_berkala_terakhir'] == 'true' ? "ADA" : "TIDAK ADA";
    $sk_pangkat_terakhir = $row['sk_pangkat_terakhir'] == 'true' ? "ADA" : "TIDAK ADA";
    $sk_pemangku_jabatan = $row['sk_pemangku_jabatan'] == 'true' ? "ADA" : "TIDAK ADA";
    $pdf->Ln(6);
    $pdf->SetFont('Arial','',11);    
    $pdf->Cell(20,6,$row['tanggal'],1,0,'L');
    $pdf->Cell(55,6,$row['nama'],1,0,'L');
    $pdf->Cell(41,6,$row['nip'],1,0,'C');
    $pdf->Cell(21,6,$row['kategori'],1,0,'C');
    // $pdf->Cell(25,6,$row['unit_kerja_induk'],1,0,'L');
    $pdf->Cell(25,6,$form,1,0,'C');
    $pdf->Cell(25,6,$sk_berkala_terakhir,1,0,'C');
    $pdf->Cell(35,6,$sk_pangkat_terakhir,1,0,'C');
    $pdf->Cell(35,6,$sk_pemangku_jabatan,1,0,'C');
    $pdf->Cell(35,6,$row['admin'],1,0,'C');
}
    
$pdf->Output();