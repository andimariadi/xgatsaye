<?php

require '../../db_con/koneksi.php';

if(isset($_POST["nip"])){
    $nip = $_POST["nip"];
    $query = mysqli_query($con,"SELECT * FROM data_pegawai WHERE nip = '$nip'");

?>  
    <div class="row">
        <div class="col-12 justify-content-center">
        	<table class="table table-bordered">
          		<?php
	               $row = mysqli_fetch_array($query);
          		?>
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
                    <td colspan="2" class="text-center"><b>CPNS/PNS</b></td>    
                </tr>
                <tr>  
                    <td width="25%"><label><b>Gol. Awal</b></label></td>  
                    <td width="75%"><?= $row['gol_awal_cpns']; ?></td>  
                </tr>
                <tr>  
                    <td width="25%"><label><b>TMT CPNS</b></label></td>  
                    <td width="75%"><?= $row['tmt_cpns']; ?></td>  
                </tr>
                <tr>  
                    <td width="25%"><label><b>TMT PNS</b></label></td>  
                    <td width="75%"><?= $row['tmt_pns']; ?></td>  
                </tr>
                <tr>  
                    <td colspan="2" class="text-center"><b>Golongan Ruang</b></td>    
                </tr>
                <tr>  
                    <td width="25%"><label><b>Gol. Akhir</b></label></td>  
                    <td width="75%"><?= $row['gol_akhir']; ?></td>  
                </tr>
                <tr>  
                    <td width="25%"><label><b>TMT</b></label></td>  
                    <td width="75%"><?= $row['tmt_gol_akhir']; ?></td>  
                </tr>
                <tr>  
                    <td colspan="2" class="text-center"><b>Masa Kerja</b></td>    
                </tr>
                <tr>  
                    <td width="25%"><label><b>Tahun</b></label></td>  
                    <td width="75%"><?= $row['thn_masa_kerja']; ?></td>  
                </tr>
                <tr>  
                    <td width="25%"><label><b>Bulan</b></label></td>  
                    <td width="75%"><?= $row['bln_masa_kerja']; ?></td>  
                </tr>
                <tr>  
                    <td colspan="2" class="text-center"><b>Jabatan Struktural</b></td>    
                </tr>
                <tr>  
                    <td width="25%"><label><b>Nama Jabatan</b></label></td>  
                    <td width="75%"><?= $row['nama_jabatan_struktural']; ?></td>  
                </tr>
                <tr>  
                    <td width="25%"><label><b>TMT</b></label></td>  
                    <td width="75%"><?= $row['tmt_jabatan_struktural']; ?></td>  
                </tr>
                <tr>  
                    <td colspan="2" class="text-center"><b>Jabatan Fungsional Tertentu</b></td>    
                </tr>
                <tr>  
                    <td width="25%"><label><b>Nama Jabatan</b></label></td>  
                    <td width="75%"><?= $row['nama_jabatan_fungsional_tertentu']; ?></td>  
                </tr>
                <tr>  
                    <td width="25%"><label><b>TMT</b></label></td>  
                    <td width="75%"><?= $row['tmt_jabatan_fungsional_tertentu']; ?></td>  
                </tr>
                <tr>  
                    <td colspan="2" class="text-center"><b>Jabatan Fungsional Umum</b></td>    
                </tr>
                <tr>  
                    <td width="25%"><label><b>Nama Jabatan</b></label></td>  
                    <td width="75%"><?= $row['nama_jabatan_fungsional_umum']; ?></td>  
                </tr>
                <tr>  
                    <td colspan="2" class="text-center"><p></p></td>    
                </tr>
                <tr>  
                    <td width="25%"><label><b>Unit Kerja</b></label></td>  
                    <td width="75%"><?= $row['unit_kerja']; ?></td>  
                </tr>
                <tr>  
                    <td width="25%"><label><b>Unit Kerja Induk</b></label></td>  
                    <td width="75%"><?= $row['unit_kerja_induk']; ?></td>  
                </tr>
	        </table>
        </div>
    </div>
<?php
    };
?>