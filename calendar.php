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
        $holiDate = $this->holidayDate;

        $week .= str_repeat('<td></td>', $youbi);
        for($day = 1; $day <= $lastDay; $day ++, $youbi ++) {
            $mon = sprintf ( "%02d", $mon );
            $day = sprintf ( "%02d", $day );
            $date = "{$y}-{$mon}-{$day}";
            $checkHoliday = '';

            if (in_array ( $date, $holiDate)) {
                $num = array_search ( $date, $holiDate);
                $holiname =  $this->holidayName ["$num"];
                echo sprintf ( '<table><td id=%d_%d
                                        style="position:absolute;border-radius:10px;
                                        z-index:10;
                                        visibility:hidden;
                                        background-color:#fbff96;">%s</td>
                                </table>',$mon ,$day, $holiname);  //祝日にID付与

                $week .= sprintf ( '<td class="youbi_%d holi"
                                    onmouseover="showPopup(event,\'%d_%d\');"
                                    onmouseout="hidePopup(\'%d_%d\');">%d
                                    </td>', $youbi % 7,$mon ,$day, $mon, $day, $day); //マウスオーバー処理
            } else {
                $week .= sprintf ( '<td class="youbi_%d">%d</td>', $youbi % 7, $day );
            }

            if (($youbi % 7 == 6) || ($day == $lastDay)) {   //最終週の処理
                $week .= str_repeat ( '<td></td>', 6 - ($youbi % 7) );
                $this->weeks [] = '<tr>' . $week . '</tr>';
                $week = '';
            }
>>>>>>> b062514d4fecc835aaa5ff152dc4f59fd6d6a27e
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

