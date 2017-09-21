<?php include_once $_SERVER['DOCUMENT_ROOT'].'/includes/helpers.inc.php'; ?>

<!DOCTYPE html>
<html lang='en'>
 <head>
  <meta charset='utf-8'>
  <title>Перечень категорий</title>
 </head>
 <body>
 <ul>
   <?php foreach($categories as $category): ?>
    <li>
    <form action="" method="post">
		 <?php htmlout($category['name']); ?>
	  <input type='submit' name='action' value='Удалить'>
	  <input type='hidden' name='id' value=<?php htmlout($category['id']); ?>>
	</form>
	</li>
   <?php endforeach; ?>
   </ul>
 </body>
</html>