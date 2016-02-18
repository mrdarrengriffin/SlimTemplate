<?php
use MrDarrenGriffin\Blog\Blog;
$app->get('/blog',function() use ($app){
  $showEditor = false;
  if($app->auth->hasPermission("blog.create-posts")){$showEditor = true;}

  $posts = Blog::with('user')->where('enabled',1)->get();

  $app->render('blog/blog.php',['showEditor' => $showEditor,'blogItems' => $posts]);
});
