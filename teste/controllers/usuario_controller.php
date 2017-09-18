<?php
    class UsuariosController {

        private $nome = '';
        private $usuario = '';
        private $email = '';
        private $id = '';
        private $senha = '';

        public function __construct(){

        }

        public function index() {
            //$data = json_decode($data);
            //require_once('views/pages/home.php');
            //$teste = 'teste'+json_encode('$teste_' . $teste_ .  '<br>$_POST' . $_POST.  '<br>$_GET' . $_GET);

            echo json_encode($_POST);

        }

        public function testDadosCadastrar(){
            $retorno = null;
            $retorno['msg'] = 'Sucesso!';
            $retorno['result'] = true;
            if (empty($_POST['nm_email'])){
                $retorno['msg'] = 'Digite o seu Email!';
                $retorno['result'] = false;
            } elseif (empty($_POST['nm_nome'])){
                $retorno['msg'] = 'Digite o seu Nome Completo!';
                $retorno['result'] = false;
            } elseif (empty($_POST['nm_usuario'])){
                $retorno['msg'] = 'Digite um Nome de Usuario!';
                $retorno['result'] = false;
            } elseif (empty($_POST['nm_senha'])){
                $retorno['msg'] = 'Digite uma senha!';
                $retorno['result'] = false;
            } 
            return $retorno;
        }

        public function cadastrar(){
            $retorno = [];
            $teste = $this->testDadosCadastrar();
            if($teste['result'] == true){
                $retorno['result'] = Usuario::cadastrar($_POST['nm_nome'], $_POST['nm_usuario'], $_POST['nm_email'], $_POST['nm_senha']);
                if ($retorno['result'] === true){
                    $retorno['msg'] = 'Usuario cadastrado com sucesso!';   
                } else {
                    $retorno['msg'] = 'Falha ao cadastrar usuario!';   
                }
            }else {
                $retorno = $teste;
            }
            echo json_encode($retorno);
        }

        public function testLogin(){
            $retorno = null;
            $retorno['msg'] = 'Sucesso!';
            $retorno['result'] = true;
            if (empty($_POST['nm_usuario'])){
                $retorno['msg'] = 'Digite o seu Nome de Usuario!';
                $retorno['result'] = false;
            } elseif (empty($_POST['nm_senha'])){
                $retorno['msg'] = 'Digite a sua senha!';
                $retorno['result'] = false;
            } 
            return $retorno;
        }

        public function login(){
            $retorno = [];
            $teste = $this->testLogin();
            if($teste['result'] == true){   
                $retorno = Usuario::login($_POST['nm_usuario'], $_POST['nm_senha']);
                if (isset($retorno['result']) && $retorno['result'] === true){
                    $retorno['msg'] = 'Usuario autenticado com sucesso!';
                } else {
                    $retorno['result'] = false;
                    $retorno['msg'] = 'Falha na autenticação, por favor tente novamente!';
                }
            }else {
                $retorno = $teste;
            }
            echo json_encode($retorno);
        }

        public function status(){
            echo json_encode(Usuario::getStatus($_POST['token']));
        }
    }
?>