@extends('layouts.app')
@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
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
           <div id="schedule">
               <h1>本日（{{$date_today}}）の予定</h1>
               @foreach($schedules as $schedule)
               @php
                $schedule->schedule_time = substr($schedule->schedule_time, 0, -3);
               @endphp
               <div class="scheduleBox">
                   <div class="time">{{$schedule->schedule_time}}</div>
                   <div class="schedule">{{$schedule->schedule_comment}}</div>
                   <div class="delete btn">
                    <a class="delete" href="">削除</a>
                   </div>
               </div>
               @endforeach
           </div>
       </div>
   </div>
</div>
@endsection