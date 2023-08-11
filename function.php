<?php
session_start();

$conn = mysqli_connect("localhost","root","","db_persediaan");

//insert
if(isset($_POST['addnewbarang'])){
    $namabarang = $_POST['namabarang'];
    $deskripsi = $_POST['deskripsi'];
    $stock = $_POST['stock'];
    
    $addtotable = mysqli_query($conn, "insert into barang (namabarang, deskripsi, stock) values('$namabarang','$deskripsi','$stock')");
    if($addtotable){
        header('location:index.php');
    } else {
        echo "
                <script>
                alert('Data Gagal Ditambahkan');
                document.location.href = 'index.php';
                </script>
                ";
    }
}

//masuk
if(isset($_POST['barangmasuk'])){
    $barangnya = $_POST['barangnya'];
    $penerima = $_POST['penerima'];
    $qty = $_POST['qty'];

    $cekstocksekarang = mysqli_query($conn, "select * from barang where Idbarang='$barangnya'");
    $ambildatanya = mysqli_fetch_array($cekstocksekarang);

    $stocksekarang = $ambildatanya['stock'];
    $tambahkanstocksekarangdenganquantity = $stocksekarang+$qty;

    $addtomasuk = mysqli_query($conn, "insert into masuk (Idbarang, keterangan, qty) values ('$barangnya','$penerima','$qty')");
    $updatestockmasuk = mysqli_query($conn, "update barang set stock='$tambahkanstocksekarangdenganquantity' where idbarang='$barangnya'");
    if($addtomasuk&&$updatestockmasuk){
        header('location:masuk.php');
    } else {
        echo "
                <script>
                alert('Data Gagal Ditambahkan');
                document.location.href = 'masuk.php';
                </script>
                ";
    }
}

//keluar
if(isset($_POST['barangkeluar'])){
    $barangnya = $_POST['barangnya'];
    $penerima = $_POST['penerima'];
    $qty = $_POST['qty'];


    $cekstocksekarang = mysqli_query($conn, "select * from barang where Idbarang='$barangnya'");
    $ambildatanya = mysqli_fetch_array($cekstocksekarang);

    $stocksekarang = $ambildatanya['stock'];
    $tambahkanstocksekarangdenganquantity = $stocksekarang-$qty;


    $addtokeluar = mysqli_query($conn, "insert into keluar (idbarang, penerima, qty) values ('$barangnya','$penerima','$qty')");
    $updatestockmasuk = mysqli_query($conn, "update barang set stock='$tambahkanstocksekarangdenganquantity' where Idbarang='$barangnya'");
    if($addtokeluar&&$updatestockmasuk){
        header('location:keluar.php');
    } else {
        echo "
                <script>
                alert('Data Gagal Ditambahkan');
                document.location.href = 'keluar.php';
                </script>
                ";
    }
}


//update
if(isset($_POST['updatebarang'])){
    $idb = $_POST['idb'];
    $namabarang = $_POST['namabarang'];
    $deskripsi = $_POST['deskripsi'];

    $update = mysqli_query($conn, "update barang set namabarang='$namabarang', deskripsi='$deskripsi' where Idbarang ='$idb'");
    if($update){
        header('location:index.php');
    } else {
        echo "
                <script>
                alert('Data Gagal Ditambahkan');
                document.location.href = 'index.php';
                </script>
                ";
    }
}

//hapus
if(isset($_POST['hapusbarang'])){
    $idb = $_POST['idb'];

    $hapus = mysqli_query($conn, "delete from barang where Idbarang='$idb'");
    if($hapus){
        header('location:index.php');
    } else {
        echo "
                <script>
                alert('Data Gagal Ditambahkan');
                document.location.href = 'index.php';
                </script>
                ";
    }
}

//update masuk
if(isset($_POST['updatebarangmasuk'])){
    $idb = $_POST['idb'];
    $idm = $_POST['idm'];
    $keterangan = $_POST['keterangan'];
    $qty = $_POST['qty'];

    $lihatstock = mysqli_query($conn, "select * from barang where Idbarang='$idb'");
    $stcoknya = mysqli_fetch_array($lihatstock);
    $stockskrg = $stcoknya['stock'];

    $qtyskrg = mysqli_query($conn, "select * from masuk where Idmasuk='$idm'");
    $qtynya = mysqli_fetch_array($qtyskrg);
    $qtyskrg = $qtynya['qty'];

    if($qty>$qtyskrg){
        $selisih = $qty-$qtyskrg;
        $kurangin = $stockskrg + $selisih;
        $kurangistocknya = mysqli_query($conn, "update barang set stock='$kurangin' where Idbarang='$idb'");
        $updatenya = mysqli_query($conn, "update masuk set qty='$qty', keterangan='$keterangan' where Idmasuk='$idm'");
        if($kurangistocknya&&$updatenya){
            header('location:masuk.php');
    } else {
        echo "
                <script>
                alert('Data Gagal Ditambahkan');
                document.location.href = 'masuk.php';
                </script>
                ";
    }
        } else {
            $selisih = $qtyskrg-$qty;
            $kurangin = $stockskrg - $selisih;
            $kurangistocknya = mysqli_query($conn, "update barang set stock='$kurangin' where Idbarang='$idb'");
            $updatenya = mysqli_query($conn, "update masuk set qty='$qty', keterangan='$keterangan' where Idmasuk='$idm'");
            if($kurangistocknya&&$updatenya){
                header('location:masuk.php');
        } else {
            echo "
                    <script>
                    alert('Data Gagal Ditambahkan');
                    document.location.href = 'masuk.php';
                    </script>
                    ";
          } 
        }
    }


//delete masuk
if(isset($_POST['hapusbarangmasuk'])){
    $idb = $_POST['idb'];
    $qty = $_POST['kty'];
    $idm = $_POST['idm'];

    $getdatastock = mysqli_query($conn, "select * from barang where Idbarang='$idb'");
    $data = mysqli_fetch_array($getdatastock);
    $stok = $data['stock'];

    $selisih = $stok-$qty;

    $update = mysqli_query($conn, "update barang set stock='$selisih' where Idbarang='$idb'");
    $hapusdata = mysqli_query($conn, "delete from masuk where Idmasuk='$idm'");

    if($update&&$hapusdata){
        header('location:masuk.php');
    } else {
        echo "
                <script>
                alert('Data Gagal Ditambahkan');
                document.location.href = 'masuk.php';
                </script>
                ";
      } 
    }

//data keluar
if(isset($_POST['updatebarangkeluar'])){
    $idb = $_POST['idb'];
    $idk = $_POST['idk'];
    $penerima = $_POST['penerima'];
    $qty = $_POST['qty'];

    $lihatstock = mysqli_query($conn, "select * from barang where Idbarang='$idb'");
    $stcoknya = mysqli_fetch_array($lihatstock);
    $stockskrg = $stcoknya['stock'];

    $qtyskrg = mysqli_query($conn, "select * from keluar where Idkeluar='$idk'");
    $qtynya = mysqli_fetch_array($qtyskrg);
    $qtyskrg = $qtynya['qty'];

    if($qty>$qtyskrg){
        $selisih = $qty-$qtyskrg;
        $kurangin = $stockskrg - $selisih;
        $kurangistocknya = mysqli_query($conn, "update barang set stock='$kurangin' where Idbarang='$idb'");
        $updatenya = mysqli_query($conn, "update keluar set qty='$qty', penerima='$penerima' where Idkeluar='$idk'");
        if($kurangistocknya&&$updatenya){
            header('location:keluar.php');
    } else {
        echo "
                <script>
                alert('Data Gagal Ditambahkan');
                document.location.href = 'keluar.php';
                </script>
                ";
    }
        } else {
            $selisih = $qtyskrg-$qty;
            $kurangin = $stockskrg + $selisih;
            $kurangistocknya = mysqli_query($conn, "update barang set stock='$kurangin' where Idbarang='$idb'");
            $updatenya = mysqli_query($conn, "update keluar set qty='$qty', penerima='$penerima' where Idkeluar='$idk'");
            if($kurangistocknya&&$updatenya){
                header('location:keluar.php');
        } else {
            echo "
                    <script>
                    alert('Data Gagal Ditambahkan');
                    document.location.href = 'keluar.php';
                    </script>
                    ";
          } 
        }
    }


//delete keluar
if(isset($_POST['hapusbarangkeluar'])){
    $idb = $_POST['idb'];
    $qty = $_POST['kty'];
    $idk = $_POST['idk'];

    $getdatastock = mysqli_query($conn, "select * from barang where Idbarang='$idb'");
    $data = mysqli_fetch_array($getdatastock);
    $stok = $data['stock'];

    $selisih = $stok+$qty;

    $update = mysqli_query($conn, "update barang set stock='$selisih' where Idbarang='$idb'");
    $hapusdata = mysqli_query($conn, "delete from keluar where Idkeluar='$idk'");

    if($update&&$hapusdata){
        header('location:keluar.php');
    } else {
        echo "
                <script>
                alert('Data Gagal Ditambahkan');
                document.location.href = 'keluar.php';
                </script>
                ";
      } 
    }
?>