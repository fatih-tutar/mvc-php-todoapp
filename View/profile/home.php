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
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Your Profile</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <?= get_session('error') ? '<div class="alert alert-'.$_SESSION['error']['type'].'">'.$_SESSION['error']['message'].'</div>' : null ; ?>
              <form id="profile" action="" method="post"> 
                <div class="card-body">
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" value="<?= get_session('name')?>">
                  </div>
                  <div class="form-group">
                    <label for="surname">Surname</label>
                    <input type="text" class="form-control" id="surname" value="<?= get_session('surname')?>">
                  </div>
                  <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="text" class="form-control" id="email" value="<?= get_session('email')?>">
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </form>
            </div>
          </div>
          <div class="col-lg-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Change Your Password</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <?= get_session('error') ? '<div class="alert alert-'.$_SESSION['error']['type'].'">'.$_SESSION['error']['message'].'</div>' : null ; ?>
              <form id="passwordChange" action="" method="post"> 
                <div class="card-body">
                  <div class="form-group">
                    <label for="currentPassword">Current Password</label>
                    <input type="password" class="form-control" id="currentPassword">
                  </div>
                  <div class="form-group">
                    <label for="password">New Password</label>
                    <input type="password" class="form-control" id="newPassword">
                  </div>
                  <div class="form-group">
                    <label for="password">Confirm Password</label>
                    <input type="password" class="form-control" id="confirmPassword">
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </form>
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

<script src="<?= assets('plugins/jquery/jquery.min.js') ?>"></script>
<script src="<?= assets('js/adminlte.min.js') ?>"></script>
<script src="<?= assets('plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?= assets('plugins/sweetalert2/sweetalert2.all.min.js') ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.6.0/axios.min.js" integrity="sha512-WrdC3CE9vf1nBf58JHepuWT4x24uTacky9fuzw2g/3L9JkihgwZ6Cfv+JGTtNyosOhEmttMtEZ6H3qJWfI7gIQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
  
  const todo = document.getElementById('todo');

  todo.addEventListener('submit', (event) => {
    
    let title = document.getElementById('title').value;
    let description = document.getElementById('description').value;
    let category_id = document.getElementById('category_id').value;
    let color = document.getElementById('color').value;
    let progress = document.getElementById('progress').value;
    let status = document.getElementById('status').value;
    let start_date = document.getElementById('start_date').value;
    let end_date = document.getElementById('end_date').value;
    let start_date_time = document.getElementById('start_date_time').value;
    let end_date_time = document.getElementById('end_date_time').value;

    let formData = new FormData();

    formData.append('title',title);
    formData.append('description',description);
    formData.append('category_id',category_id);
    formData.append('color',color);
    formData.append('progress',progress);
    formData.append('status',status);
    formData.append('start_date',start_date);
    formData.append('end_date',end_date);
    formData.append('start_date_time',start_date_time);
    formData.append('end_date_time',end_date_time);

    axios.post('<?= url('api/addtodo') ?>',formData).then(res => {

      if(res.data.redirect){
        window.location.href = res.data.redirect;
      }else{
        Swal.fire(
          res.data.title,
          res.data.msg,
          res.data.status
        );
      }
      
    }).catch(err => console.log(err))

    event.preventDefault();
  })

</script>
</body>
</html>