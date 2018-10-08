<?php
    require("config.php");
    session_start();

    @$username = $_SESSION['username'];
    $ceknim = $pdo -> prepare("SELECT * FROM mahasiswa WHERE username = '$username'");
    $ceknim -> execute();
    $mahasiswa = $ceknim -> fetch(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html>
<head>
    <title> Form Mahasiswa </title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    <form method="post" class="mhs">
        <h4><center> Form Mahasiswa </center></h4>
        <div id="isiform">
            NIM <br>
            <input type="text" name="nim" pattern="\d*" maxlength="10" value="<?php echo $mahasiswa['nim']; ?>"><br><br>
            Nama <br>
            <input type="text" name="nama" id="input" value="<?php echo $mahasiswa['nama']; ?>"><br><br>
            Kelas :
            <input type="radio" name="kelas" id="radio" value="D3MI-41-01"> D3MI-41-01
            <input type="radio" name="kelas" id="radio" value="D3MI-41-02"> D3MI-41-02
            <input type="radio" name="kelas" id="radio" value="D3MI-41-03"> D3MI-41-03
            <input type="radio" name="kelas" id="radio" value="D3MI-41-04"> D3MI-41-04 <br><br>
            Jenis Kelamin :
            <input type="radio" name="jk" id="radio" value="Laki-Laki" > Laki-Laki 
            <input type="radio" name="jk" id="radio" value="Perempuan" > Perempuan <br><br>
            Hobby : <br>
            <input type="checkbox" name="hobby[]" value="Membaca"> Membaca <br>
            <input type="checkbox" name="hobby[]" value="Mewarnai"> Mewarnai <br>
            <input type="checkbox" name="hobby[]" value="Melukis"> Melukis <br>
            <input type="checkbox" name="hobby[]" value="Bermain Game"> Bermain Game <br><br>
            Fakultas 
            <select name="fakultas" id="fakultas" required><br>
            <option value="FTE"> FTE </option>
            <option value="FIF"> FIF </option>
            <option value="FRI"> FRI </option>
            <option value="FEB"> FEB </option>
            <option value="FKB"> FKB </option>
            <option value="FIK"> FIK </option>
            <option value="FIT"> FIT </option>
            </select>
            <br><br>
            Alamat : <br>
            <textarea name="alamat" cols="30" rows="10"></textarea>
            <br><br>
            <input type="submit" value="SUBMIT" id="submit">
        </div>
    </form>
    <a href="index.php?logout=iya" id="logoutmhs"><input type="button" value="LOGOUT"></a>
</body>
</html>

<?php
if (isset($_POST['nim'])) {
    $nim = $_POST['nim'];
    $nama = addslashes($_POST['nama']);
    $kelas = $_POST['kelas'];
    $jk = $_POST['jk'];
    $hobi = $_POST['hobby'];
    $fakultas = $_POST['fakultas'];
    $alamat = $_POST['alamat'];

    $list_hobi = implode(", ", $hobi);

    $kueri = $pdo -> prepare("UPDATE mahasiswa SET nim = '$nim', nama = '$nama', kelas = '$kelas', jk = '$jk', hobi =  '$list_hobi', fakultas =  '$fakultas', alamat = '$alamat' WHERE username = '$username'");
    $kueri -> execute();
        
    if ($kueri) {
        ?>
        <script type="text/javascript">
            alert("Berhasil Input!");
            header("Location : form.php")
        </script>
        <?php
    } else { 
        ?>
        <script type="text/javascript">
            alert("Input gagal!");
        </script>
        <?php
    }
}
?>