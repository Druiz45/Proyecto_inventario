<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      
      <?php require_once("./../views/includes/barraLateral.php"); ?>

      <!-- top navigation -->

      <?php require_once("./../views/includes/barraSuperior.php"); ?>

      <!-- /top navigation -->

      <!-- page content -->
      <div class="right_col" role="main">
        
        
        
      </div>
      <!-- /page content -->

      <!-- footer content -->
      <?php require_once("./../views/includes/footer.php"); ?>
      <!-- /footer content -->
    </div>
  </div>
  <?php require_once("./../views/includes/scripts.php"); ?>
  <script>
        const url = JSON.parse('<?= json_encode(getUrl($_SERVER['SERVER_NAME'])) ?>');
    </script>
     <script src="./assets/build/js/user/index.js" type="module"></script>
</body>