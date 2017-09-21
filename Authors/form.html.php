<?php include_once $_SERVER['DOCUMENT_ROOT'].'/includes/helpers.inc.php'; ?>

<!DOCTYPE html>
<html lang='en'>
 <head>
  <meta charset='utf-8'>
  <title><?php htmlout($pagetitle); ?></title>
 </head>
 <body>
  <h1><?php htmlout($pagetitle); ?></h1>
  <form action="?<?php htmlout($action); ?>" method="post"><!--Здесь редактор ошибочно интерпретирует закрывающую скобку PHP-кода как 
  закрывающую скобку всей формы, в результате чего строка с объявлением метода post не попадает в поле атрибутов тега form. Из-за этого переменная попадает не в переменную $_POST, а в $_GET-->
   <div><label for='name'>Имя: <input name='name' id='name' type='text' value='<?php htmlout($name); ?>'></label></div>
   <div><label for='mail'>Почта: <input name='mail' id='mail' type='text' value='<?php htmlout($mail); ?>'></label></div>
   <div><input type='hidden' name='id' value='<?php htmlout($id); ?>'></div>
   <div><input type='submit' value='<?php htmlout($button); ?>'></div>
  </form>
 </body>
</html>
