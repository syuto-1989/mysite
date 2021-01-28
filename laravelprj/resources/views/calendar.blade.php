@extends('layouts.app')
@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-7">
           <div class="card">
               <div class="card-header text-center">
					<a class="btn btn-outline-secondary float-left" href="{{ url('/?date=' . $calendar->getPreviousMonth()) }}">前の月</a>
					
					<span>{{ $calendar->getTitle() }}</span>
					
					<a class="btn btn-outline-secondary float-right" href="{{ url('/?date=' . $calendar->getNextMonth()) }}">次の月</a>
				</div>
				<div class="card-body">
					{!! $calendar->render() !!}
               </div>
           </div>
       </div>
        <div class="col-md-5">
           <div id="schedule">
               <h1>本日（{{$date_today}}）の予定</h1>
               @if(!isset($schedules))
                   @foreach($schedules as $schedule)
                   @php
                    $schedule->schedule_time = substr($schedule->schedule_time, 0, -3);
                   @endphp
                   <div class="scheduleBox">
                       <div class="time">{{$schedule->schedule_time}}</div>
                       <div class="schedule">{{$schedule->schedule_comment}}</div>
                   </div>
                   @endforeach
               @else
               <div class="for_edit"><a href="/extra_holiday_setting/edit/{{$date_key}}">編集</a></div>
                <p>予定がありません</p>
               @endif
           </div>
       </div>
   </div>
</div>
@endsection