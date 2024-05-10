<?php
session_start();
$resultado = '';
$_SESSION['historico'] = array();

if (isset($_POST['operacao'])) {
  $num1 = (float) $_POST['num1'];
  $num2 = (float) $_POST['num2'];
  $operacao = $_POST['operacao'];

  switch ($operacao) {
    case '+':
      $resultado = $num1 + $num2;
      break;
    case '-':
      $resultado = $num1 - $num2;
      break;
    case '*':
      $resultado = $num1 * $num2;
      break;
    case '/':
      if ($num2!= 0) {
        $resultado = $num1 / $num2;
      } else {
        $resultado = 'Erro: Divisão por zero!';
      }
      break;
    case 'potencia':
      $resultado = pow($num1, $num2);
      break;

    case 'fatoracao':
      $i = 2;
      if ($num1 >= 0 && floor($num1) == $num1) {
        $resultado = 1;
        for (; $i <= $num1; $i++) {
          $resultado *= $i;
        }
      } else {
        $resultado = 'Erro: A fatoração é definida apenas para números inteiros não negativos!';
      }
      break;

      // Armazenar a operação no histórico, e falta a funcionalizade do botão M, salvar, historico e apagar
    $_SESSION['historico'][] = "$num1 {$_POST['operacao']} $num2 = $resultado";
  }
}
?>

<!-- HTML e CSS aqui -->
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Calculadora</title>
  <style>
    body {
      font-family: 'Open Sans', sans-serif;
      background-color: #5F7161;
    }
.container {
      max-width: 400px;
      margin: 30px left;
      padding: 10px;
      background-color: #E5E4CC;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .containerhistorico {
      max-width: 400px;
      margin: 30px right;
      padding: 10px;
      background-color: #E5E4CC;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
.calculator {
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 20px;
    }
    input[type="number"] {
      width: 100%;
      height: 30px; 
      margin-bottom: 20px;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
      font-size: 18px;
    }
    select {
      width: 100%; 
      height: 30px; 
      margin-bottom: 20px;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
      font-size: 18px;
    }
    button[type="submit"] {
      width: 100%;
      height: 40px;
      background-color: #171010;
      color: #fff;
      padding: 10px;
      border: 5px;
      border-radius: 10px;
      cursor: pointer;
      font-size: 18px;
      margin-bottom: 10px;
    
    }
    button[type="submit"]:hover {
      background-color: #2a2b2e;
    }
.result {
      font-size: 24px;
      font-weight: bold;
      color: #171010;
      margin-top: 20px;
    }
  </style>
</head>
<body>
  <div class="container"> <!-- Container da calculadora -->
    <div class="calculator">
      <form action="" method="post">
        <label for="num1">Número 1:</label>
        <input type="number" id="num1" name="num1" required>

        <label for="operacao">Operação:</label>
        <select id="operacao" name="operacao" required>
          <option value="+">+</option>
          <option value="-">-</option>
          <option value=""></option>
          <option value="/">/</option>
          <option value="potencia">x^y</option>
          <option value="fatoracao">!n</option>
        </select>

        <label for="num2">Número 2:</label>
        <input type="number" id="num2" name="num2" required>

       <div>
        <div>
            <button type="submit">Calcular</button> <!-- Botao calcular -->
        </div> 
        <div>
       <button type="submit">Salvar</button> <!-- botão salvar -->
       </div>
        <div>
        <button type="submit">M</button> <!-- botão m -->
        </div>
        <div>
        <button type="submit">Histórico</button> <!-- botão historico -->
        </div>
        <div>
         <button type="submit">Apagar Histórico</button> <!-- botão apagar historico -->
        </div>
      
       </div> 
      </form>
      <?php if (!empty($resultado)) {?>
        <p class="result">O resultado é: <?= $resultado?></p>
      <?php }?>
    </div>
  </div>

  <div class="containerhistorico"> <!-- Container do Histórico, nao funcionando!!! -->
  Histórico:
        <?php if (!empty($_SESSION['historico'])):?>
            <ul>
                <?php foreach ($_SESSION['historico'] as $entry):?>
                    <li><?= $entry?></li>
                <?php endforeach;?>
            </ul>
        <?php endif;?>
  
<div> 
  </div>
</body>
</html>