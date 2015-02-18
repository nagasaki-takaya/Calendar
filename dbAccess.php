<?php
function getDb($y) {
    $dsn = 'mysql:dbname=calendarHoliday; host=localhost';
    $usr = 'root';
    $password = 'kenji1843';

    try {
        $db = new PDO ( $dsn, $usr, $password );
        $db->exec ( 'SET NAMES utf8' );
        $stt = $db->prepare("select * from holidaytime where date between  \"$y-01-01\" AND \"$y-12-31\"");
        $stt->execute();
        while($result = $stt->fetch()) {
            $holidayName[] = $result['name'];
            $holidayDate[] = $result['date'];
        }

        //return $holidayName;
    } catch ( PDOException $e ) {
        print ('Error:' . $e->getMessage ()) ;
        die ( "接続エラー:({$e->getMessage()}" );
    }
    return array($holidayDate, $holidayName);
}