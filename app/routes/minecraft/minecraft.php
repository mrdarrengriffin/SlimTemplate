<?php
use MrDarrenGriffin\Minecraft\Minecraft;
$app->get('/minecraft',function() use ($app){
  $app->render('minecraft/minecraft.php');
})->name('minecraft');
