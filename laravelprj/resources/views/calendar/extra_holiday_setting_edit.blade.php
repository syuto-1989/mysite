@extends('layouts.app')
@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-12">
           <div class="card">
				<div class="card-header text-center">
					<a class="btn btn-outline-secondary float-left" href="{{ url('/extra_holiday_setting/' . $date_key) }}">前の月</a>
					
					<span>{{ $date_key }}の臨時営業日設定</span>
				
					<a class="btn btn-outline-secondary float-right" href="{{ url('/extra_holiday_setting/' . $date_key) }}">次の月</a>
				</div>
               <div class="card-body">
					@if (session('status'))
                       <div class="alert alert-success" role="alert">
                           {{ session('status') }}
                       </div>
                   @endif
					<form method="post" action="{{ route('update_extra_holiday_setting') }}">
						@csrf
						<div class="card-body">
							<select name="extra_holiday[{{ $date_key }}][date_flag]" class="form-control">
                                <option value="0" >- (休み)</option>
                                <option value="2" {{ $date_flag === 2 ? 'selected' : '' }}>臨時休業</option>
                                <option value="1" {{ $date_flag === 1 ? 'selected' : '' }}>臨時営業</option>
                            </select>
                            <input class="form-control" type="text" name="extra_holiday[{{ $date_key }}][comment]" value="{{ $comment }}" />
							<div class="text-center">
								<button type="submit" class="btn btn-primary">保存</button>
							</div>
                            <input class="form-control" type="hidden" name="date_key" value="{{ $date_key }}" />
						</div>
						
					</form>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection