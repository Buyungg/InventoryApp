<?php
require '../function.php';
require '../ceklogin.php';
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
                        <h1 class="mt-4">Barang Masuk</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Data Barang</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                 Tambah Barang
                                </button>
                                <br>
                                <div class="row mt-4">
                                    <div class="col">
                                        <form method="post" class="form-inline">
                                    <input type="date" name="tgl_mulai" class="form-control">
                                    <input type="date" name="tgl_selesai" class="form-control ml-3">
                                    <button type="submit" name="filter_tgl" class="btn btn-info ml-3" > Filter </button>
                                        </form>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Barang</th>
                                                <th>Tanggal</th>
                                                <th>Penerima</th>
                                                <th>Harga</th>
                                                <th>Jumlah</th>
                                                <th>Total</th>
                                                <th>AKSI</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           

                                        <?php

                                            if(isset($_POST['filter_tgl'])){
                                                $mulai = $_POST['tgl_mulai'];
                                                $selesai = $_POST['tgl_selesai'];

                                                if($mulai!=null || $selesai!=null){
                                                    $ambilsemuadatamasuk= mysqli_query($conn, "select * from masuk m, barang s where s.Idbarang = m.Idbarang and tanggalm BETWEEN '$mulai' and DATE_ADD('$selesai',INTERVAL 1 DAY)" );
                                                } else {
                                                    $ambilsemuadatamasuk= mysqli_query($conn, "select * from masuk m, barang s where s.Idbarang = m.Idbarang");
                                                }
                                                
                                            } else {
                                                $ambilsemuadatamasuk= mysqli_query($conn, "select * from masuk m, barang s where s.Idbarang = m.Idbarang");
                                            }

                                            $i = 1;
                                            while($data=mysqli_fetch_array($ambilsemuadatamasuk)){
                                                $idb = $data['idbarang'];
                                                $idm = $data['Idmasuk'];
                                                $namabarang = $data['namabarang'];
                                                $tanggal = $data['tanggalm'];
                                                $keterangan = $data['keterangan'];
                                                $harga = $data['harga'];
                                                $qty = $data['qty'];
                                                $total = $data['total'];
                                                

                                            

                                            ?>
                                            <tr>
                                                <td><?=$i++;?></td>
                                                <td><?=$namabarang;?></td>
                                                <td><?=$tanggal;?></td>
                                                <td><?=$keterangan;?></td>
                                                <td>Rp. <?=number_format($harga, 0, '','.' );?></td>
                                                <td><?=$qty;?></td>
                                                <td>Rp. <?=number_format($total, 0, '','.');?></td>
                                                <td>
                                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?=$idm;?>">
                                                    Edit
                                                    </button>
                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?=$idm;?>">
                                                        Delete
                                                        </button>
                                                </td>
                                            </tr>

                                            <!-- Edit -->
                                            <div class="modal fade" id="edit<?=$idm;?>">
                                            <div class="modal-dialog">
                                            <div class="modal-content">
                                            
                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                <h4 class="modal-title">Edit Data Masuk</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                
                                                <!-- Modal body -->
                                                <form method="post">
                                                <div class="modal-body">
                                                Penerima
                                                <input type="text" name="keterangan" value="<?=$keterangan;?>" class="form-control" required>
                                                <br>
                                                Jumlah
                                                <input type="number" name="qty" value="<?=$qty;?>" class="form-control" required>
                                                <br>
                                                <input type="text" name="harga" value="<?=$harga;?>" class="form-control" required>
                                                <br>
                                                <input type="hidden" name="idb" value="<?=$idb;?>">
                                                <input type="hidden" name="idm" value="<?=$idm;?>">
                                                <br>
                                                <button type="submit" class="btn btn-primary" name="updatebarangmasuk"> Submit </button>
                                                </div>
                                                </form>
                                            </div>
                                            </div>
                                        </div>

                                        <!-- Delete -->
                                        <div class="modal fade" id="delete<?=$idm;?>">
                                            <div class="modal-dialog">
                                            <div class="modal-content">
                                            
                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                <h4 class="modal-title">Hapus Data Masuk</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                
                                                <!-- Modal body -->
                                                <form method="post">
                                                <div class="modal-body">
                                                Apakah Anda Yakin Ingin Menghapus (<?=$namabarang;?>) ?
                                                <input type="hidden" name="idb" value="<?=$idb;?>">
                                                <input type="hidden" name="idm" value="<?=$idm;?>">
                                                <input type="hidden" name="kty" value="<?=$qty;?>">
                                                <br>
                                                <br>
                                                <button type="submit" class="btn btn-danger" name="hapusbarangmasuk"> Hapus </button>
                                                </div>
                                                </form>
                                            </div>
                                            </div>
                                        </div>

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
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Barang Masuk</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <form method="POST">
        <div class="modal-body">
        <select name="barangnya" class="form-control">
           <?php 
           $ambilsemuadatanya = mysqli_query($conn, "select * from barang");
           while($fetcharray = mysqli_fetch_array($ambilsemuadatanya)){
            $namabarangnya = $fetcharray['namabarang'];
            $idbarangnya = $fetcharray['Idbarang']; 
            ?>
            <option value="<?=$idbarangnya;?>"><?=$namabarangnya;?></option>
            <?php
           }
           ?>
          </select>
          <br>
          <input type="text" name="penerima" placeholder="Penerima Barang" class="form-control" required>
          <br>
          <input type="number" name="qty" placeholder="Jumlah Masuk" class="form-control" required>
          <br>
          <input type="text" name="harga" placeholder="Harga Satuan" class="form-control" required>
          <br>
          <button type="submit" class="btn btn-primary" name="barangmasuk"> Submit </button>
        </div>
        </form>
        <!-- Modal footer -->
        
      </div>
    </div>
  </div>
</html>