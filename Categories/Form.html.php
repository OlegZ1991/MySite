<?php include_once $_SERVER['DOCUMENT_ROOT'].'/includes/helpers.inc.php'; ?>
<!DOCTYPE html>
<html lang='en'>
<head>
<meta charset='utf-8'>
<title><?php htmlout($pagetitle);?></title>
</head>
<body>
<h1><?php htmlout($pagetitle);?></h1>
 <form action="?<?php htmlout($action); ?>" method='post'>
 <input type='text' name='name' value='<?php htmlout($name); ?>'>

 <input type='hidden' name='id' value='<?php htmlout($id); ?>'>
 <input type='submit' value='<?php htmlout($button); ?>'>
 </form>
</body>
</html>
<!--переменная 1 - $pagetitle. Ее вызов - <?php htmlout($pagetitle); ?>
переменная 2 - $action='addform'. Ее вызов - <?php htmlout($action); ?>
переменная 3 - $name=''. Ее вызов - <?php htmlout($name); ?>

переменная 5 - $id=''. Ее вызов - <?php htmlout($id); ?>
переменная 6 - $button='Добавить категорию'. Ее вызов - <?php htmlout($button); ?>
-->