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
  <div class="content-wrapper p-2">
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <h5 class="mt-4 mb-2">Your Current Status <code><?= date('Y-m-d') ?></code></h5>
        <div class="row">
          <?php foreach($data['todos'] as $item): ?>
          <div class="col-md-4 col-sm-6 col-12">
            <div class="info-box bg-<?= status($item['status'])['color'] ?>">
              <span class="info-box-icon"><i class="<?= status($item['status'])['icon'] ?>"></i></span>

              <div class="info-box-content">
                <span class="info-box-text"><?= status($item['status'])['title'] ?></span>
                <span class="info-box-number"><?= $item['statusSum'] ?></span>

                <div class="progress">
                  <div class="progress-bar" style="width: <?= $item['generalSum'] ?>%"></div>
                </div>
                <span class="progress-description">
                <?= number_format($item['generalSum'],2) ?>%
                </span>
              </div>
            </div>
          </div>
          <?php endforeach ?>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="timeline">
              <?php foreach($data['workingTodos'] as $item): ?>
              <div class="time-label">
                <span class="bg-red"><?= date('d/m/Y',strtotime($item['start_date'])) ?></span>
              </div>
              <div>
                <i class="fas fa-check" style="background-color:<?= $item['color'] ?>;"></i>
                <div class="timeline-item">
                  <span class="time"><i class="fas fa-clock"></i><?= date('H:i',strtotime($item['start_date'])) ?></span>
                  <h3 class="timeline-header"><span class="badge bg-success"><?= $item['category_title'] ?></span> <?= $item['title'] ?></h3>
                  <div class="timeline-body">
                    <?= $item['description'] ?>
                    <hr/>
                    <?= $item['progress'].'%' ?>
                    <div class="progress progress-xs">
                      <div class="progress-bar progress-bar-danger" style="width:<?= $item['progress'] ?>%;"></div>
                    </div>
                  </div>
                  <div class="timeline-footer">
                    <a href="<?= url('todo/edit/'.$item['id']) ?>" class="btn btn-primary btn-sm">Read more</a>
                  </div>
                </div>
              </div>
              <?php endforeach ?>
              <div>
                <i class="fas fa-clock bg-gray"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php view('static/footer'); ?>
</div>
<script src="<?= assets('plugins/jquery/jquery.min.js') ?>"></script>
<script src="<?= assets('plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?= assets('js/adminlte.min.js') ?>"></script>
</body>
</html>