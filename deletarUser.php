<?php
  ob_start();
  session_start();
  if(!isset($_SESSION['loginEmail'])&&(!isset($_SESSION['loginSenha']))){
    header("Location: index.php?acao=negado");
  }
  include_once("sair.php");
?>
<?php

include_once('config/conexao.php');
if(isset($_GET['idDel'])){
   $id = ($_GET['idDel']);
  // echo $id;
  $deletar = "DELETE FROM Usuarios WHERE id_usuario = :id";
  try{
      $result = $conect->prepare($deletar);
      $result->bindParam(':id',$id,PDO::PARAM_INT);
      $result->execute();
      $contar = $result->rowCount();
      if($contar>0){
          header("Location: usuarios.php");
      }else{
        header("Location: usuarios.php");
      }

  }catch(PDOException $e){
      echo "<strong>ERRO AO DELETAR: </strong>".$e->getMessage();
  }

}
?>