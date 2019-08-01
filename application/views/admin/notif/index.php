<?php

if ($this->session->flashdata('kirim_pesan') == TRUE) : ?>
  <script>
    Swal.fire({
      type: "success",
      title: "Pesan Terkirim!",
      text: "<?php echo $this->session->flashdata('kirim_pesan') ?>"
    });
  </script>
<?php endif;
if ($this->session->flashdata('oke') == TRUE) : ?>

  <script>
    Swal.fire({
      type: "success",
      title: "<?= $this->session->flashdata('oke') ?>"
    })
  </script>

<?php endif; ?>
<div class="main-content">
  <!-- Navbar -->
  <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
    <div class="container-fluid">
      <!-- Brand -->
      <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="">Dashboard</a>

      <!-- User -->
      <ul class="navbar-nav align-items-center d-none d-md-flex">
        <li class="nav-item dropdown">
          <a class="nav-link pr-0" href="" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="media align-items-center">

              <div class="media-body ml-2 d-none d-lg-block">
                <?php
                $cek    = $this->db->get('tb_sementara');
                $baris  = $cek->num_rows();

                if ($baris == 0) {
                  ?>
                  <span class="mb-0 text-sm  font-weight-bold">Selamat Datang, <b><?php echo $this->session->userdata('nama') ?></b></span>
                <?php } else { ?>
                  <span class="mb-0 text-sm  font-weight-bold">*Selamat Datang, <b><?php echo $this->session->userdata('nama') ?></b></span>
                <?php } ?>
              </div>
            </div>
          </a>
          <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
            <a href="<?php echo base_url('admin/notif') ?>" class="dropdown-item">
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
  <div class="header bg-gradient-info pt-5 pt-md-8">
    <div class="row">
      <div class="col-md-6 ml-4">
        <div class="alert alert-default" role="alert">
          Anda memiliki <strong><?php echo $baris; ?></strong> pemberitahuan.
        </div>
      </div>
    </div>
  </div>

  <div class="card card-stats mb-4 mb-lg-0">
    <div class="card-body">
      <div id="result">
        <div class="table-responsive">
          <div class="card-header border-0">
            <h3>Daftar Notifikasi</h3>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
              <span class="alert-inner--icon"><i class="ni ni-air-baloon"></i></span>
              <span class="alert-inner--text"><strong>Peringatan!</strong> Pastikan jurusan siswa sesuai dengan jurusan yang di butuhkan perusahaan!</span>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          </div>
          <table class="table align-items-center">
            <thead class="thead-light">
              <tr>
                <th scope="col">
                  No
                </th>
                <th scope="col">
                  Nama Siswa
                </th>
                <th scope="col">
                  Jurusan
                </th>
                <th scope="col">
                  Nama Perusahaan
                </th>
                <th scope="col">
                  Nama Pimpinan
                </th>
                <th scope="col">
                  Jurusan yang di butuhkan
                </th>
                <th scope="col">Bukti</th>

                <th scope="col text-right">
                  Aksi
                </th>
                <th scope="col"></th>
              </tr>
            </thead>

            <tbody class="list">
              <?php $no = 1;
              foreach ($notif as $n) : ?>
                <tr>
                  <td>
                    <?php echo $no++ ?>
                  </td>
                  <th scope="row" class="name">
                    <?php echo $n->nama_siswa ?>
                  </th>
                  <td class="budget">
                    <?php echo $n->jurusan ?>
                  </td>
                  <td class="budget">
                    <?php echo $n->nama_perusahaan ?>
                  </td>
                  <td>
                    <?= $n->nama_pimpinan ?>
                  </td>
                  <td>
                    <?php
                    $joy = $n->id;
                    $coy = $this->db->query("SELECT * FROM tb_sementara WHERE id = '$joy' ");
                    $cow = $coy->row();
                    $rek = $cow->jurusan_perusahaan;
                    $ho  = $n->nama_siswa;
                    $si  = $this->db->query("SELECT * FROM tb_siswa WHERE nama_siswa = '$ho' ");
                    $oi  = $si->row();
                    $bb  = $oi->id_siswa;

                    if ($rek != "") {
                      echo $n->jurusan_perusahaan;
                    } else {
                      echo "Bukan Perusahaan Rekomendasi Sekolahan";
                    }

                    ?>
                  </td>
                  <td>
                    <a href="<?php echo base_url('admin/unduh/') . $n->bukti ?>" class="btn-sm btn-info">Unduh</a>
                  </td>

                  <td>
                    <a href="<?= base_url('admin/taOke/' . $bb) ?>" class="btn-sm btn-success">Oke</a>
                    <a href="<?php echo base_url('admin/tolakRekomen/') . $n->id ?>" class="btn-sm btn-danger">Tidak</a>

                  </td>
                </tr>

              <?php endforeach; ?>


            </tbody>


          </table>
        </div>
      </div>
    </div>
  </div>

</div>