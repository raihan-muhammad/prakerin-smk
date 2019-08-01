<div class="main-content">
    <!-- Navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <!-- Brand -->
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="">Dashboard</a>
        <!-- Form -->
        <!-- <form class="navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex ml-lg-auto">
          <div class="form-group mb-0">
            <div class="input-group input-group-alternative">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-search"></i></span>
              </div>
              <input class="form-control" placeholder="Search" type="text">
            </div>
          </div>
        </form> -->
        <!-- User -->
        <ul class="navbar-nav align-items-center d-none d-md-flex">
          <li class="nav-item dropdown">
            <a class="nav-link pr-0" href="" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="media align-items-center">
                
                <div class="media-body ml-2 d-none d-lg-block">
                  <span class="mb-0 text-sm  font-weight-bold">Selamat Datang, <b><?php echo $this->session->userdata('nama') ?></b></span>
                </div>
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
              <a href="<?php echo base_url('login/logout') ?>" class="dropdown-item">
                <i class="ni ni-user-run"></i>
                <span>Logout</span>
              </a>
            </div>
          </li>
        </ul>
      </div>
    </nav>
    <!-- End Navbar -->
    <!-- Header -->
    <div class="header bg-gradient-info pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
          
          <div class="row">
            <div class="col-md-3 mb-3">
              <h1 class="display-4 text-white text-uppercase" style="border-bottom: 2px solid #fff;">Tambah Berkas</h1>
            </div>            
          </div>
          
          <?php echo form_open_multipart('admin/doTambahBerkas') ?>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <div class="input-group input-group-alternative mb-4">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-archive-2"></i></span>
                    </div>
                    <input class="form-control form-control-alternative" placeholder="Masukan Nama Berkas" type="text" name="nama" required>
                  </div>
                </div>
              </div>

              <div class="col-md-5">
                <div class="form-group">
                  <div class="input-group input-group-alternative mb-4">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-folder-17"></i></span>
                    </div>
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="customFile" name="berkas" required>
                      <label class="custom-file-label" for="customFile">Masukan File Berkas</label>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-3">
                <button class="btn btn-icon btn-3 btn-default" type="submit" style="float: right;">
                  <span class="btn-inner--icon"><i class="ni ni-send"></i></span>
                  <span class="btn-inner--text">Tambah Berkas</span>         
                </button>
              </div>
              
            </div>

            
          </form>
            
           

          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid mt--7">
      <!-- Footer -->
      <!-- <footer class="footer">
        <div class="row align-items-center justify-content-xl-between">
          <div class="col-xl-6">
            <div class="copyright text-center text-xl-left text-muted">
              &copy; 2018 <a href="https://www.creative-tim.com" class="font-weight-bold ml-1" target="_blank">Creative Tim</a>
            </div>
          </div>
          <div class="col-xl-6">
            <ul class="nav nav-footer justify-content-center justify-content-xl-end">
              <li class="nav-item">
                <a href="https://www.creative-tim.com" class="nav-link" target="_blank">Creative Tim</a>
              </li>
              <li class="nav-item">
                <a href="https://www.creative-tim.com/presentation" class="nav-link" target="_blank">About Us</a>
              </li>
              <li class="nav-item">
                <a href="http://blog.creative-tim.com" class="nav-link" target="_blank">Blog</a>
              </li>
              <li class="nav-item">
                <a href="https://github.com/creativetimofficial/argon-dashboard/blob/master/LICENSE.md" class="nav-link" target="_blank">MIT License</a>
              </li>
            </ul>
          </div>
        </div>
      </footer> -->
    </div>
  </div>

  <script>
    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    });
  </script>