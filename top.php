<?php
require_once('Calendar.php');
require_once('Encode.php');

$year = isset($_GET['y']) ? $_GET['y'] : date('Y');
$cal = new Calendar($year);
?><!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>PHPでカレンダー</title>
    <link rel="stylesheet" href="style.css">
    <script type="text/javascript" src="popUp.js"></script>
</head>
<body>
    <table id="header">
        <tr>
            <th><a href="?y=<?php echo h($year-1);?>">&laquo;</a></th>
            <th><?php echo h($year); ?></th>
            <th><a href="?y=<?php echo h($year+1);?>">&raquo;</a></th>
        </tr>
    </table>
    <table id="frame">
        <tr><td>
<?php
for($i = 1; $i <= 12; $i++) :       //1月～12月オブジェクト生成
    $cal->create($i);
?>
            <table id="month">      <!--//--create monthここから-->
                <thead>
                    <tr>
                        <th colspan="7"><?php echo $i.'月'; ?></th>
                    </tr>
                    <tr>
                        <th>日</th>
                        <th>月</th>
                        <th>火</th>
                        <th>水</th>
                        <th>木</th>
                        <th>金</th>
                        <th>土</th>
                    </tr>
                </thead>
                <tbody>
<?php
    foreach ($cal->getWeeks() as $week) {
       echo $week;             //week(日付)表示
    }
?>
                </tbody>
            </table>				<!--//--create monthここまで-->
<?php if ($i == 12) :?>
</td></tr></tbody></table>
<?php elseif ($i % 3 == 0) :?>
</td></tr></tbody><table id="frame"><tbody><tr><td>
<?php else :?>
</td><td>
<?php endif;?>
<?php endfor;?>
<!-- JSポップ用にID付与 style hide -->
<?php
foreach ($cal->holidayJs as $holidayJ) {
    echo $holidayJ;
    echo '\n';
}
?>
<!-- style hide ここまで -->
</body>
</html>