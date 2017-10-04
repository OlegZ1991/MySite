<?php include_once $_SERVER['DOCUMENT_ROOT'].'/includes/helpers.inc.php'; ?>

<!DOCTYPE html>
<html lang='en'>

 <head>
 <meta charset='utf-8'>
 <title>Система поиска шуток</title>
 </head>

 <body>
  <a href='?add'>Добавить шутку</a>
 <form action='' method='get'>
  <div>
   <select name='author'>
     <option value=''>Любой автор</option>
    <?php foreach($authors as $author):?>
     <option value='<?php htmlout($author['id']); ?>'>
	  <?php htmlout($author['name']); ?>
	 </option>
    <?php endforeach; ?>
   </select>
  </div>
  <div>
   <select name='category'>
     <option value=''>Любая категория</option>
    <?php foreach($categories as $category):?>
     <option value='<?php htmlout($category['id']); ?>'>
      <?php htmlout($category['name']); ?>
     </option>
    <?php endforeach; ?>
   </select>
  </div>
   <div>
   <input type='text' name='text'>
   </div>
      <div>
   <input type='hidden' name='action' value='search'>
   <input type='submit' value='искать'>
   </div>
 </form>
 <a href='..'>Вернуться на главную страницу</a>
 </body>

</html>