<?php
use MrDarrenGriffin\Blog\Blog;
$app->get('/blog',function() use ($app){
  $posts = Blog::with('user')->where('enabled',1)->get();
  $app->render('blog/blog.php',['blogItems' => $posts]);
})->name('blog.home');

$app->post('/blog/create-post',function() use ($app){
  if(!$app->auth OR !$app->auth->hasPermission("blog.create-posts")){$app->notFound();}
});
