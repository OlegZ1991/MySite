<?php include_once $_SERVER['DOCUMENT_ROOT'].'/includes/helpers.inc.php'; ?>

<!DOCTYPE html>
<html lang='en'>
 <head>
  <meta charset='utf-8'> 
  <title><?php htmlout($pagetitle); ?></title>
  <style type="text/css">
    textarea {display: block; width: 100%;}
    </style>
 </head>
 <body>
  <h1><?php htmlout($pagetitle); ?></h1>
  <label for='text'><b>Введите сюда свою шутку:</b></label>
  <form action='?<?php htmlout($action); ?>' method='post'>
   <textarea id="text" name="text" rows="3" cols="40"><?php htmlout($text); ?></textarea>
   <div>
   <label for='author'>Автор:</label>
    <select name='author' id='author'>
    <option value=''>выбрать автора</option>
	<?php foreach($authors as $author): ?>
	<option value='<?php htmlout($author['id']); ?>'
	<?php if($author['id']==$authorid)
	{
		echo ' selected';
	} 
	?>><?php htmlout($author['name']); ?>
	</option>
	<?php endforeach; ?>
	</select>
	</div>
	<div>
	<fieldset>
	 <legend>Категории</legend>
	 <?php foreach($categories as $category): ?>
	 <div><input type='checkbox' name='categories[]' value='<?php htmlout($category['id']); 
	 ?>' <?php if($category['selected'])
	 {
		echo ' checked';
	 }
	 ?>><?php htmlout($category['name']); ?></div>
	 <?php endforeach; ?>
	</fieldset>
	</div>
	<div>
	 <input type='hidden' name='id' value='<?php htmlout($id); ?>'>
	 <input type='submit' value='<?php htmlout($button); ?>'>
	</div>
  </form>
 </body>
</html>