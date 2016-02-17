<?php
$app->get('/blog',function() use ($app){
  $showEditor = false;
  if($app->auth->hasPermission("blog.create-posts")){$showEditor = true;}
  $app->render('blog/blog.php',['showEditor' => $showEditor]);
});
