<?php
  function call($controller, $action) {
    require_once('controllers/' . $controller . '_controller.php');

    switch($controller) {
      case 'pages':
        $controller = new PagesController();
      break;
      case 'posts':
        require_once('models/post.php');
        require_once('class.upload.php');
        $controller = new PostsController();
      break;
      case 'usuario':
        require_once('models/usuario.php');
        $controller = new UsuariosController();

      break;
    }

    $controller->{ $action }();
  }

  $controllers = array('pages' => ['home', 'error'],
                       'posts' => ['upload_foto', 'show'],
                       'usuario' => ['index', 'cadastrar', 'login', 'teste', 'status']);

  if (array_key_exists($controller, $controllers)) {
    if (in_array($action, $controllers[$controller])) {
      call($controller, $action);
    } else {
      call('pages', 'error');
    }
  } else {
    call('pages', 'error');
  }
?>