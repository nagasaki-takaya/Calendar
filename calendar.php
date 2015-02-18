<?php
require_once 'dbAccess.php';
class Calendar {
    protected $weeks;
    protected $calendarYear;
    protected $holidayDate = array();
    protected $holidayName = array();

    public function __construct($y) {
        $this->calendarYear = $y;
        $arrayDateName = getDb($y);   //戻り値 $arrayDateName[0]=>日付[], [1]=>祝日名[] ...※1

        foreach($arrayDateName as $dateOrName => $arrayDateName){  //※1の配列の分解
            if($dateOrName){                                       //祝日名
                $this->holidayName = $arrayDateName;
            } else {                                               //日付
                $this->holidayDate = $arrayDateName;
            }
        }
    }

    public function create($mon){
        $y = $this->calendarYear;
        $lastDay = date ("t", strtotime($y."-".$mon."-1 00:00:00"));
        $youbi   = date ("w", strtotime($y."-".$mon."-1 00:00:00"));
        $week = '';
        $this->weeks = array();
        $holiDate = $this->holidayDate;

        $week .= str_repeat('<td></td>', $youbi);
        for($day = 1; $day <= $lastDay; $day ++, $youbi ++) {
            $mon = sprintf ( "%02d", $mon );
            $day = sprintf ( "%02d", $day );
            $string = "{$y}-{$mon}-{$day}";
            $checkHoliday = '';

            if (in_array ( $string, $holiDate)) {
                $num = array_search ( $string, $holiDate);
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
}

