<?php
namespace App\Http\Controllers\Calendar;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Calendar\Form\CalendarFormView;
use App\Calendar\ExtraHoliday;
class ExtraHolidaySettingController extends Controller
{
	public function form(Request $request){

		//クエリーのdateを受け取る
		$date = $request->input("date");

		//dateがYYYY-MMの形式かどうか判定する
		if($date && strlen($date) == 7){
			$date = strtotime($date . "-01");
		}else{
			$date = null;
		}
		
		//取得出来ない時は現在(=今月)を指定する
		if(!$date)$date = time();
		
		//フォームを表示
		$calendar = new CalendarFormView($date);

		return view('calendar/extra_holiday_setting_form', [
			"calendar" => $calendar
		]);
	}
    /*
    public function edit($date_key){
    $date_setings = [];
    $comment = '';
    $date_flag = '';
    $schedule = '';
    $date = ExtraHoliday::select('date_key')->get();
        foreach($date as $key=>$value) {
            if($date_key == $value['date_key']){
                $date_setings = ExtraHoliday::where('date_key', $date_key)->first();
                $comment = $date_setings->comment;
                $date_flag = $date_setings->date_flag;
            }
        }
    //フォームを表示
        $calendar = new CalendarFormView($date_key);
                  

		return view('calendar/extra_holiday_setting_edit', [
			//"calendar" => $calendar,
            "date_key" => $date_key,
            "date_setings" => $date_setings,
            "comment" => $comment,
            "date_flag" => $date_flag,
            "schedule" => $schedule,
            "calendar" => $calendar
		]);
	}
    */
    
    public function edit($date_key){
    $schedules = ExtraHoliday::where('date_key', $date_key)->orderBy('schedule_time', 'asc')->get();
    //フォームを表示
    $calendar = new CalendarFormView($date_key);
                  

		return view('calendar/extra_holiday_setting_edit', [
			//"calendar" => $calendar,
            "date_key" => $date_key,
            //"date_setings" => $date_setings,
            //"comment" => $comment,
            //"date_flag" => $date_flag,
            "schedules" => $schedules,
            "calendar" => $calendar
		]);
	}
    
    
    public function update(Request $request){
		$input = $request->get("extra_holiday");
		$ym = $request->input("ym");
		$date = $request->input("date");
		$date_key = $request['date_key'];
            
		ExtraHoliday::updateExtraHolidayWithMonth($ym, $input);
		return redirect(route('edit_extra_holiday_setting', [
                    'date_key' => $date_key,
                ]));
			//->action("App\Http\Controllers\Calendar\ExtraHolidaySettingController@edit")
			//->withStatus("保存しました");
	}
    
    public function ajax(Request $request){
       
        $formdata = $request->all();
        $hours = $request['schedule_hours']; 
        $minutes = $request['schedule_minutes']; 
        $schedule_time = $hours.':'.$minutes.':00';
        $schedule = $request['schedule_text']; 
        $date_key = $request['schedule_date_key']; 
            
		return response()->json([$formdata]);
			//->action("App\Http\Controllers\Calendar\ExtraHolidaySettingController@edit")
			//->withStatus("保存しました");
	}
    
    public function schedule_store(Request $request){

        $hours = $request['schedule_hours']; 
        $minutes = $request['schedule_minutes']; 
        $schedule_time = $hours.':'.$minutes.':00';
        $schedule = $request['schedule_text']; 
        $date_key = $request['date_key']; 

        ExtraHoliday::storeSchedule($date_key, $schedule, $schedule_time);

		return redirect(route('edit_extra_holiday_setting', [
                   'date_key' => $date_key,
                ]));
			//->action("App\Http\Controllers\Calendar\ExtraHolidaySettingController@edit")
			//->withStatus("保存しました");
	}
}