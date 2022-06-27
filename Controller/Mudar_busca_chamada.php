<?php
session_start();
include "../Model/Conexao.php";
include '../Model/Setor.php';
include '../Model/Escola.php';
include '../Model/Chamada.php';

try {
    $result="";
    
    $usuario_id = $_GET['usuario_id'];
    $setor_id = $_GET['setor_id'];

    if ($usuario_id == 0) {

      $setor_nome = "";
      $quant_novos = 0;
      $quant_andamento= 0;
      $quant_atrasado = 0;
      $quant_finalizado = 0;
      $res_nome_setor = buscar_setor_id($conexao,$setor_id);
      foreach ($res_nome_setor as $key => $value) {
        $setor_nome = $value['nome'];
      }
      $res_setor_usuario = buscar_funcionario_setor($conexao,$setor_id);
      foreach ($res_setor_usuario as $key => $value) {
        $id_funcionario = $value['funcionario_id'];
        $res_nome_usuario = nome_funcionario($conexao,$id_funcionario);
        foreach ($res_nome_usuario as $key => $value) {
          $nome = $value['nome'];
          $result.=" <div class='col-md-4'>
          <div class='card card-widget widget-user-2'>
          <div class='widget-user-header bg-secondary'>
            <h3 class='widget-user-username'>$nome</h3>
            <h5 class='widget-user-desc'><b>$setor_nome</b></h5>
            </div>
            <div class='card-footer p-0'>
            <ul class='nav flex-column'>
              <li class='nav-item'>
                <p style='text-align: center;'>";
          $res_setor = buscar_setor_funcionario($conexao,$id_funcionario);
          foreach ($res_setor as $key => $value) {
              $id_setor = $value['setor_id'];
              $res_setores_presentes = buscar_setor_id($conexao,$id_setor);
              foreach ($res_setores_presentes as $key => $value) {
               $nome_setor = $value['nome'];
               $result.=" <b> $nome_setor </b><br>";
              }
              
          }
          $res_novos =quant_novos_usuario($conexao,$id_funcionario);
          foreach ($res_novos as $key => $value) {
              $quant_novos = $value['chamadas'];
          }
          $res_andamento = quant_andamento_usuario($conexao,$id_funcionario);
          foreach ($res_andamento as $key => $value) {
              $quant_andamento= $value['chamadas'];
          }
          $res_atrasado =quant_atrasado_usuario($conexao,$id_funcionario);
          foreach ($res_atrasado as $key => $value) {
                $quant_atrasado = $value['chamadas'];
          }
          $res_finalizado = quant_finalizado_usuario($conexao,$id_funcionario);
          foreach ($res_finalizado as $key => $value) {
               $quant_finalizado = $value['chamadas'];
          }
          $result.="
                    </p>
                  </li>
                  <li class='nav-item'>
                    <a href='#' class='nav-link'>
                      Novo(s) <span class='float-right badge bg-primary'>$quant_novos</span>
                    </a>
                  </li>
                  <li class='nav-item'>
                    <a href='#' class='nav-link'>
                      Andamento <span class='float-right badge bg-warning'>$quant_andamento</span>
                    </a>
                  </li>
                  <li class='nav-item'>
                    <a href='#' class='nav-link'>
                      Atrasado(s) <span class='float-right badge bg-danger'>$quant_atrasado</span>
                    </a>
                  </li>
                  <li class='nav-item'>
                    <a href='#' class='nav-link'>
                      Finalizados <span class='float-right badge bg-success'>$quant_finalizado</span>
                    </a>
                  </li>
                </ul>
              </div>
            </div>

          </div>";
        }
      }
    }else{
      $setor_nome = "";
      $quant_novos = 0;
      $quant_andamento= 0;
      $quant_atrasado = 0;
      $quant_finalizado = 0;
      $res_nome_setor = buscar_setor_id($conexao,$setor_id);
      foreach ($res_nome_setor as $key => $value) {
          $setor_nome = $value['nome'];
      }


      $res_nome_usuario = nome_funcionario($conexao,$usuario_id);
      foreach ($res_nome_usuario as $key => $value) {
        $nome = $value['nome'];
        $result.=" <div class='col-md-4'>
        <div class='card card-widget widget-user-2'>
          <div class='widget-user-header bg-secondary'>
            <h3 class='widget-user-username'>$nome</h3>
            <h5 class='widget-user-desc'><b>$setor_nome</b></h5>
            </div>
            <div class='card-footer p-0'>
            <ul class='nav flex-column'>
              <li class='nav-item'>
                <p style='text-align: center;'>";
      }
      
      $res_setor = buscar_setor_funcionario($conexao,$usuario_id);
      foreach ($res_setor as $key => $value) {
          $id_setor = $value['setor_id'];
          $res_setores_presentes = buscar_setor_id($conexao,$id_setor);
          foreach ($res_setores_presentes as $key => $value) {
           $nome_setor = $value['nome'];
           $result.=" <b> $nome_setor </b><br>";
          }
          
      }
      $res_novos =quant_novos_usuario($conexao,$usuario_id);
      foreach ($res_novos as $key => $value) {
          $quant_novos = $value['chamadas'];
      }
      $res_andamento = quant_andamento_usuario($conexao,$usuario_id);
      foreach ($res_andamento as $key => $value) {
          $quant_andamento= $value['chamadas'];
      }
      $res_atrasado =quant_atrasado_usuario($conexao,$usuario_id);
      foreach ($res_atrasado as $key => $value) {
            $quant_atrasado = $value['chamadas'];
      }
      $res_finalizado = quant_finalizado_usuario($conexao,$usuario_id);
      foreach ($res_finalizado as $key => $value) {
           $quant_finalizado = $value['chamadas'];
      }
      $result.="
                </p>
              </li>
              <li class='nav-item'>
                <a href='#' class='nav-link'>
                  Novo(s) <span class='float-right badge bg-primary'>$quant_novos</span>
                </a>
              </li>
              <li class='nav-item'>
                <a href='#' class='nav-link'>
                  Andamento <span class='float-right badge bg-warning'>$quant_andamento</span>
                </a>
              </li>
              <li class='nav-item'>
                <a href='#' class='nav-link'>
                  Atrasado(s) <span class='float-right badge bg-danger'>$quant_atrasado</span>
                </a>
              </li>
              <li class='nav-item'>
                <a href='#' class='nav-link'>
                  Finalizados <span class='float-right badge bg-success'>$quant_finalizado</span>
                </a>
              </li>
            </ul>
          </div>
        </div>

      </div>";
    }
    

    
    
    echo "$result";
    
} catch (Exception $exc) {
   //echo " VERIFIQUE SUA CONEXÃO COM A INTERNET";
   echo $exc;
}
?>