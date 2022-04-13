<?php
  ob_start();
  session_start();
  if(isset($_SESSION['loginEmail'])&&isset($_SESSION['loginSenha'])){
    header("Location: home.php");
  }
?>
<!DOCTYPE html>
<html lang="pt_br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Agenda JMF | Login</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
  </head>
  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="../../index2.html"><b>Agenda</b>JMF</a>
      </div>
      <div class="card">
        <div class="card-body login-card-body">
          <p class="login-box-msg">Faça login para cadastrar os contatos</p>
          <form action="" method="post">
            <div class="input-group mb-3">
              <input type="email" class="form-control" placeholder="Digite seu E-mail..." name="email">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="password" class="form-control" placeholder="Digite sua senha..." name="senha">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <button name="btnlogin" type="submit" class="btn btn-primary btn-block">Acessar Agenda</button>
              </div>
            </div>
          </form>
          <?php
            include_once("config/conexao.php");
            if(isset($_GET['acao'])){
              $acao = $_GET['acao'];
              //echo $acao;
              if($acao=='negado'){
                echo '<br><div class="container">
                  <div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  Você não tem permissão para acessar a agenda.  
                  Faça um Login
                  </div>
                  </div>';
                  header('Refresh: 4, index.php');
              }else if($acao="sair"){
                  echo '<br><div class="container">
                    <div class="alert alert-warning alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    Você saiu da Agenda Eletônica
                    </div>
                    </div>';
                    header('Refresh: 4, index.php');
              }
            }
            if(isset($_POST['btnlogin'])){
              $email = $_POST['email'];
              $senha = base64_encode($_POST['senha']);
              $select = "SELECT * FROM Usuarios WHERE email_usuario=:emailLogin AND senha_usuario=:senhaLogin";
              try{
                $resultLogin = $conect->prepare($select);
                $resultLogin->bindParam(':emailLogin',$email,PDO::PARAM_STR);
                $resultLogin->bindParam(':senhaLogin',$senha,PDO::PARAM_STR);
                $resultLogin->execute();
                
                $verificar = $resultLogin->rowCount();
                if($verificar>0){
                  $email = $_POST['email'];
                  $senha = $_POST['senha'];

                  $_SESSION['loginEmail'] = $email;
                  $_SESSION['loginSenha'] = $senha;

                  echo '<br><div class="container">
                    <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    Você será redirecionado para a Agenda
                    </div>
                    </div>';
                    header('Refresh: 3, index.php');
                }else{
                  echo "Email ou senha incorreta!";
                }
              }catch(PDOException $e){
                echo "Erro de Login >> ".$e->getMessage();
              }
            }
          ?>
      <p style="margin-top:20px; text-align:center" class="mb-0">
        <a href="registro.php" class="text-center">Cadastro para novo usuário</a>
      </p>
    </div>
  </div>
</div>
<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>