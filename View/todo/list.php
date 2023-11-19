<?php view('static/header'); ?>
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?= URL.'/logout' ?>" class="nav-link">Sign Out</a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php view('static/sidebar'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper p-3">
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <?php 
              echo get_session('error') ? '<div class="alert alert-'.$_SESSION['error']['type'].'">'.$_SESSION['error']['message'].'</div>' : null ; 
              if($_SESSION['error']) $_SESSION['error'] = null;
            ?>
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Todos</h3>

                <div class="card-tools">
                  <a href="<?= url('todo/add') ?>" class="btn btn-sm btn-dark">Add</a>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Title</th>
                      <th>Category</th>
                      <th>Start Date</th>
                      <th>End Date</th>
                      <th>Progress</th>
                      <th>Status</th>
                      <th style="width: 40px">Process</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($data as $key => $value): ?>
                    <tr id="row_<?=$value['id']?>">
                      <td><?= $value['title'] ?></td>
                      <td><?= $value['category_title'] ?></td>
                      <td><?= $value['start_date'] ?></td>
                      <td><?= $value['end_date'] ?></td>
                      <td>
                        <?= $value['progress'].'%' ?>
                        <div class="progress progress-xs">
                          <div class="progress-bar progress-bar-danger" style="width:<?= $value['progress'] ?>%;"></div>
                        </div>
                      </td>
                      <td>
                        <span class="badge bg-<?= status($value['status'])['color'] ?>"><?= status($value['status'])['title'] ?></span>
                      </td>
                      <td>
                        <div class="btn-group btn-group-sm">
                          <button type="button" class="btn btn-sm btn-dark" onclick="removeTodo('<?= $value['id'] ?>')">Delete</button>
                          <a href="<?= url('todo/edit/'.$value['id']) ?>" class="btn btn-sm btn-light">Update</a>
                        </div>
                      </td>
                    </tr>
                    <?php endforeach ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <?php view('static/footer'); ?>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="<?= assets('plugins/jquery/jquery.min.js') ?>"></script>
<!-- Bootstrap 4 -->
<script src="<?= assets('plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<!-- AdminLTE App -->
<script src="<?= assets('js/adminlte.min.js') ?>"></script><script src="<?= assets('plugins/sweetalert2/sweetalert2.all.min.js') ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.6.0/axios.min.js" integrity="sha512-WrdC3CE9vf1nBf58JHepuWT4x24uTacky9fuzw2g/3L9JkihgwZ6Cfv+JGTtNyosOhEmttMtEZ6H3qJWfI7gIQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>

  function removeTodo(id){
    let formData = new FormData();
    formData.append('id',id);
    axios.post('<?= url('api/removetodo') ?>',formData).then(res => {
      if(res.data.id){
        document.getElementById('row_'+res.data.id).remove()
      }
      Swal.fire(
        res.data.title,
        res.data.msg,
        res.data.status
      );
    }).catch(err => console.log(err))
  }

</script>
</body>
</html>