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
    public $posts;
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

//var_dump(User::find(1)->posts);

// membuat data baru
/*
$user = new User();
$user->name = 'Ata';
$user->email = 'ata@javan.co.id';
$user->save();

// memperbaharui data
$user = User::find(2);// mengambil data dengan id =2
$user->name = 'Seseorang Lagi';
$user->save();// menyimpanya kembali
*/
// Mengambil data dengan relasi

$user = User::first();
 
//foreach($users as $user){
    echo 'nama: '. $user->name ."<br/>\n";
    echo 'email: '. $user->name ."<br/>\n";
    echo 'posts: <br/>';
    foreach($user->posts as $post){//relasi 'hasMany'
        echo '  title'   . $post->title . "<br/>\n";
        echo '  content'   . $post->content . "<br/>\n";
        foreach($post->tags as $tag) {
            echo '        tag: '.$tag->name . "<br/>\n";
        }
    }
 
//}

