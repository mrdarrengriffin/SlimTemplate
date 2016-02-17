<?php
$app->get('/admin/info',$requirePermission('admin.info.view'), function() use ($app){
})->name('admin.info');		
