<?php
require_once('getDb.php');

$holidays = file("holiday.dat", FILE_IGNORE_NEW_LINES);
foreach ($holidays as $each){
    $ary[] = explode ("\t",$each);
}
try {
    $db = getDb ();
        //$db->exec("create table holidayTime(name varchar(255),date date)"); //table作る場合使う
    foreach ($ary as $ary) {
        $sql = "insert into holidaytime (name, date) values (\"$ary[0]\", \"$ary[1]\")";
        $db->exec($sql);
    }
    $db = null;
} catch ( PDOException $e ) {
    die ( "エラーメッセージ：{$e->getMessage()}" );
}
