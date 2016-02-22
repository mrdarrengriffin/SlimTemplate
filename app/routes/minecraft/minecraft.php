<?php
use MrDarrenGriffin\Minecraft\Minecraft;
$app->get('/minecraft/tests',function() use ($app){
  $app->render('minecraft/minecraft.php');
});
