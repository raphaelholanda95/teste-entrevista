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
            <div id="conteudo">
                <header>
                </header>

                    <?php require_once('routes.php'); ?>

                <footer>
                  <a class="botoes" href="" id="teste">Teste</a>
                  <a class="botoes" href='index.php'>Home</a>
                  <a class="botoes" href='?controller=posts&action=show'>Posts</a>
                  <a class="copyright">© 2017 INSTAGRAM</a>
                </footer>
                <link href="assets/css/style.css" rel="stylesheet"/> 
                <link href="assets/css/font-awesome.css" rel="stylesheet" media="screen" /> 
                <link href="assets/css/bootstrap3.3.7.css" rel="stylesheet" media="screen" /> 
                <script src="assets/js/jquery-3.2.1.min.js"></script>
                <script src="assets/js/jquery.md5.js"></script>
                <script src="assets/js/bootstrap.min.js"></script>
                <script src="assets/js/home.js"></script>
            </div>
        </div>
    </body>
<html>