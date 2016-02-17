<?php
$app->get('/blog',function() use ($app){
  //if($app->auth->hasPermission("blog.create-posts")){echo "OK";}else{echo "NOT OK";}
  $app->render('blog/blog.php');
});
