<!DOCTYPE html>
<html lang='en'>

 <head>
 <meta charset='utf-8'>
 <title>Система поиска шуток</title>
 </head>

 <body>
 <form action='' method='get'>
   
   <select><?php foreach():?><option value='<?php?>'></option><?php endforeach; ?></select>
   <select><?php foreach():?><option value='<?php?>'></option><?php endforeach; ?></select>
 </form>
 </body>
<!--
1. создать форму, содержащую 2 списка и одно текстовое поле.
2. элементы списков, заключенные в теги <option> будут заключены в конструкцию foreach.
3. Внутри тега option находится атрибут value. Его назначение - передавать контроллеру значение идентификаторов сущностей (автора и категории).
-->
</html>