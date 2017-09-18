<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Home</title>
    </head>
    <body align="center">
        <div id="container" align="center">
            <form  enctype="multipart/form-data" id="upload_form" role="form" method="POST">
            <header>
                <img class="icone3" src="assets/img/icone3.png"/>
                <div class="busca">
                    <input name="busca" placeholder="Busca" type="text"/>
                </div>
                <div class="icones">
                    <input type="file" id="nm_foto" class="hide"><br>
                    <label for="nm_foto" class="icone4 alterar-foto">
                        <?php  
                            if (isset($_GET['nm_foto'])){
                                $foto = $_GET['nm_foto'];
                            } elseif (isset($_POST['nm_foto'])) {
                                $foto = $_POST['nm_foto'];
                            }
                            echo '<img style="border-radius: 50%;width: 30px !important;height: 29px !important;" src="assets/img/' . (isset($foto) && file_exists('assets/img/'.$foto) ? $foto : 'icone4.png') . '"/>';
                        ?>
                    </label>
                    <img class="icone1" src="assets/img/icone1.png"/>
                    <a href="./">
                        <img class="icone2" src="assets/img/icone2.png"/>
                    </a>
                </div>
            </header>
            <div id="conteudo">
                    <?php require_once('routes.php'); ?>

                <!--footer>
                  <a class="botoes" href="" id="teste">Teste</a>
                  <a class="botoes" href='index.php'>Home</a>
                  <a class="botoes" href='?controller=posts&action=index'>Posts</a>
                  <a class="copyright">© 2017 INSTAGRAM</a>
                </footer-->
                <link href="assets/css/style-posts.css" rel="stylesheet"/> 
                <link href="assets/css/font-awesome.css" rel="stylesheet" media="screen" /> 
                <link href="assets/css/bootstrap3.3.7.css" rel="stylesheet" media="screen" /> 
                <script src="assets/js/jquery-3.2.1.min.js"></script>
                <script src="assets/js/jquery.md5.js"></script>
                <script src="assets/js/bootstrap.min.js"></script>
                <script src="assets/js/show.js"></script>
            </div>
            </form>
        </div>
    </body>
<html>