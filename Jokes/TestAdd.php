<?php
if(isset($_GET['addform']))
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
			$sql = "INSERT INTO joke SET
			joketext=:joketext,
			jokedate=CURDATE(),
			authorid=:authorid";
	$s = $pdo->query($sql);
	$s->bindValue(':joketext',$_POST['text']);
	$s->bindValue(':authorid',$_POST['author']);
	$s->execute();
	}
	catch(PDOexception $e)
	{
		$error = "Ошибка при добавлении в базу данных";
		include "error.html.php";
		exit();
	}
}
$jokeid = $pdo -> LastInsertId();

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
			$s->bindValue(':jokeid',$jokeid);
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