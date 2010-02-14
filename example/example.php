<?php

require '../lib/ActiveRecord.php';

ActiveRecord::initialize(function(){
    $config['connectionString'] = 'mysql:dbname=simpleblog;host=127.0.0.1';
    $config['user'] = 'root';
    $config['password'] = 'root';
    return $config;
});

class Post extends ActiveRecord
{
    static $belongsTo = array(
        'user' => array('class'=>'User')
    );
    static $hasMany = array(
        'tags' => array('class'=>'Tag','joinTable'=>'post_tag')
    );
}

class User extends ActiveRecord
{
    static $hasMany = array(
        'posts' => array('class'=>'Post')
    );
}

class Tag extends ActiveRecord
{
    static $hasMany = array(
        'posts' => array('class'=>'Post','joinTable'=>'post_tag')
    );
    
}

// membuat data baru

// Mengambil data dengan relasi

$posts = Post::all(array('limit' => 5));
$posts[0]->user;
$posts[0]->tags;
var_dump($posts[0]);

$users = User::all(array('limit' => 5));
$users[0]->posts;
var_dump($users[0]);

