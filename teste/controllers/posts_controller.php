<?php
  class PostsController {

    public function show() {
      $posts = Post::all();
      require_once('views/posts/show.php');
    }

    public function upload_foto() {
      $retorno = [];
      $token = $_POST['cd_token'];
      $nomeimg = 'image_resized' . rand(1,999999);
      //move_uploaded_file($_FILES['nm_foto']['tmp_name'], 'assets/img/'.$nomeimg);
      $nomeimg = $this->resize(600, $nomeimg, $_FILES['nm_foto']['tmp_name']);
      $retorno = Post::update_foto($token,  $nomeimg);
      echo json_encode($retorno);
      // we store all the posts in a variable
      //$posts = Post::all();
      //require_once('views/posts/index.php');
    }

    private function resize($newWidth, $targetFile, $originalFile) {

      $info = getimagesize($originalFile);
      $mime = $info['mime'];

      switch ($mime) {
              case 'image/jpeg':
                      $image_create_func = 'imagecreatefromjpeg';
                      $image_save_func = 'imagejpeg';
                      $new_image_ext = 'jpg';
                      break;

              case 'image/png':
                      $image_create_func = 'imagecreatefrompng';
                      $image_save_func = 'imagepng';
                      $new_image_ext = 'png';
                      break;

              case 'image/gif':
                      $image_create_func = 'imagecreatefromgif';
                      $image_save_func = 'imagegif';
                      $new_image_ext = 'gif';
                      break;

              default: 
                      throw new Exception('Unknown image type.');
      }

      $img = $image_create_func($originalFile);
      list($width, $height) = getimagesize($originalFile);

      $newHeight = ($height / $width) * $newWidth;
      $tmp = imagecreatetruecolor($newWidth, $newHeight);
      imagecopyresampled($tmp, $img, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

      if (file_exists($targetFile)) {
              unlink($targetFile);
      }
      $image_save_func($tmp, 'assets/img/'.$targetFile.'.'.$new_image_ext);
      return $targetFile.'.'.$new_image_ext;
    }
  }
?>