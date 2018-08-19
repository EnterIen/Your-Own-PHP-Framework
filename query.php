<?php
/**
 * Created by PhpStorm.
 * User: Z003RE3C
 * Date: 8/16/2018
 * Time: 4:45 PM
 */

error_reporting(0);

$dbh = new PDO('mysql:host=localhost;dbname=library', 'root', 'mysql@shiyanlou.com');
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$dbh->exec('set names utf8');

if($_SERVER['REQUEST_METHOD'] == 'POST' ){

    if ($_POST['id']) {
        $sql="select * from book where id = :flag";
        $stmt = $dbh->prepare($sql);  
        $stmt->execute(array(':flag'=>$_POST['id'])); 
        $res=$stmt->fetch(PDO::FETCH_ASSOC);

        exit(json_encode(array("res"=>true,"data"=>$res)));
    }else if ($_POST['flag']) {
        // exit(json_encode(array("res"=>true,"data"=>$_POST["row_id"])));
        $sql="update book set author = :author where id = :id";
        $stmt = $dbh->prepare($sql);  
        $update_res = $stmt->execute(array(':author'=>$_POST['author'], ':id'=>$_POST['row_id'])); 
        // $res=$stmt->fetch(PDO::FETCH_ASSOC);
        if ($update_res) {
            exit(json_encode(array("res"=>true,"data"=>'修改成功')));
        } else{
            exit(json_encode(array("res"=>false,"data"=>"添加失败")));
        }
        
    }else {
        if(!isset($_POST["name"])||empty($_POST["name"])){
            exit(json_encode(array("res"=>false,"data"=>"书名不能为空")));
        }
        if(!isset($_POST["author"])||empty($_POST["author"])){
            exit(json_encode(array("res"=>false,"data"=>"作者名字不能为空")));
        }
        $sth=$dbh->prepare("INSERT INTO book(name,author) VALUES (:name,:author)");
        $sth->bindParam(":name",$_POST["name"],PDO::PARAM_STR);
        $sth->bindParam(":author",$_POST["author"],PDO::PARAM_STR);
        $res=$sth->execute();
        if($res){
            exit(json_encode(array("res"=>true)));
            return;
        }else{
            exit(json_encode(array("res"=>false,"data"=>"添加失败")));
        }
    }   
}
    $sql="select * from book";
    $data=$dbh->query($sql,PDO::FETCH_ASSOC);
    if($data){
        exit(json_encode(array("res"=>true,"data"=>$data->fetchAll())));
    }else{
        exit(json_encode(array("res"=>false,"data"=>"查询出错")));
    }
