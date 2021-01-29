<?php
namespace App\Calendar;

use Carbon\Carbon;
use App\Calendar\ExtraHoliday;

class CalendarView {

	protected $carbon;
    protected $holidays = [];

	function __construct($date){
		$this->carbon = new Carbon($date);
	}
	/**
	 * タイトル
	 */
	public function getTitle(){
		return $this->carbon->format('Y年n月');
	}

	/**
	 * カレンダーを出力する
	 */
	function render(){
		//HolidaySetting
		$setting = HolidaySetting::firstOrNew();
		$setting->loadHoliday($this->carbon->format("Y"));
        
		//臨時営業日の読み込み
		$this->holidays = ExtraHoliday::getExtraHolidayWithMonth($this->carbon->format("Ym"));
        
		$html = [];
		$html[] = '<div class="calendar">';
		$html[] = '<table class="table">';
		$html[] = '<thead>';
		$html[] = '<tr>';
		$html[] = '<th>月</th>';
		$html[] = '<th>火</th>';
		$html[] = '<th>水</th>';
		$html[] = '<th>木</th>';
		$html[] = '<th>金</th>';
		$html[] = '<th>土</th>';
		$html[] = '<th>日</th>';
		$html[] = '</tr>';
		$html[] = '</thead>';
		
		$html[] = '<tbody>';
		$weeks = $this->getWeeks();
		foreach($weeks as $week){
			$html[] = '<tr class="'.$week->getClassName().'">';
			$days = $week->getDays($setting);
		foreach($days as $day){
			$html[] = $this->renderDay($day);
		}
			$html[] = '</tr>';
		}
		$html[] = '</tbody>';
		$html[] = '</table>';
		$html[] = '</div>';
		return implode("", $html);
	}
    
	protected function getWeeks(){
		$weeks = [];

		//初日
		$firstDay = $this->carbon->copy()->firstOfMonth();

		//月末まで
		$lastDay = $this->carbon->copy()->lastOfMonth();

		//1週目
		//$week = new CalendarWeek($firstDay->copy());
		$weeks[] = $this->getWeek($firstDay->copy());

		//作業用の日
		$tmpDay = $firstDay->copy()->addDay(7)->startOfWeek();

		//月末までループさせる
		while($tmpDay->lte($lastDay)){
			//週カレンダーViewを作成する
			//$week = new CalendarWeek($tmpDay, count($weeks));
			//$weeks[] = $week;
            $weeks[] = $this->getWeek($tmpDay->copy(), count($weeks));
			
            //次の週=+7日する
			$tmpDay->addDay(7);
		}

		return $weeks;
	}
	/**
	 * @return CalendarWeek
	 */
	protected function getWeek(Carbon $date, $index = 0){
		return new CalendarWeek($date, $index);
	}
    
	/**
	 * 日を描画する
	 */
	protected function renderDay(CalendarWeekDay $day){
		$html = [];
		$html[] = '<td class="'.$day->getClassName().'">';
		$html[] = $day->render();
		$html[] = '</td>';
		return implode("", $html);
	}
    
	/**
	 * 次の月
	 */
	public function getNextMonth(){
		return $this->carbon->copy()->addMonthsNoOverflow()->format('Y-m');
	}
	/**
	 * 前の月
	 */
	public function getPreviousMonth(){
		return $this->carbon->copy()->subMonthsNoOverflow()->format('Y-m');
	}
    
	/**
	 * 次の日
	 */
	public function getNextDay(){
		return $this->carbon->copy()->addDay()->format('Ymd');
	}
	/**
	 * 前の日
	 */
	public function getPreviousDay(){
		return $this->carbon->copy()->subDay()->format('Ymd');
	}
}
