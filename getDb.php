<?php
function getDb() {
    $dsn = 'mysql:dbname=calendarholiday; host=localhost';
    $usr = 'root';
    $password = 'kenji1843';

    try {
        $db = new PDO ( $dsn, $usr, $password );
    } catch ( PDOException $e ) {
        die ( "接続エラー:({$e->getMessage()}" );
    }
    return $db;
}