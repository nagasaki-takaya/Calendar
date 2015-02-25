<?php
function getDb() {
    $dsn = 'mysql:dbname=calendarHoliday; host=localhost';
    $usr = 'root';
    $password = 'kenji1843';

    try {
        $db = new PDO ( $dsn, $usr, $password );
        $db->exec ( 'SET NAMES utf8' );
<<<<<<< HEAD
=======
>>>>>> b062514d4fecc835aaa5ff152dc4f59fd6d6a27e
    } catch ( PDOException $e ) {
        die ( "接続エラー:({$e->getMessage()}" );
    }
return $db;
}
