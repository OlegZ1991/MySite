<?php include_once $_SERVER['DOCUMENT_ROOT'].'/includes/helpers.inc.php'; ?>

<!DOCTYPE html>
<html lang='en'>

 <head>
 <meta charset='utf-8'>
 <title>Результаты поиска</title>
 </head>

 <body>
 <ul>
  <?php foreach($jokes as $joke): ?>
  <li><?php htmlout($joke['joketext']);?></li>
  <?php endforeach; ?>
  </ul>
 </body>

</html>