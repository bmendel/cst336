<?php
  include './inc/function_Antonio.php';
  include './inc/function_Maryann.php';
  include './inc/function_Brandon.php';
  include './inc/function_Brett.php';
  include './inc/function_John.php';
?>

<!DOCTYPE html>
<html>
    <head>
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat"/>
      <link rel="stylesheet" type="text/css" href="./css/styles.css"/>
      <title>SilverJack</title>
    </head>
    <body>
      <header><h1>SilverJack</h1></header>
        <?php
          //global $playerNames;
          $moreThanOneWinner=false;
          $deck = new Deck();
          $totals = array();
          
          play();
        ?>
    </body>
</html>