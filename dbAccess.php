<?php
function getDb() {
    $dsn = 'mysql:dbname=calendarHoliday; host=localhost';
    $usr = 'root';
    $password = 'kenji1843';

    try {
        $db = new PDO ( $dsn, $usr, $password );
        $db->exec ( 'SET NAMES utf8' );
    } catch ( PDOException $e ) {
        die ( "接続エラー:({$e->getMessage()}" );
    }
return $db;
}