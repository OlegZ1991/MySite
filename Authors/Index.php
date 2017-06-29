<?php
include $_SERVER['DOCUMENT_ROOT'].'/includes/db.inc.php';

//Добавление авторов:
if(isset($_GET['add']))
{
	$pagetitle='Добавление автора';
	$action='addform';
	$name='';
	$mail='';
	$id='';
	$button='Добавить автора';
	include "form.html.php";
	exit();
}
if(isset($_REQUEST['addform'])){
	
	include $_SERVER['DOCUMENT_ROOT'].'/includes.db.inc.php';
	
	try{
		$sql='INSERT INTO author (name, mail) VALUES (:name, :mail)';
		$s=$pdo->prepare($sql);
		$s->bindvalue(':name',$_POST['name']);
		$s->bindvalue(':mail',$_POST['mail']);
		$s->execute();
	}
	catch(PDOException $e){
		$error="Ошибка при удалении из базы данных. Код ошибки: ". $e->getMessage();
		include 'error.html.php';
		exit();
	}
	Header('location:.');
	exit();
}

try{
	$result=$pdo->query('SELECT id, name FROM author');
}
catch(PDOException $e){
	$error="Ошибка при извлечении из базы данных. Код ошибки: ". $e->getMessage();
	include 'error.html.php';
	exit();
}

foreach($result as $row){
	$authors[]=array('id'=>$row['id'], 'authorname'=>$row['name']);	
}
include 'authors.html.php';

//Начало логики управления:
//Удаление сущностей:
if(isset($_POST['action']) and $_POST['action']=='удалить')
{
	try{
		$sql="SELECT id FROM joke WHERE authorid=:id";
		$s=$pdo->prepare($sql);
		$s->bindvalue(':id', $_POST['id']);
		$s->execute();
	}
	catch(PDOException $e){
		$error="Ошибка при извлечении из базы данных. Код ошибки: ". $e->getMessage();
		include 'error.html.php';
		exit();
	}
	
	$result=$s->fetchAll();
	
	//удаляем записи из таблицы jokecategory:
	try{
		$sql="DELETE FROM jokecategory WHERE jokeid=:id";
		$s=$pdo->prepare($sql);
		foreach($result as $row){
			$jokeID=$row['id'];
			$s->bindvalue('id',$jokeID);
			$s->execute();
		}
	}
	catch(PDOException $e){
		$error="Ошибка при удалении из базы данных. Код ошибки: ". $e->getMessage();
		include 'error.html.php';
		exit();
	}
	//удаляем записи из таблицы author:
	try{
		$sql="DELETE FROM author WHERE id=:id";
		$s=$pdo->prepare($sql);
		$s->bindvalue(':id', $_POST['id']);
		$s->execute();
	}
	catch(PDOException $e){
		$error="Ошибка при удалении из базы данных. Код ошибки: ". $e->getMessage();
		include 'error.html.php';
		exit();
	}
		//удаляем записи из таблицы joke:
	try{
		$sql="DELETE FROM joke WHERE authorid=:id";
		$s=$pdo->prepare($sql);
		$s->bindvalue(':id', $_POST['id']);
		$s->execute();
	}
	catch(PDOException $e){
		$error="Ошибка при удалении из базы данных. Код ошибки: ". $e->getMessage();
		include 'error.html.php';
		exit();
	}
	Header('location:.');
	exit();
}
?>


