<?php
if(isset($_GET['action']) and $_GET['action'] == 'Удалить')
{
	include $_SERVER['DOCUMENT_ROOT'].'/includes/db.inc.php';
	
	try
	{
		$sql = "DELETE FROM jokecategory WHERE jokeid=:jokeid";
		$s = $pdo->prepare($sql);
		$s->bindValue(':jokeid',$_POST['id']);
		$s->execute();
	}
	catch(PDOexception $e)
	{
		$error = "Ошибка при удалении шутки";
		include "error.html.php";
		exit();
	}
	try
	{
		$sql = 'DELETE FROM joke WHERE id=:id';
		$s = $pdo->prepare($sql);
		$s->bindValue(':id',$_POST['id']);
		$s->execute();
	}
	catch(PDOexception $e)
	{
		$error = "Ошибка при удалении записей";
		include "error.html.php";
		exit();
	}
	Header('Location: .');
	exit();
}
?>