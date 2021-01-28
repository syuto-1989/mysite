<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Calendar\CalendarView;
use App\Calendar\Output\CalendarOutputView;
use App\Calendar\ExtraHoliday;
class CalendarController extends Controller
{
   public function show(Request $request){
		//クエリーのdateを受け取る
		$date = $request->input("date");

		//dateがYYYY-MMの形式かどうか判定する
		if($date && preg_match("/^[0-9]{4}-[0-9]{2}$/", $date)){
			$date = strtotime($date . "-01");
		}else{
			$date = null;
		}
		
		//取得出来ない時は現在(=今月)を指定する
		if(!$date)$date = time();
       
		$calendar = new CalendarOutputView($date);
       
        $date_key = date("Ymd");
        $date_today = date("Y年m月d日");
        $schedules = ExtraHoliday::where('date_key', $date_key)->orderBy('schedule_time', 'asc')->get();
		return view('calendar', [
			"calendar" => $calendar,
			"calendar" => $calendar,
			"date_today" => $date_today,
			"date_key" => $date_key,
			"schedules" => $schedules
		]);
	}
    public function ajax(Request $request){
       
        //$formdata = $request->all();
        $date_key = $request['schedule_date_key']; 
        $schedules = ExtraHoliday::where('date_key', $date_key)->orderBy('schedule_time', 'asc')->get();
        
        foreach($schedules as $schedule){
           $schedule->schedule_time = substr($schedule->schedule_time, 0,5);
            $schedule->date_key = date('Y年m月d日',  strtotime($schedule->date_key));
        }
            
		return response()->json([$schedules]);
			//->action("App\Http\Controllers\Calendar\ExtraHolidaySettingController@edit")
			//->withStatus("保存しました");
	}
}
