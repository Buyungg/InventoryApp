<?php
require '../function.php';
require '../ceklogin.php';


//dapetin ID
$idbarang = $_GET['id'];
//getinfobarang
$get = mysqli_query($conn,"select * from barang where idbarang='$idbarang'");
$fetch = mysqli_fetch_assoc($get);
//setvariabel
$namabarang = $fetch['namabarang'];
$deskripsi = $fetch['deskripsi'];
$stock = $fetch['stock'];
$satuan = $fetch['satuan'];

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Inventory App</title>
        <link href="../css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="index.html">Inventory App</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <!-- Navbar-->
        </nav>
        <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                                </a>
                                <a class="nav-link" href="masuk.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-desktop"></i></div>
                                Barang Masuk
                                </a>
                                <a class="nav-link" href="keluar.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-truck"></i></div>
                                Barang Keluar
                                </a>
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Pages
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Authentication
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="admin.php">Admin</a>
                                            <a class="nav-link" href="logout.php">Logout</a>
                                        </nav>
                                    </div>
                                </nav>
                            </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Detail Barang</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Detail</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
                               <h2> <?=$namabarang;?> </h2>
                            </div>
                            <div class="card-body">




                            <div class="row">
                                <div class="col-md-3">Deskripsi</div>
                                <div class="col-md-9">: <?=$deskripsi;?></div>
                            </div>


                            <div class="row">
                                <div class="col-md-3">Stock</div>
                                <div class="col-md-9">: <?=$stock;?></div>
                            </div>

                                <br><br><hr>

                                <h3>Barang Masuk</h3>
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="barangmasuk" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>Penerima</th>
                                                <th>Jumlah</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>


                                            <?php
                                             $ambildatamasuk = mysqli_query($conn, "select * from masuk  where idbarang='$idbarang'");
                                            $i = 1;
                                             while($fetch = mysqli_fetch_array($ambildatamasuk)){
                                                 $tanggal = $fetch['tanggalm'];
                                                 $keterangan = $fetch['keterangan'];
                                                 $quantity = $fetch['qty'];                               
                                            ?>
                                            <tr>
                                                <td><?=$i++;?></td>
                                                <td><?=$tanggal;?></td>
                                                <td><?=$keterangan;?></td>
                                                <td><?=$quantity;?></td>
                                            </tr>
                                        <?php
                                            }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>

                                <br><br>

                                <h3>Barang Keluar</h3>
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="barangkeluar" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>Penerima</th>
                                                <th>Jumlah</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>


                                            <?php
                                             $ambildatakeluar = mysqli_query($conn, "select * from keluar where idbarang='$idbarang'");
                                            $i = 1;
                                             while($fetch = mysqli_fetch_array($ambildatakeluar)){
                                                 $tanggal = $fetch['tanggalk'];
                                                 $penerima = $fetch['penerima'];
                                                 $quantity = $fetch['qty'];                               
                                            ?>
                                            <tr>
                                                <td><?=$i++;?></td>
                                                <td><?=$tanggal;?></td>
                                                <td><?=$penerima;?></td>
                                                <td><?=$quantity;?></td>
                                            </tr>
                                        <?php
                                            }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="../assets/demo/chart-area-demo.js"></script>
        <script src="../assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="../assets/demo/datatables-demo.js"></script>
    </body>

    <div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">

    <div class="modal-header">
          <h4 class="modal-title">Tambah Barang</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <form method="post">
        <div class="modal-body">
          <input type="text" name="namabarang" placeholder="Nama Barang" class="form-control" required>
          <br>
          <input type="text" name="deskripsi" placeholder="Deskripsi Barang" class="form-control" required>
          <br>
          <input type="number" name="stock" class="form-control" placeholder="Stock" required>
          <br>
          <select name="satuan" class="form-control" >
            <option selected>Pilih satuan</option>
            <option value="Buah">Buah</option>
            <option value="Unit">Unit</option>
            <option value="Hindu">Meter</option>
            <option value="Centimeter">Centimeter</option>
            <option value="Milimeter">Milimeter</option>
            </select>
           <br>
          <button type="submit" class="btn btn-primary" name="addnewbarang"> Submit </button>
        </div>
        </form>
      </div>
    </div>
  </div>
</html>
