<?php

require ('../fpdf/fpdf.php');


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
        $this->SetFont('Times', 'B', '13');
    }

    function judul2()
    {
        $this->SetFont('Times', 'B', '24');
    }

    function judul3()
    {
        $this->SetFont('Times', '', '12');  
    }

    function garis()
    {
        $this->SetLineWidth(0.7);
        $this->Line(10.1, 36, 199.8, 36);
        $this->SetLineWidth(0.4);
        $this->Line(10, 35, 200, 35);
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
$pdf->SetMargins(10,3.5,10);

//Mulai dokumen

$pdf->AddPage('P', 'legal');

//meletakkan gambar

$pdf->letak('logoo.png');

$pdf->judul3('Jalan Brigjen H. Hasan Basry No. 22, Kode Pos 71111, RANTAU');

//membuat garis ganda tebal dan tipis
$pdf->garis();

//Cop Surat
$pdf->judul1('');
$pdf->Cell(61.3,5,'',0,0);
$pdf->Cell(0,14,'PEMERINTAH KABUPATEN TAPIN',0,1);

$pdf->judul2('');
$pdf->Cell(50,0,'',0,0);
$pdf->Cell(0,10,'SEKRETARIAT DAERAH',0,1);


$pdf->judul3('');
$pdf->Cell(43.6,0,'',0,0);
$pdf->Cell(0,6,'Jalan Brigjen H. Hasan Basry No. 22, Kode Pos 71111, RANTAU',0,1);

// Setting font
$pdf->SetFont('Arial','',11);


// Batas Atas

$pdf->Text(10, 45, 'Nomor');
$pdf->Text(30, 45, ': '. $nomor_sk);

$pdf->Text(10, 49.7, 'Lampiran');
$pdf->Text(30, 49.7,': -');

$pdf->Text(10, 54.7, 'Perihal');
$pdf->Text(30, 54.7, ': Kenaikan Gaji Berkala');

$pdf->Text(142.5, 55, 'K e p a d a');
$pdf->Text(113, 60, 'Yth. Kepala Badan Keuangan dan Aset Daerah');
$pdf->Text(138, 65, 'Kabupaten Tapin');
$pdf->Text(131, 69.3, 'Di -');
$pdf->Text(144, 73.5, 'RANTAU');

$pdf->Text(22, 85, 'Dengan ini diberitahukan bahwa berhubung dengan telah dipenuhinya masa kerja dan syarat-syarat');
$pdf->Text(22, 89.5, 'lainnya, kepada :');

$pdf->Cell(0,7.5,'',0,1);
$pdf->Cell(114,5,'',0,0);
$pdf->Cell(58,8,'Rantau, ' . $tanggal_sk,0,1,'C');
$pdf->Cell(0,43,'',0,1);

$pdf->Cell(10.7,4.5,'',0,0);
$pdf->Cell(6,4.5,'1.',0,0);
$pdf->Cell(47,4.5,'Nama / NIP',0,0);
$pdf->Cell(6,4.5,':',0,0);
$pdf->MultiCell(0,4.5,$nama_nip,0,1);

$pdf->Cell(10.7,4.5,'',0,0);
$pdf->Cell(6,4.5,'2.',0,0);
$pdf->Cell(47,4.5,'Tempat, Tanggal Lahir',0,0);
$pdf->Cell(6,4.5,':',0,0);
$pdf->MultiCell(0,4.5,$tempat_tgl_lahir,0,1);

$pdf->Cell(10.7,4.5,'',0,0);
$pdf->Cell(6,4.5,'3.',0,0);
$pdf->Cell(47,4.5,'Pangkat / Jabatan',0,0);
$pdf->Cell(6,4.5,':',0,0);
$pdf->MultiCell(113,4.5,$pangkat_jabatan,0,1);

$pdf->Cell(10.7,4,'',0,0);
$pdf->Cell(6,4,'4.',0,0);
$pdf->Cell(47,4,'Kantor / Tempat Tugas',0,0);
$pdf->Cell(6,4,':',0,0);
$pdf->MultiCell(108,4,$unit_skpd . ' KABUPATEN TAPIN',0,1);

$pdf->Cell(10.7,4.5,'',0,0);
$pdf->Cell(6,4.5,'5.',0,0);
$pdf->Cell(47,4.5,'Gaji Pokok Lama',0,0);
$pdf->Cell(6,4.5,':',0,0);
$pdf->MultiCell(0,4.5,$gaji_pokok_lama,0,1);

$pdf->Cell(10.7,4.5,'',0,0);
$pdf->Cell(6,4.5,'',0,0);
$pdf->Cell(47,4.5,'(Atas dasar Surat Pemberitahuan Kenaikan Gaji Berkala terakhir yang ditetapkan)',0,0);
$pdf->Cell(6,4.5,'',0,0);
$pdf->MultiCell(0,4.5,'',0,1);

$pdf->Cell(16.7,4.5,'',0,0);
$pdf->Cell(6,4.5,'a.',0,0);
$pdf->Cell(41,4.5,'Oleh pejabat',0,0);
$pdf->Cell(6,4.5,':',0,0);
$pdf->MultiCell(0,4.5,'BUPATI TAPIN',0,1);

$pdf->Cell(16.7,4.5,'',0,0);
$pdf->Cell(6,4.5,'b.',0,0);
$pdf->Cell(41,4.5,'Tanggal dan Nomor',0,0);
$pdf->Cell(6,4.5,':',0,0);
$pdf->MultiCell(0,4.5,$tanggal_nomor_sk_lama,0,1);

$pdf->Cell(16.7,4.5,'',0,0);
$pdf->Cell(6,4.5,'c.',0,0);
$pdf->Cell(41,4.5,'Tanggal mulai berlaku-',0,0);
$pdf->Cell(6,4.5,'',0,0);
$pdf->MultiCell(0,4.5,'',0,1);

$pdf->Cell(16.7,4.5,'',0,0);
$pdf->Cell(6,4.5,'',0,0);
$pdf->Cell(41,4.5,'nya gaji tersebut',0,0);
$pdf->Cell(6,4.5,':',0,0);
$pdf->MultiCell(0,4.5,$tanggal_tmt_lama,0,1);

$pdf->Cell(16.7,4.5,'',0,0);
$pdf->Cell(6,4.5,'b.',0,0);
$pdf->Cell(41,4.5,'Masa Kerja Golongan',0,0);
$pdf->Cell(6,4.5,'',0,0);
$pdf->MultiCell(0,4.5,'',0,1);

$pdf->Cell(16.7,4.5,'',0,0);
$pdf->Cell(6,4.5,'',0,0);
$pdf->Cell(41,4.5,'pada tanggal tersebut',0,0);
$pdf->Cell(6,4.5,':',0,0);
$pdf->MultiCell(0,4.5,$masa_kerja_lama,0,1);

$pdf->Cell(10.7,4.5,'',0,0);
$pdf->Cell(6,4.5,'',0,0);
$pdf->Cell(47,4.5,'diberikan kenaikan gaji berkala hingga memperoleh',0,0);
$pdf->Cell(6,4.5,'',0,0);
$pdf->MultiCell(0,4.5,'',0,1);

$pdf->Cell(10.7,4.5,'',0,0);
$pdf->Cell(6,4.5,'6.',0,0);
$pdf->Cell(47,4.5,'Gaji Pokok Baru',0,0);
$pdf->Cell(6,4.7,':',0,0);
$pdf->MultiCell(0,4.5,$gaji_pokok,0,1);

$pdf->Cell(10.7,4.5,'',0,0);
$pdf->Cell(6,4.5,'7.',0,0);
$pdf->Cell(47,4.5,'Berdasarkan masa kerja',0,0);
$pdf->Cell(6,4.5,':',0,0);
$pdf->MultiCell(0,4.5,$thn_bln_masa_kerja,0,1);

$pdf->Cell(10.7,4.5,'',0,0);
$pdf->Cell(6,4.5,'8.',0,0);
$pdf->Cell(47,4.5,'Dalam golongan',0,0);
$pdf->Cell(6,4.5,':',0,0);
$pdf->MultiCell(0,4.5,$kategori_ubah,0,1);

$pdf->Cell(10.7,4.5,'',0,0);
$pdf->Cell(6,4.5,'9.',0,0);
$pdf->Cell(47,4.5,'Mulai Tanggal',0,0);
$pdf->Cell(6,4.5,':',0,0);
$pdf->MultiCell(0,4.5,$tanggal_tmt,0,1);

$pdf->Cell(0,2.5,'',0,1);
$pdf->Cell(8.7,0,'',0,0);
$pdf->Cell(0,4.5,'Diharap agar sesuai dengan Peraturan Pemerintah Nomor 15 Tahun 2019, Keputusan-Keputusan',0,1);
$pdf->Cell(8.7,4.5,'',0,0);
$pdf->Cell(0,5,'Presiden berikutnya  sesuai  anggaran  keuangan  daerah  yang  bersangkutan,  kepada  pegawai',0,1);
$pdf->Cell(8.7,4.5,'',0,0);
$pdf->Cell(0,4.5,'tersebut dapat dibayarkan penghasilannya berdasarkan gaji pokoknya yang baru.',0,1);

$pdf->teks3(0,0,'',0,1);
$pdf->Cell(0,16,'',0,1);
$pdf->Cell(100,5,'',0,0);
$pdf->Cell(0,5,'An. BUPATI TAPIN',0,1);
$pdf->Cell(106,5,'',0,0);
$pdf->Cell(0,5,'SEKRETARIS DAERAH,',0,1);

$pdf->Cell(0,19,'',0,1);
$pdf->Cell(106,5,'',0,0);
$pdf->Cell(0,5,'H. MASYRANIANSYAH, SP.M.MA.MP',0,1);
$pdf->Cell(106,5,'',0,0);
$pdf->Cell(0,5,'Pembina Utama Madya',0,1);
$pdf->Cell(106,5,'',0,0);
$pdf->Cell(0,5,'NIP. 196504221988031008',0,1);

$pdf->teks3(0,10,'',0,1);
$pdf->Cell(0,10,'',0,1);
$pdf->Cell(6,5,'',0,0);
$pdf->Cell(24,5,'TEMBUSAN',0,0);

$pdf->teks4(0,10,'',0,1);
$pdf->Cell(3,4.5,':',0,0);
$pdf->Cell(0,4.5,'Kepada Yth,',0,1);
$pdf->Cell(5,4.5,'',0,0);
$pdf->Cell(0,4.5,'1. Kepala Kantor Regional  VIII Badan Kepegawaian Negara Banjarmasin',0,1);
$pdf->Cell(9.3,4.5,'',0,0);
$pdf->Cell(0,4.5,'Di Banjarbaru',0,1);
$pdf->Cell(5,4.5,'',0,0);
$pdf->Cell(0,4.5,'2. Gubernur Kalimantan Selatan',0,1);
$pdf->Cell(9.3,4.5,'',0,0);
$pdf->Cell(0,4.5,'up. Kepala Badan Kepegawaian Daerah',0,1);
$pdf->Cell(9.3,4.5,'',0,0);
$pdf->Cell(0,4.5,'Di Banjarbaru',0,1);
$pdf->Cell(5,4.5,'',0,0);
$pdf->Cell(0,4.5,'3. Kepala SKPD yang bersangkutan.',0,1);
$pdf->Cell(5,4.5,'',0,0);
$pdf->Cell(0,4.5,'4. Sdra (i) '. $nama_dibawah,0,1);
// Batas Bawah





$pdf->Output('kopsurat.pdf', 'I');