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
		$placeholders[':joketext'] = '%'. $_GET['category']. '%';
	}
	$sql = $select. $from. $where;
	$s = $pdo->prepare($sql);
	$s->execute($placeholders);
	
	foreach($s as $row)
	{
		$jokes[] = array('joketext'=>$row['joketext'], 'id'=>$row['id']);
	}
	include 'jokes.html.php';
	exit();
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