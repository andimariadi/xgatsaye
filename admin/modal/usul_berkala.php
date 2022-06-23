<?php

require '../../db_con/koneksi.php';

if(isset($_POST["nip"])){
     $nip = $_POST["nip"];

    // $query1 = mysqli_query($con, "SELECT max(token) as kodeTerbesar FROM proses_usul_berkala");
    // $data = mysqli_fetch_array($query1);
    // $token = $data['kodeTerbesar'];

    // $token++;
    // $token = sprintf("%05s", $token);

?>  
    <div class="row">
        <div class="col-12 justify-content-center text-center">
            <form method="post" action="fungsi/usul_berkala.php" class="text-center pt-3 pb-4">

                <div class="input-group mt-1 mb-1">
                    <input type="hidden"  name="nip" value="<?= $nip; ?>">
                    <!-- <input type="hidden"  name="token" value="<?= $token; ?>"> -->
                </div>

                <h4 class="mb-4">Pilih Kategori Usul Berkala</h4>           
                <div class="input-group mb-4">
                    <select class="custom-select" id="inputGroupSelect01" type="text" name="kategori" required>
                        <option value="">.: Gol/Pangkat :.</option>
                        <option value="Ia">Ia</option>
                        <option value="Ib">Ib</option>
                        <option value="Ic">Ic</option>
                        <option value="IId">Id</option>
                        <option value="IIa">IIa</option>
                        <option value="IIb">IIb</option>
                        <option value="IIc">IIc</option>
                        <option value="IId">IId</option>
                        <option value="IIIa">IIIa</option>
                        <option value="IIIb">IIIb</option>
                        <option value="IIIc">IIIc</option>
                        <option value="IIId">IIId</option>
                        <option value="IVa">IVa</option>
                        <option value="IVb">IVb</option>
                        <option value="IVc">IVc</option>
                        <option value="IVd">IVd</option>
                        <option value="IVe">IVe</option>
                    </select>
                </div>

                <div class="input-group mb-4">
                    <select class="custom-select" id="inputGroupSelect01" type="text" name="masa_jabatan" required>
                        <option value="">.: Tahun :.</option>
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
                        <option value="15">15</option>
                        <option value="16">16</option>
                        <option value="17">17</option>
                        <option value="18">18</option>
                        <option value="19">19</option>
                        <option value="20">20</option>
                        <option value="21">21</option>
                        <option value="22">22</option>
                        <option value="23">23</option>
                        <option value="24">24</option>
                        <option value="25">25</option>
                        <option value="26">26</option>
                        <option value="27">27</option>
                        <option value="28">28</option>
                        <option value="29">29</option>
                        <option value="30">30</option>
                        <option value="31">31</option>
                        <option value="32">32</option>
                        <option value="33">33</option>
                    </select>
                </div>

                <button type="button" class="btn btn-secondary" data-dismiss="modal"  style="width: 130px; height: 40px">
                    <i class="far fa-times-circle"></i>
                    Close
                </button>
                <button type="button submit" value="OK" class="btn btn-warning" style="width: 130px; height: 40px">
                    <i class="fas fa-user-check"></i>
                    Proses
                </button>
            </form>
        </div>
    </div>
<?php
    };
?>