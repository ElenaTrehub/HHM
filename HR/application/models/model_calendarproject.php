<?php

class Calendar
{
    public $Year  = array();
    public $Month = array();
}

class Month
{
    public $MonthHeader;
    public $WeekDayHeader = array();
    public $MonthDays     = array();
}
class Day
{
    public $Date;
    public $Today;
    public $WeekDay;
    public $Holiday;
}

class Holiday
{
    public $Name;
    public $Date;
    public $Observed;
    public $Public;
}

class CalendarProject_Model extends Model
{

    public function __construct(){
        
        
    }//__construct

    public function CreateCalendar($start, $end){
        $startYear = gmdate("Y", $start);
        $endYear = gmdate("Y", $end);

        $currentYear = $startYear;

        $calendarList = array();

        while($currentYear <= $endYear){

            $calendar = new Calendar();
            $calendar->Year = $this->getYear($currentYear);


            $calendarList[] = $calendar;

            $currentYear++;
        }
        return $calendarList;
    }//CreateCalendar
    public function getYear($year)
    {
        $Month   = array("Januar", "Februar", "März", "April", "Mai", "Juni", "Juli", "August", "September", "Oktober", "November", "Dezember");
        $WeekDay = array("MO", "DI", "MI", "DO", "FR", "SA", "SO");

        $caledarYear  = array();
        $monthsLength = array();
        $month        = array();
        for ($i = 1; $i <= 12; $i++) {
            $monthView = new Month();

            $monthLength    = cal_days_in_month(CAL_GREGORIAN, $i, $year);
            $monthsLength[] = $monthLength;
            $firstMonthDay  = date('w', strtotime("01." . $i . "." . $year));

            $month = $this->getMonth($firstMonthDay, $monthLength, $i, $year);

            $monthView->MonthHeader   = $Month[$i - 1];
            $monthView->WeekDayHeader = $WeekDay;
            $monthView->MonthDays     = $month;
            $monthView->MonthLength     = $monthLength;
            $monthView->Year          = $year;
            $calendarYear[] = $monthView;
        }

        return $calendarYear;
    }//getYear

    public function getMonth($firstDay, $monthLength, $currentMonth, $currentYear)
    {
        $WeekDayArray = array("MO", "DI", "MI", "DO", "FR", "SA", "SO");
        $month = array();

        if ($firstDay == 0) {
            $firstDay = 7;
        }
        $startWeek = 0;
        $endWeek   = 0;

        for ($i = 1; $i <= $monthLength; $i++) {

            if (($i + $firstDay - 1) % 7 == 0 || $i == $monthLength) {
                $startWeek = $endWeek + 1;
                $endWeek   = $i;

                $week      = array();
                $dayOfWeek = 0;
                for ($day = intval($startWeek); $day <= intval($endWeek); $day++) {
                    $dayOfWeek++;
                    $dayData            = new Day;
                    $dayData->Date      = intval($day);
                    $dayData->Today     = date("Y-m-d", strtotime((string) $day . "-" . (string) $currentMonth . "-" . (string) $currentYear));
                    $dayData->WeekDay   = $dayOfWeek;
                    $dayData->WeekDayName   = $WeekDayArray[$dayOfWeek-1];
                    //$dayData->Holiday   = $this->checkHoliday($dayData->Today);

                    $dayToCompare = strtotime((string) $day . "-" . (string) $currentMonth . "-" . (string) $currentYear);
                    $dayToday     = strtotime("today");

                    
                    $week[] = $dayData;
                }
                if (count($week) < 7) {
                    while (count($week) < 7) {
                        $emptyDay            = new Day;
                        $emptyDay->Date      = 0;
                        $emptyDay->Today     = "";
                        $emptyDay->WeekDayName   = "";
                        $week[]              = $emptyDay;
                    }
                    if ($endWeek < 7) {
                        $week = $this->SortDays($week);
                        for ($i = 0; $i < sizeof($week); $i++) {
                            $week[$i]->WeekDay = $i + 1 ;
                            $week[$i]->WeekDayName   = $WeekDayArray[$week[$i]->WeekDay-1];
                        }
                    }
                }
                $month[] = $week;
            }
        }
        return $month;
    }//getMonth

    public function SortDays($week)
    {
        usort($week, array('CalendarProject_Model', 'compare'));
        return $week;
    }//SortDays

    private static function compare($d1, $d2)
    {
        if ($d1->Date == $d2->Date) {
            return 0;
        }
        return ($d1->Date < $d2->Date) ? -1 : 1;
    }//compare
}