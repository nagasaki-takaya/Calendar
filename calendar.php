<?php
require_once 'dbAccess.php';
class Calendar {
    public $holidayJs;
    public $calendarYear;
    protected $weeks;
    protected $holidays;


    public function __construct($y) {
        $this->calendarYear = $y;
        $db = getDb();
        $sql = "select * from holidaytime where date >= '2015-01-01' && date <= '2015-12-31'";
        $stt = $db->prepare("select * from holidaytime where date >= '2015-01-01' && date <= '2015-12-31'");
        $stt->execute();
        $this->holidays = array();
        while ($row = $stt->fetch()) {
            $this->holidays[] = $row;
        }

    }
    public function create($mon){
        $y = $this->calendarYear;
        $lastDay = date ("t", strtotime($y."-".$mon."-1"));
        $youbi   = date ("w", strtotime($y."-".$mon."-1"));
        $week = '';
        $this->weeks = array();
        $holidays = $this->holidays;
        $week .= str_repeat('<td></td>', $youbi);

        foreach ($holidays as $holidayDates){
            $holidayDate[] = $holidayDates['date'];
        }
        for ($day = 1; $day <= $lastDay; $day++, $youbi++) {
            $datetime = new DateTime("$y-$mon-$day");
            $calendarDate = $datetime->format('Y-m-d');
            $holidayNum = array_search($calendarDate, $holidayDate);
            if ($holidayNum !== false) {
                $this->holidayJs[] .= sprintf ( '<div class="holidayId" id=%d_%d>%s</div>',$mon ,$day, $holidays["$holidayNum"]['name']);  //祝日にID付与
                $week .= sprintf ( '<td class="youbi_%d holi" onmouseover="showPopup(event,\'%d_%d\');" onmouseout="hidePopup(\'%d_%d\');">%d</td>'
                                , $youbi % 7,$mon ,$day, $mon, $day, $day);//マウスオーバー処理
            } else {
                $week .= sprintf ( '<td class="youbi_%d">%d</td>', $youbi % 7, $day );
            }


            if (($youbi % 7 == 6) || ($day == $lastDay)) {   //最終週の処理
                $week .= str_repeat ( '<td></td>', 6 - ($youbi % 7) );
                $this->weeks [] = '<tr>' . $week . '</tr>';
                $week = '';
            }

        }
    }

    public function getWeeks() {
        return $this->weeks;
    }
    public function prev() {
        return $this->calendarYear - 1;
    }
    public function next() {
        return $this->calendarYear + 1;
    }
    public function thisYear() {
        return $this->calendarYear;
    }
    public function holidayJs(){
        return $this->holidayJs;
    }
}

