<?php
  class Post {
    // we define 3 attributes
    // they are public so that we can access them using $post->nm_usuario directly
    public $nm_nome;
    public $nm_foto;
    public $nm_img;
    public $qtd_curtidas;

    public function __construct($nm_nome, $nm_foto, $nm_img, $curtidas) {
      $this->nm_nome = $nm_nome;
      $this->nm_foto  = $nm_foto;
      $this->nm_img = $nm_img;
      $this->qtd_curtidas = $curtidas;
    }

    public static function all() {
      $list = [];
      $db = Db::getInstance();
      $req = $db->query('SELECT p.nm_img, p.qtd_curtidas as curtidas, u.nm_nome, u.nm_foto FROM tb_post AS p LEFT JOIN tb_usuario AS u ON u.id_usuario = p.id_usuario');

      // we create a list of Post objects from the database results
      foreach($req->fetchAll() as $post) {
        $list[] = new Post($post['nm_nome'], $post['nm_foto'], $post['nm_img'], $post['curtidas']);
      }

      return $list;
    }

    public static function find($cd_token) {
      $db = Db::getInstance();
      $req = $db->prepare('SELECT *,(UNIX_TIMESTAMP() - UNIX_TIMESTAMP(dt_autenticacao)) as segundos_autenticacao FROM tb_usuario WHERE cd_token = :cd_token');
      $req->execute(array('cd_token' => $cd_token));
      return $req->fetch();
    }

    public static function update_foto($cd_token, $nm_foto){
      $retorno = [];
      try {
        $usuario = self::find($cd_token);

        if (isset($usuario['segundos_autenticacao']) && intval($usuario['segundos_autenticacao']) <= 60){

            $db = Db::getInstance();
            // set the PDO error mode to exception
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "UPDATE tb_usuario SET nm_foto = :nm_foto WHERE id_usuario = :id_usuario";
            // Prepare statement
            $query = $db->prepare($sql);

            $query->bindParam(':nm_foto', $nm_foto, PDO::PARAM_STR);
            $query->bindParam(':id_usuario', $usuario['id_usuario'], PDO::PARAM_INT);
            // echo a message to say the UPDATE succeeded
            $retorno['result'] = $query->execute();
            $retorno['msg'] = 'Imagem alterada com sucesso!';
            if ($retorno['result'])
                $retorno['img']=$nm_foto;
            else {

            }
        } else {
          if (isset($usuario['id_usuario'])){
              $retorno['result'] = false;
              $retorno['msg'] = 'Falha ao salvar imagem, sua sessão expirou!';
          } else {
              $retorno['result'] = false;
              $retorno['msg'] = 'Falha ao salvar imagem, usuario não encontrado!';
          }
        }
      } catch(PDOException $e) {
        $retorno['result'] = false;
        $retorno['msg'] = $e->getMessage();
      }
      return $retorno;
    }
  }
?>