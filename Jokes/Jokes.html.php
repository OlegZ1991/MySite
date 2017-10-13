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
	  <form>
	   <div>
	    <input type='hidden'>
	    <input type='button' name='action' value='Редактировать'>
	    <input type='button' name='action' value='Удалить'>
	   </div>
	  </form>
	 </td>
	</tr>
	<?php endforeach; ?>
  </table>
  <a href='?'>Искать заново</a>
 </body>

</html>