<?php
  require_once('connection.php');

  $type = null;

  if (isset($_GET['controller']) && isset($_GET['action'])) {
    $controller = $_GET['controller'];
    $action     = $_GET['action'];
  } elseif (isset($_POST['controller']) && isset($_POST['action'])) {
    $controller = $_POST['controller'];
    $action     = $_POST['action'];
  } elseif (isset($_GET['controller'])) {
    $controller = $_GET['controller'];
  } else {
    $controller = 'pages';
    $action     = 'home';
  }

  if (isset($_GET['type'])){
      $type = isset($_GET['type']);
  }

  if ($action != 'upload_foto'){
      if (isset($_GET['cd_token'])){
          echo '<input class="hide" name="cd_token" id="cd_token" value="' . $_GET['cd_token'] . '" />';
      } elseif (isset($_POST['cd_token'])){
          echo '<input class="hide" name="cd_token" id="cd_token" value="' . $_POST['cd_token'] . '" />';
      } 
  }

  if ($type == null) {
      if ($action == 'show' && $controller == 'posts')
  	      require_once('views/layout2.php');
      else
          require_once('views/layout.php');
  } else {
  	  require_once('routes.php');
  }

?>