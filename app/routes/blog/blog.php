<?php
$app->get('/blog',function() use ($app){
  $app->render('blog.php');
});
