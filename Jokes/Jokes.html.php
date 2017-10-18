<?php include_once $_SERVER['DOCUMENT_ROOT'].'/includes/helpers.inc.php'; ?>

<!DOCTYPE html>
<html lang='en'>
 <head>
 <meta charset='utf-8'>
 <title>Результаты поиска</title>
 </head>
 <body>
 <h1>Результаты поиска</h1>
  <table>
	<tr><th>Текст шутки</th><th>Действия</th></tr>
	<?php foreach($jokes as $joke): ?>
	<tr>
	 <td>
      <?php htmlout($joke['joketext']);?>
     </td>
	 <td>
	  <form action='?' method='post'>
	   <div>
	    <input type='hidden' name='id' value='<?php htmlout($joke['id']); ?>'>
	    <input type='submit' name='action' value='Редактировать'>
	    <input type='submit' name='action' value='Удалить'>
	   </div>
	  </form>
	 </td>
	</tr>
	<?php endforeach; ?>
  </table>
  <p><a href='?'>Искать заново</a></p>
  <p><a href='..'>Вернуться на главную страницу</a></p>
 </body>
</html>