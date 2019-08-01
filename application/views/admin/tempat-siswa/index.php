<?php if($this->session->flashdata('tambah_siswa') == TRUE) : ?>
<script>
  Swal.fire({
    type: 'success',
    title: 'Berhasil Ditambah!',
    text: '<?php echo $this->session->flashdata('tambah_siswa') ?>'
  }); 
</script>
<?php endif; ?>

<?php if($this->session->flashdata('update_tempat') == TRUE ) : ?>
  <script>
    Swal.fire({
      type: 'success',
      title: 'Update Berhasil!',
      text: '<?php echo $this->session->flashdata('update_tempat') ?>'
    });
  </script>
<?php endif; ?>
<?php if($this->session->flashdata('delete_siswa') == TRUE) : ?>
  <script>
    Swal.fire({
      type: 'success',
      title: 'Hapus Berhasil!',
      text: '<?php echo $this->session->flashdata('delete_siswa') ?>'
    });
  </script>
<?php endif; ?>

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
                  <?php 
                    $cek    = $this->db->query("SELECT * FROM tb_sementara");
                    $baris  = $cek->num_rows();

                    if($baris == 0){
                  ?>
                  <span class="mb-0 text-sm  font-weight-bold">Selamat Datang, <b><?php echo $this->session->userdata('nama') ?></b></span>
                  <?php } else { ?>
                    <span class="mb-0 text-sm  font-weight-bold">*Selamat Datang, <b><?php echo $this->session->userdata('nama') ?></b></span>
                  <?php } ?>
                </div>
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
              <a href="<?php echo base_url('') ?>" class="dropdown-item">
                <i class="ni ni-notification-70"></i>
                <span>Notifikasi (<?php echo $baris; ?>)</span>
              </a>
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
          <form action="<?php echo base_url('admin/tempatSiswa') ?>" method="post">
          <div class="row">

            <div class="col-md-6">
              <h1 class="display-4 text-white text-uppercase">Tabel Tempat Pkl Siswa</h1>
            </div>
         
            <div class="col-md-5">
              <div class="form-group pr">
                <div class="input-group input-group-alternative mb-4">
                  <!-- <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                  </div> -->
                  <input class="form-control form-control-alternative" placeholder="Cari nama siswa" type="text" name="cari" id="cari">
                </div>
              </div>
            </div> 

            <div class="col-md-1 left" style="margin-left: -2%;">
              <button class="btn btn-icon btn-3 btn-info" type="submit" data-toggle="tooltip" data-placement="top" title="Tombol Cari">
                <span class="btn-inner--icon"><i class="ni ni-zoom-split-in"></i></span>                
              </button>
            </div>     

          </div>
          </form>
          
          <!-- Card stats -->
          <div class="card card-stats mb-4 mb-lg-0">
            <div class="card-body">
                <div id="result">
                <div class="table-responsive">
                 
                  <table class="table align-items-center">
                      <thead class="thead-light">
                          <tr>
                              <th scope="col">
                                  No
                              </th>
                              <th scope="col">
                                  Nama Siswa
                              </th>
                              <th scope="col">Foto</th>
                              <th scope="col">
                                  Jurusan
                              </th>
                              <th>Jenis Kelamin</th>
                              
                              <th scope="col">
                                  Nama Perusahaan
                              </th>
                              <th scope="col">Alamat</th>
                              <th scope="col">Cp</th>
                              <th>Aksi</th>
                              
                          </tr>
                      </thead>
                     
                      <tbody class="list">
                          <?php $no = 1; foreach($tempat_siswa as $s): ?>
                          <tr>
                             <td><?php echo $no++; ?></td>
                             <td><?php echo $s->nama_siswa ?></td>
                             <td>      
                                <div class="media align-items-center">
                                  <a href="#" class="avatar rounded-circle mr-3">
                                    <img alt="Image placeholder" src="<?php echo base_url('assets/uploads/profile-siswa/').$s->foto ?>">
                                  </a>        
                                </div>

                              </td>
                              <th scope="row" class="name">
                                  <?php echo $s->jurusan ?>
                              </th>
                              
                              <td class="budget">
                                  <?php echo $s->jk ?>
                              </td>
                              <td class="status">
                                  <span class="badge badge-dot mr-4">
                                    <?php echo $s->nama_perusahaan ?>
                                  </span>
                              </td>
                              
                              <td class="completion">
                                  <div class="d-flex align-items-center">
                                      <span class="mr-2"><?php echo $s->alamat ?></span>                       
                                  </div>
                              </td>

                              <td class="completion">
                                  <div class="d-flex align-items-center">
                                      <span class="mr-2"><?php echo $s->cp ?></span>                       
                                  </div>
                              </td>

                              
                              <td class="text-right">
                                  <div class="dropdown">
                                      <a class="btn btn-sm btn-icon-only text-light" href="" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                      </a>
                                      <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                          <a class="dropdown-item" href="<?php echo base_url('admin/editTempat/').$s->id ?>">Edit</a>
                                          <a class="dropdown-item" href="<?php echo base_url('admin/deleteTempat/').$s->id_siswa ?>" onclick="return confirm('Yakin?')">Hapus</a>
                                          
                                      </div>
                                  </div>
                              </td>
                          </tr>
                          
                          <?php endforeach; ?>
                          
                      </tbody>

                     
                  </table>
              </div>
    </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-10">
                <nav aria-label="Page navigation example" style="margin-top: 2%;">
                  <?php echo $halaman; ?>
                </nav>    
              </div>

              <div class="col-md-2">

                <a href="<?php echo base_url('admin') ?>" class="btn btn-default" style="margin-top: 10%; float: right;">Kembali</a>
              </div>  
            </div>
            

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