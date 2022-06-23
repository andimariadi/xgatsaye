<?php

require '../../db_con/koneksi.php';

if(isset($_POST["id"])){
    $id = $_POST["id"];
    $query = mysqli_query($con,"SELECT riwayat_usul_berkala.nip, riwayat_usul_berkala.tanggal, riwayat_usul_berkala.tanggal_selesai, riwayat_usul_berkala.kategori, data_pegawai.nip, data_pegawai.gelar_depan, data_pegawai.gelar_belakang, data_pegawai.nama, data_pegawai.tempat_lahir, data_pegawai.tanggal_lahir, riwayat_usul_berkala.gol_akhir, riwayat_usul_berkala.tmt_gol_akhir, data_pegawai.nama_jabatan_fungsional_umum, data_pegawai.unit_kerja, data_pegawai.unit_kerja_induk, riwayat_usul_berkala.keterangan, FROM riwayat_usul_berkala INNER JOIN data_pegawai ON riwayat_usul_berkala.nip = data_pegawai.nip WHERE riwayat_usul_berkala.id = '$id'");

?>  
    <div class="row">
        <div class="col-12 justify-content-center">
        	<table class="table table-bordered">
          		<?php
	               $row = mysqli_fetch_array($query);
          		?>
          		<tr>  
                    <td colspan="2" class="text-center"><b>Detail Riwayat Usul Berkala</b></td>    
                </tr>
                <tr>  
                    <td width="25%"><label><b>Tanggal</b></label></td>  
                    <td width="75%"><?= $row['tanggal']; ?></td>  
                </tr>
                <tr>  
                    <td width="25%"><label><b>Tanggal Selesai</b></label></td>  
                    <td width="75%"><?= $row['tanggal_selesai']; ?></td>  
                </tr>
                <tr>  
                    <td width="25%"><label><b>Kategori</b></label></td>  
                    <td width="75%"><?= $row['kategori']; ?></td>  
                </tr>  
                <tr>  
                    <td width="25%"><label><b>NIP</b></label></td>  
                    <td width="75%"><?= $row['nip']; ?></td>  
                </tr>
                <tr>  
                    <td width="25%"><label><b>Nama & Gelar</b></label></td>  
                    <td width="75%">
                    	<?php
	                        $gelar_depan = $row['gelar_depan'];
	                        $nama = $row['nama'];
	                        $gelar_belakang = $row['gelar_belakang'];

	                        if ($gelar_depan == '') {
	                            $spasi = '';
	                        } else {
	                            $spasi = ' ';
	                        };

	                        if ($gelar_belakang == '') {
	                            $koma = '';
	                        } else {
	                            $koma = ', ';
	                        };

	                        $nama_result = $gelar_depan . $spasi . $nama . $koma . $gelar_belakang;

	                        echo "$nama_result";
	                    ?>
                    </td>  
                </tr>
                <tr>  
                    <td width="25%"><label><b>Tempat & Tanggal Lahir</b></label></td>  
                    <td width="75%">
                    	<?php
	                        $tempat_lahir = $row['tempat_lahir'];
	                        $tanggal_lahir = $row['tanggal_lahir'];

	                        $hari = (int) substr($tanggal_lahir, 8, 2);
	                        $bulan = (int) substr($tanggal_lahir, 5, 2);
	                        $tahun = (int) substr($tanggal_lahir, 0, 4);
	                        $hari = sprintf("%02s", $hari);
	                        $bulan = sprintf("%02s", $bulan);
	                        $tahun = sprintf("%04s", $tahun);
	                        $char1 = "-";
	                        $tanggal_hasil = $hari . $char1 . $bulan . $char1 . $tahun;

	                        $char2 = ', ';

	                        $ttl = $tempat_lahir . $char2 . $tanggal_hasil;

	                        echo "$ttl";
	                    ?>
                    </td>  
                </tr>               
                <tr>  
                    <td width="25%"><label><b>Gol./Ruang</b></label></td>  
                    <td width="75%"><?= $row['gol_akhir']; ?></td>  
                </tr>
                <tr>  
                    <td width="25%"><label><b>TMT-Golru</b></label></td>  
                    <td width="75%"><?= $row['tmt_gol_akhir']; ?></td>  
                </tr>
                <tr>  
                    <td width="25%"><label><b>Jabatan</b></label></td>  
                    <td width="75%"><?= $row['nama_jabatan_fungsional_umum']; ?></td>  
                </tr>
                <tr>  
                    <td width="25%"><label><b>Unit Kerja</b></label></td>  
                    <td width="75%"><?= $row['unit_kerja']; ?></td>  
                </tr>
                <tr>  
                    <td width="25%"><label><b>Unit Kerja Induk</b></label></td>  
                    <td width="75%"><?= $row['unit_kerja_induk']; ?></td>  
                </tr>
                <tr>  
                    <td width="25%"><label><b>Keterangan</b></label></td>  
                    <td width="75%"><?= $row['keterangan']; ?></td>  
                </tr>                   
	        </table>
        </div>
    </div>
<?php
    };
?>