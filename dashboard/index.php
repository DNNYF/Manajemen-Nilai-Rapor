<?php
session_start();
require "../connection/koneksi.php";
require "../connection/session.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags --> 
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Dashboard Admin</title>
  <!-- base:css -->
  <link rel="stylesheet" href="vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="vendors/feather/feather.css">
  <link rel="stylesheet" href="vendors/base/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css"/>
  <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="vendors/jquery-bar-rating/fontawesome-stars-o.css">
  <link rel="stylesheet" href="vendors/jquery-bar-rating/fontawesome-stars.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/favicon.png" />
</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
        <ul class="navbar-nav mr-lg-2">
          <li class="nav-item nav-search d-none d-lg-block">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text" id="search">
                  <i class="icon-search"></i>
                </span>
              </div>
              <input type="text" class="form-control" placeholder="Search Projects.." aria-label="search" aria-describedby="search">
            </div>
          </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item dropdown d-lg-flex d-none">
                <a href="../login/logout.php"><button type="button" class="btn btn-info font-weight-bold">LOGOUT</button></a>
            </li>
          </li>
          <li class="nav-item dropdown d-flex mr-4 ">
            <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center" id="notificationDropdown" href="#" data-toggle="dropdown">
              <i class="icon-cog"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
              <p class="mb-0 font-weight-normal float-left dropdown-header">Settings</p>
              <a class="dropdown-item preview-item">               
                  <i class="icon-head"></i> Profile
              </a>

            </div>
          </li>
          <li class="nav-item dropdown mr-4 d-lg-flex d-none">
            <a class="nav-link count-indicatord-flex align-item s-center justify-content-center" href="#">
              <i class="icon-grid"></i>
            </a>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="icon-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper" style="padding-top: 5px;">
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <div class="user-profile">
          <div class="user-image">
            <img src="images/sd.png">
          </div>
          <div class="user-name">
              UPTD SD NEGERI 1 TERUSAN
          </div>
          <div class="user-designation">
              SINDANG, INDRAMAYU
          </div>
        </div>
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="../guru/">
              <i class="icon-pie-graph menu-icon"></i>
              <span class="menu-title">Guru</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../Siswa/crudSiswa.php">
              <i class="icon-file menu-icon"></i>
              <span class="menu-title">Siswa</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../nilai/index.php">
              <i class="icon-command menu-icon"></i>
              <span class="menu-title">Penilaian</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../user/">
              <i class="icon-book menu-icon"></i>
              <span class="menu-title">Tambah Akun Guru</span>
            </a>
          </li>
            <li class="nav-item">
              <a class="nav-link" href="../../../nilai/index.php">
                <i class="icon-help menu-icon"></i>
                <span class="menu-title">Cetak Rapor</span>
              </a>
            </li>
          
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-sm-12 mb-4 mb-xl-0">
              <h4 class="font-weight-bold text-dark">Management Nilai Rapor Siswa</h4>
              <p class="font-weight-normal mb-2 text-muted">mei , 26 , 2023</p>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-xl-3 flex-column d-flex grid-margin stretch-card">
              <div class="row flex-grow">
                <div class="col-sm-12 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                          <h4 class="card-title">Nilai Masuk</h4>
                          <p>23% dari 76% nilai</p>
                          <h4 class="text-dark font-weight-bold mb-2">43,981</h4>
                          <canvas id="customers"></canvas>
                      </div>
                    </div>
                </div>
                <div class="col-sm-12 stretch-card">
                    <div class="card">
                      <div class="card-body">
                          <h4 class="card-title">Nilai Keluar</h4>
                          <p>6% dari 93% nilai</p>
                          <h4 class="text-dark font-weight-bold mb-2">55,543</h4>
                          <canvas id="orders"></canvas>
                      </div>
                    </div>
               </div>
              </div>
            </div>
            <div class="col-xl-9 d-flex grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                      <h4 class="card-title">Presentase Nilai Semester</h4>
                      <div class="row">
                        <div class="col-lg-5">
                          <p>Rekapan Nilai Siswa</p>
                        </div>
                       
                      </div>
                      <div class="row">
                          <div class="col-sm-12">
                              <canvas id="web-audience-metrics-satacked" class="mt-3"></canvas>
                          </div>
                      </div>
                        
                    </div>
                  </div>
            </div>
          </div>
                <div class="progress progress-md grouped mb-2">
                          <div class="progress-bar  bg-danger" role="progressbar" style="width: 30%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                          <div class="progress-bar bg-info" role="progressbar" style="width: 20%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                          <div class="progress-bar  bg-primary" role="progressbar" style="width: 10%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                          <div class="progress-bar bg-warning" role="progressbar" style="width: 10%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                          <div class="progress-bar bg-success" role="progressbar" style="width: 5%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                          <div class="progress-bar bg-light" role="progressbar" style="width: 25%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>

          <div class="row">
            <div class="col-xl-9 grid-margin-lg-0 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Presentase</h4>
                    <div class="table-responsive mt-3">
                      <table class="table table-header-bg">
                        <thead>
                          <tr>
                            <th>
                                KELAS
                            </th>
                            <th>
                                KKM
                            </th>
                            <th>
                                NILAI
                            </th>
                            <th>
                                PRESENTASE
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>
                              <i  id="us"></i> Kelas 1 
                            </td>
                            <td>
                              75
                            </td>
                            <td>
                              <div class="text-success"><i class="icon-arrow-up mr-2"></i>+60%</div>
                            </td>
                            <td>
                              <div class="row">
                                <div class="col-sm-10">
                                  <div class="progress">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                  </div>
                                </div>
                                <div class="col-sm-2">
                                  25%
                                </div>
                              </div>
                            </td>
                            
                          </tr>
                          <tr>
                            <td>
                              <i id="at"></i> Kelas 2
                            </td>
                            <td>
                                75
                            </td>
                            <td>
                              <div class="text-danger"><i class="icon-arrow-down mr-2"></i>-40%</div>
                            </td>
                            <td>
                              <div class="row">
                                <div class="col-sm-10">
                                  <div class="progress">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                  </div>
                                </div>
                                <div class="col-sm-2">
                                  50%
                                </div>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <i id="fr"></i> Kelas 3
                            </td>
                            <td>
                                75
                            </td>
                            <td>
                              <div class="text-success"><i class="icon-arrow-up mr-2"></i>+40%</div>
                            </td>
                            <td>
                              <div class="row">
                                <div class="col-sm-10">
                                  <div class="progress">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 10%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                  </div>
                                </div>
                                <div class="col-sm-2">
                                  10%
                                </div>
                                <tr>
                                  <td>
                                    <i  id="us"></i> Kelas 4 
                                  </td>
                                  <td>
                                    75
                                  </td>
                                  <td>
                                    <div class="text-success"><i class="icon-arrow-up mr-2"></i>+60%</div>
                                  </td>
                                  <td>
                                    <div class="row">
                                      <div class="col-sm-10">
                                        <div class="progress">
                                          <div class="progress-bar bg-info" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                      </div>
                                      <div class="col-sm-2">
                                        25%
                                      </div>
                                    </div>
                                  </td>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td class="py-1">
                              <i  id="de"></i> Kelas 5
                            </td>
                            <td>
                                75
                            </td>
                            <td>
                              <div class="text-danger"><i class="icon-arrow-down mr-2"></i>-80%</div>
                            </td>
                            <td>
                              <div class="row">
                                <div class="col-sm-10">
                                  <div class="progress">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 70%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                  </div>
                                </div>
                                <div class="col-sm-2">
                                  70%
                                </div>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td class="pb-0">
                              <i  id="ae"></i> Kelas 6
                            </td>
                            <td class="pb-0">
                                75
                            </td>
                            <td class="pb-0">
                              <div class="text-success"><i class="icon-arrow-up mr-2"></i>+80%</div>
                            </td>
                            <td class="pb-0">
                              <div class="row">
                                <div class="col-sm-10">
                                  <div class="progress">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 60%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                  </div>
                                </div>
                                <div class="col-sm-2">
                                  0%
                                </div>
                                
                              </div>
                            </td>
                          </tr>
                          
                        </tbody>
                      </table>
                    </div>
                </div>
              </div>
            </div>
                      </div>
                    </div>

                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">UPTD SD NEGERI 1 TERUSAN</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Management rapor Siswa <a href="https://www.bootstrapdash.com/" target="_blank">make by kelompok 4</a> from Polindra</span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- base:js -->
  <script src="vendors/base/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <!-- endinject -->
  <!-- plugin js for this page -->
  <script src="vendors/chart.js/Chart.min.js"></script>
  <script src="vendors/jquery-bar-rating/jquery.barrating.min.js"></script>
  <!-- End plugin js for this page -->
  <!-- Custom js for this page-->
  <script src="js/dashboard.js"></script>
  <!-- End custom js for this page-->
</body>

</html>

