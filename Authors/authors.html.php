<?php include_once $_SERVER['DOCUMENT_ROOT'].'/includes/helpers.inc.php'; ?>

<!DOCTYPE html>
<html lang='en'>
 <head>
  <meta charset='utf-8'>
  <title>Все авторы</title>
 </head>
 <body>
  <h1>Вот все авторы</h1>
  <a href="?add">Добавить нового автора</a>
  <ul>
   <?php foreach($authors as $author): ?>
    <li>
	 <form action="" method="post">
	  <div>
       <?php htmlout($author['authorname']); ?>
	   <?php htmlout($author['mail']); ?>
	   <input type="hidden" name="id" value="<?php htmlout($author['id']); ?>">
	   <input type="submit" name="action" value="редактировать">
	   <input type="submit" name="action" value="удалить">
	  </div>
	 </form>
    </li>
   <?php endforeach; ?>
  </ul>
  <a href="..">На главную страницу</a>
 </body>
</html>
