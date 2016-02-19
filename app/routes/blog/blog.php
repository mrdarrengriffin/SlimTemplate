<?php
use MrDarrenGriffin\Blog\Blog;
$app->get('/blog',function() use ($app){
  $posts = Blog::with('user')->where('enabled',1)->get();
  $app->render('blog/blog.php',['blogItems' => $posts]);
})->name('blog.home');

$app->post('/blog/create-post',function() use ($app){
  if(!$app->auth OR !$app->auth->hasPermission("blog.create-posts")){$app->notFound();}
  $request = $app->request;
  $v = $app->validation;
  $v->validate([
    'title' => [$request->post('title'),'required'],
    'content' => [$request->post('content'),'required']
  ]);
  if($v->passes()){
    $post = new Blog();
    $post->title = $request->post('title');
    $post->content = $request->post('content');
    $post->enabled = 1;
    $post->user_id = $app->auth->id;
    $post->timestamp_created = time();
    $post->save();
    $app->flash('success','Post created successfully');
    $app->response->redirect($app->urlFor('blog.home'));
  }else{
    $app->render('blog/blog.php',[
      'errors' => $v->errors(),
      'request' => $request
    ]);
  }
})->name('blog.create-post.post');
