<?php
//Удаление категорий
if(isset($_POST['action']) and $_POST['action'] == 'Удалить'){
	include $_SERVER['DOCUMENT_ROOT'].'/includes/db.inc.php';
	//удаление данных из таблицы jokecategory:
	try
	{
		$sql = 'DELETE FROM jokecategory WHERE categoryid=:id';
		$s = $pdo->prepare($sql);
		$s->BindValue(':id', $_POST['id']);
		$s->execute();
	}
	catch(PDOException $e)
	{
		$error = "Ошибка при удалении из базы данных.";
		include "error.html.php";
		exit();
	}
	//удаление данных из таблицы category:
	try
	{
		$sql = 'DELETE FROM category WHERE id=:id';
		$s = $pdo->prepare($sql);
		$s->BindValue(':id', $_POST['id']);
		$s->execute();
	}
	catch(PDOException $e)
	{
		$error = "Ошибка при удалении из базы данных.";
		include "error.html.php";
		exit();
	}
	header('Location:.');
	exit();
}
//Добавление новых категорий !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
//display all categories:
include $_SERVER['DOCUMENT_ROOT'].'/includes/db.inc.php';
try{
	$sql = 'SELECT name, id FROM category';
	$result = $pdo->query($sql);
}
catch(PDOException $e){
	$error = "Ошибка при извлечении из базы данных.";
	include "error.html.php";
	exit();
}

foreach($result as $row)
{
	$categories[] = array('id'=>$row['id'], 'name'=>$row['name']);
}
include 'Categories.html.php';
?>