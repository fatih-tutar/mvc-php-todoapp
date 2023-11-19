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
        <div id="calendar">
        </div>
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <?php view('static/footer'); ?>
</div>
<!-- ./wrapper -->

<script src="<?= assets('plugins/jquery/jquery.min.js') ?>"></script>
<script src="<?= assets('plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?= assets('js/adminlte.min.js') ?>"></script>
<script src="<?= assets('plugins/fullcalendar/locales-all.js') ?>"></script>
<script src="<?= assets('plugins/fullcalendar/main.js') ?>"></script>
<script>

    document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: '<?= default_lang() ?>',
        events: '<?= url('api/calendar') ?>'
    });
    calendar.render();
    });

</script>
</body>
</html>