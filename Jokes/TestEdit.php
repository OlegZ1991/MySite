<?php
if(isset($_GET['editform']))
{
	include $_SERVER['DOCUMENT_ROOT'].'/includes/db.inc.php';
	
	if($_POST['author'] == '')
	{
		$error = 'Вы должны выбрать имя автора. Попробуйте снова';
		include 'Error.html.php';
		exit();
	}
	
	try
	{
			$sql = "UPDATE joke SET
			joketext=:joketext,
			authorid=:authorid 
			WHERE id=:id,";
	$s = $pdo->prepare($sql);
	$s->bindValue(':joketext',$_POST['text']);
	$s->bindValue(':authorid',$_POST['author']);
	$s->bindValue(':id',$_POST['id']);
	$s->execute();
	}
	catch(PDOexception $e)
	{
		$error = "Ошибка при обновлении шутки";
		include "error.html.php";
		exit();
	}
	try
	{
		$sql = 'DELETE FROM jokecategory WHERE jokeid=:jokeid';
		$s = $pdo->prepare($sql);
		$s->bindValue(':jokeid',$_POST['id']);
		$s->execute();
	}
	catch(PDOexception $e)
	{
		$error = "Ошибка при удалении данных из таблицы";
		include "error.html.php";
		exit();
	}
}

if(isset($_POST['categories']))
{
	try
	{
		$sql = 'INSERT INTO jokecategory SET
			jokeid=:jokeid, 
			categoryid=:categoryid';
		$s = $pdo->prepare($sql);
		
		foreach($_POST['categories'] as $categoryid)
		{
			$s->bindValue(':jokeid',$_POST['id']);
			$s->bindValue(':categoryid',$categoryid);
			$s->execute();
		}
	}
	catch(PDOexception $e)
	{
		$error = "Ошибка при добавлении в базу данных";
		include "error.html.php";
		exit();
	}
	Header('Location: .');
	exit();
}
?>