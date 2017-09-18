<?php
  class Usuario {
    // we define 3 attributes
    // they are public so that we can access them using $post->nm_usuario directly
    public $id_usuario;
    public $nm_usuario;
    public $nm_email;
    private $nm_senha;
    public $nm_foto;


    public function __construct($id_usuario, $nm_nome, $nm_usuario, $nm_email, $nm_senha, $nm_foto) {
      $this->id_usuario      = $id_usuario;
      $this->nm_usuario  = $nm_usuario;
      $this->nm_email = $nm_email;
      $this->nm_foto = $nm_foto;
      $this->nm_senha = null;
    }

    public static function cadastrar($nome,$usuario,$email,$senha){
      $sql  = 'INSERT INTO `tb_usuario` (nm_nome, nm_usuario, nm_email, nm_senha, nm_foto)';
      $sql .= 'VALUES (:nm_nome, :nm_usuario, :nm_email, :nm_senha, \'\')';

      $db = Db::getInstance();
      $query = $db->prepare($sql);

      //$query->bindParam(':id', 0, PDO::PARAM_INT);
      //$senha = md5($senha);
      $query->bindParam(':nm_nome', $nome, PDO::PARAM_STR);
      $query->bindParam(':nm_usuario', $usuario, PDO::PARAM_STR);
      $query->bindParam(':nm_email', $email, PDO::PARAM_STR);
      $query->bindParam(':nm_senha', $senha, PDO::PARAM_STR);
      return $query->execute();
    }

    public static function login($usuario, $senha){
      $retorno = [];
      try {
          $db = Db::getInstance();

          $req = $db->prepare('SELECT id_usuario, nm_nome, nm_usuario, nm_email, nm_foto FROM tb_usuario WHERE nm_usuario = :usuario AND nm_senha = :senha');

          $req->execute(array('usuario' => $usuario, 'senha' => $senha));

          $user = $req->fetch();

          if ($user['id_usuario'] != null){
              $retorno = self::getToken($user['id_usuario']);
          }
      } catch(PDOException $e) {
          $retorno['result'] = false;
          $retorno['msg'] = $e->getMessage();
      }

      return $retorno;
    }

    public static function generateRandomString($length) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    private static function getToken($id_usuario){
      $cd_token = self::generateRandomString(32);
      $retorno = [];
      try {
        $db = Db::getInstance();
        // set the PDO error mode to exception
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "UPDATE tb_usuario SET cd_token = :cd_token, dt_autenticacao = now()  WHERE id_usuario = :id_usuario";
        // Prepare statement
        $query = $db->prepare($sql);

        $query->bindParam(':cd_token', $cd_token, PDO::PARAM_STR);
        $query->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        // echo a message to say the UPDATE succeeded
        $retorno['result'] = $query->execute();
        if ($retorno['result']){

            $id_usuario = intval($id_usuario);

            $req = $db->prepare('SELECT id_usuario, nm_nome, nm_email, nm_foto, cd_token FROM tb_usuario WHERE id_usuario = :id_usuario');

            $req->execute(array('id_usuario' => $id_usuario));

            $user = [];
            $user = $req->fetch();

            if ($user['id_usuario'] != null){
                $retorno['result'] = true;
                $retorno['usuario'] = $user;
            } else {
                $retorno['result'] = false;
            }
        } else {
            $retorno['result'] = false;
        }
      } catch(PDOException $e) {
        $retorno['result'] = false;
        $retorno['msg'] = $e->getMessage();
      }
      return $retorno;
    }

    public static function all() {
      $list = [];
      $db = Db::getInstance();
      $req = $db->query('SELECT id_usuario, nm_nome, nm_email, nm_foto FROM tb_usuario');

      // we create a list of Post objects from the database results
      foreach($req->fetchAll() as $post) {
        $list[] = new Post($post['id_usuario'], $post['nm_nome'], '', $post['nm_email'], '******', $post['nm_foto']);
      }

      return $list;
    }

    public static function find($id_usuario) {
      $db = Db::getInstance();
      // we make sure $id_usuario is an integer
      $id_usuario = intval($id_usuario);
      $req = $db->prepare('SELECT id_usuario, nm_nome, nm_email, nm_foto FROM tb_usuario WHERE id_usuario = :id_usuario');
      // the query was prepared, now we replace :id_usuario with our actual $id_usuario value
      $req->execute(array('id_usuario' => $id_usuario));
      $post = $req->fetch();

      return new Post($post['id_usuario'], $post['nm_nome'], $post['nm_email'], '******', $post['nm_foto']);
    }

    public static function getStatus($token) {
      $db = Db::getInstance();
      $req = $db->prepare('SELECT id_usuario FROM tb_usuario WHERE cd_token = :cd_token AND (UNIX_TIMESTAMP(now()) - UNIX_TIMESTAMP(dt_autenticacao)) <= 60');
      $req->execute(array('cd_token' => $token));
      $usuario = $req->fetch();
      if ($usuario['id_usuario'] != null){
          $retorno['result'] = true;
      } else {
          $retorno['result'] = false;
          $retorno['msg'] = 'Sua sessão expirou!';
      }
      return $retorno;
    }
  }
?>