<?php
if(isset($_GET['action']) and $_GET['action'] == 'search')
{
	include $_SERVER['DOCUMENT_ROOT'].'/includes/db.inc.php';
	
	$select='SELECT id, joketext';
	$from=' FROM joke';
	$where=' WHERE TRUE';
	
	$placeholders = array();
	
	if($_GET['author']!= '')//Автор выбран (Внимание! Здесь используется id автора, а не name автора)
	{
		$where .= ' AND authorid=:authorid';
		$placeholders[':authorid']=$_GET['author'];
	}
	if($_GET['category']!= '')//Категория выбрана (Внимание! Здесь используется id категории, а не name категории)
	{
		$from .= ' INNER JOIN jokecategory ON id = jokeid';
		$where .= ' AND categoryid = :categoryid';
		$placeholders[':categoryid'] = $_GET['category'];
	}
	if($_GET['text']!= '')//Написан текст
	{
		$where .= ' AND joketext LIKE :joketext';
		$placeholders[':joketext'] = '%'. $_GET['text']. '%';
	}

	$sql = $select. $from. $where;
	$s = $pdo->prepare($sql);
	$s->execute($placeholders);
	$result = $s->fetchall();
	if($result != null)
	{
		foreach($result as $row)
	{
		$jokes[] = array('joketext'=>$row['joketext'], 'id'=>$row['id']);
	}
	include 'jokes.html.php';
	exit();
	}
	else
	{
		echo "Не найдено шуток, удовлетворяющих введенному критерию, попробуйте <a href='?'>искать заново</a>";
		exit();
	}

}

if(isset($_GET['add']))
{
	$pagetitle = 'Новая шутка';
	$action = 'addform';
	$authorid = '';
	$text = '';
	$id = '';
	$button = 'Добавить шутку';
	
	include $_SERVER['DOCUMENT_ROOT'].'/includes/db.inc.php';
	try
	{
		$result = $pdo->query('SELECT name, id FROM author');
	}
	catch(PDOException $e)
	{
		$error = "Ошибка при извлечении из базы данных.";
		include "error.html.php";
		exit();
	}
	foreach($result as $row)
	{
		$authors[] = array('name'=>$row['name'],'id'=>$row['id']);
	}
	try
	{
		$result = $pdo->query('SELECT name, id FROM category');
	}
	catch(PDOException $e)
	{
		$error = "Ошибка при извлечении из базы данных.";
		include "error.html.php";
		exit();
	}
	foreach($result as $row)
	{
		$categories[] = array(
							'name'=>$row['name'],
							'id'=>$row['id'],
							'selected'=>FALSE);
	}
	include 'form.html.php';
	exit();
}
if(isset($_POST['action']) and $_POST['action'] == 'Редактировать')
{
	include $_SERVER['DOCUMENT_ROOT']. '/includes/db.inc.php';
	//Извлекаем поля из таблицы joke, необходимые для проверки и генерации в форме:
	try
	{
		$sql = 'SELECT id, joketext, authorid FROM joke WHERE id=:id';
		$s = pdo->query($sql);
		$s->bindValue(':id', $_POST['id']);
		$s->execute();
	}
	catch(PDOException $e)
	{
		$error = "Ошибка при извлечении из базы данных.";
		include "error.html.php";
		exit();
	}
	$row = $s->fetch();
	
	$pagetitle = 'Редактирование шутки';
	$action = 'editform';
	$authorid = $row['authorid'];
	$text = $row['joketext'];
	$id = $row['id'];
	$button = 'Обновить шутку';
	
	//В форме необходима проверка if($authorid == $author[id])
	//В форме необходима проверка if($selected)
	//В контроллере необходимо извлечь поля из таблицы author так, чтобы появилась возможность проверки в форме
	/*
	В контроллере необходимо извлечь данные из таблицы jokecategory. Для какой цели? Целей несколько:
	1)Создание списка всех категорий, которым принадлежит шутка (условие - jokeid=:id), где :id=$_POST['id'].
	2)в результате создается массив всех категорий, которым принадлежит шутка.
	3) Элементы этого массива поочередно сравниваются со значениями массива, содержащего идентификаторы ВООБЩЕ всех категорий, SQL-запрос на который будет написан ниже.
	*/
	//Извлекаем поля id, name из таблицы author. Условие не требуется.
	try
	{
		$result = $pdo->query('SELECT id, name FROM author');
	}
	catch(PDOException $e)
	{
		$error = "Ошибка при извлечении из базы данных.";
		include "error.html.php";
		exit();
	}
	//Извлекаем поля categoryid из таблицы jokecategory из условия jokeid=$id(остается открытым вопрос: $id равно $_POST['id']?)
	try
	{
		$sql = 'SELECT categoryid FROM jokecategory WHERE jokeid=:id';
		$s = pdo->query($sql);
		$s->bindValue(':id', $id);//почему именно такая переменная, а не $_POST['id']? Разве они не равны между собой? Могут ли они быть неравными?
		$s->execute();
	}
	catch(PDOException $e)
	{
		$error = "Ошибка при извлечении из базы данных.";
		include "error.html.php";
		exit();
	}
	//В результате у нас есть массив всех категорий, к которым принадлежит шутка.
	//Далее необходимо сформировать массив из результирующего набора, название массива согласно книге - $selectedcategories[].
	//продолжить с этого момента. Массив еще не сформирован, следовательно, сравнивать нечего.
	//Извлекаем поля id, name из таблицы category. Условие не требуется.
	try
	{
		$result = $pdo->query('SELECT id, name FROM category');
	}
	catch(PDOException $e)
	{
		$error = "Ошибка при извлечении из базы данных.";
		include "error.html.php";
		exit();
	}
}
include $_SERVER['DOCUMENT_ROOT'].'/includes/db.inc.php';
try
{
	$sql = 'SELECT id, name FROM author';
	$result = $pdo->query($sql);
}
catch(PDOException $e)
{
	$error = "Ошибка при извлечении из базы данных.";
	include "error.html.php";
	exit();
}
foreach($result as $row)
{
	$authors[] = array('name' => $row['name'],'id' => $row['id']);
}
try
{
	$sql = 'SELECT id, name FROM category';
	$result = $pdo->query($sql);
}
catch(PDOException $e)
{
	$error = "Ошибка при извлечении из базы данных.";
	include "error.html.php";
	exit();
}
foreach($result as $row)
{
	$categories[] = array('name' => $row['name'],'id' => $row['id']);
}
include 'Searchform.html.php';
?>