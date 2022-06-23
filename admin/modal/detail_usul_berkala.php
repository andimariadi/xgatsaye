<?php

require '../../db_con/koneksi.php';

if(isset($_POST["nip"])){
    $nip = $_POST["nip"];
    $query = mysqli_query($con,"SELECT * FROM proses_usul_berkala INNER JOIN data_pegawai ON proses_usul_berkala.nip = data_pegawai.nip WHERE proses_usul_berkala.nip = '$nip'");

?>  
    <div class="row">
        <div class="col-12 justify-content-center">
        	<table class="table table-bordered">
          		<?php
	               $row = mysqli_fetch_array($query);
          		?>
                <tr>  
                    <td width="25%"><label><b>Tanggal</b></label></td>  
                    <td width="75%"><?= $row['tanggal']; ?></td>  
                </tr>
                <tr>  
                    <td width="25%"><label><b>Kategori</b></label></td>  
                    <td width="75%"><?= $row['kategori']; ?></td>  
                </tr>
                <tr>  
                    <td width="25%"><label><b>NIP</b></label></td>  
                    <td width="75%"><?= $row['nip']; ?></td>  
                </tr>
                <!-- <tr>  
                    <td width="25%"><label><b>TOKEN</b></label></td>  
                    <td width="75%"><?= $row['token']; ?></td>  
                </tr> -->
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