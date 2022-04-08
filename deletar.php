<?php

include_once('config/conexao.php');
if(isset($_GET['idDel'])){
   $id = ($_GET['idDel']);
  // echo $id;
  $deletar = "DELETE FROM tb_contato WHERE id_contato = :id";
  try{
      $result = $conect->prepare($deletar);
      $result->bindParam(':id',$id,PDO::PARAM_INT);
      $result->execute();
      $contar = $result->rowCount();
      if($contar>0){
          header("Location: relatorio.php");
      }else{
        header("Location: relatorio.php");
      }

  }catch(PDOException $e){
      echo "<strong>ERRO AO DELETAR: </strong>".$e->getMessage();
  }

}