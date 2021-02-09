$(".ajaxBtn").click(function () {
  $.ajaxSetup({
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
  });
  var schedule_date_key = $(this).next().val();

  $.ajax({
    //POST通信
    type: "post", //HTTP通信のメソッドをPOSTで指定
    //ここでデータの送信先URLを指定します。
    url: "/ajax_holiday_setting", //通信先のURL
    dataType: "json", // データタイプをjsonで指定
    data: {
        schedule_date_key:schedule_date_key,
    }, // serializeしたデータを指定
  })
    //通信が成功したとき
    .then((res) => {
      var schedule = [];
      var resLength = res[0].length;
      console.log(resLength);
      if(resLength != 0){
          $('#dateToday').text(res[0][0].date_key + 'の予定');
          $('#store_date_key').html('<input class="form-control" type="hidden" name="store_date_key" value="' + schedule_date_key + '" />');
          $('.for_edit').html('<div class="for_edit"><a href="/extra_holiday_setting/edit/' + schedule_date_key + '">編集</a></div>');
          for(var i = 0; i < resLength; i++){
            schedule.push('<div class="scheduleBox"><div class="time">' + res[0][i].schedule_time + '</div><div class="schedule">' + res[0][i].schedule_comment + '</div><div class="delete btn"><button id="ajaxDelete" class="delete ajaxDelete">削除</button><input type="hidden" name="ajaxDeleteId" value="'+ res[0][i].id +'"><input type="hidden" name="ajaxDateKey" value="'+ schedule_date_key +'"></div></div>');
            $('#scheduleArea').html(schedule);
          }
      } else {
        var year = schedule_date_key.slice(0, 4);
        var month = schedule_date_key.slice(4, 6);
        var day = schedule_date_key.slice(6, 8);
        var yearText = '年';
        var monthText = '月';
        schedule_date_text = year + yearText + month + monthText + day + '日';
         $('#dateToday').text(schedule_date_text + 'の予定');
         $('#store_date_key').html('<input class="form-control" type="hidden" name="store_date_key" value="' + schedule_date_key + '" />');
         $('.for_edit').html('<div class="for_edit"><a href="/extra_holiday_setting/edit/' + schedule_date_key + '">編集</a></div>');
         schedule.push('<input class="form-control" type="hidden" name="store_date_key" value="' + schedule_date_key + '" />');
         schedule.push('<p>予定がありません</p>');
          $('#scheduleArea').html(schedule);
      }
    })
    //通信が失敗したとき
    .fail((error) => {
      console.log('error.statusText');
    });
});



$(document).on("click", ".ajaxDelete", function(){
  $.ajaxSetup({
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
  });
  var id = $(this).next().val();
  var dateKeyForDelete = $('input[name="ajaxDateKey"]').val();
  

  $.ajax({
    //POST通信
    type: "post", //HTTP通信のメソッドをPOSTで指定
    //ここでデータの送信先URLを指定します。
    url: "/ajax_delete", //通信先のURL
    dataType: "json", // データタイプをjsonで指定
    data: {
        id:id,
        //date_key:dateKeyForDelete,
    }, // serializeしたデータを指定
  })
    //通信が成功したとき
    .then((res) => {
      console.log(res);
      var schedule = [];
      var resLength = res[0].length;
      console.log(resLength);
      if(resLength != 0){
          for(var i = 0; i < resLength; i++){
            $('#store_date_key').html('<input class="form-control" type="hidden" name="store_date_key" value="' + dateKeyForDelete + '" />');
            //schedule.push('<div class="for_edit"><a href="/extra_holiday_setting/edit/' + dateKeyForDelete + '">編集</a></div>');
            schedule.push('<div class="scheduleBox"><div class="time">' + res[0][i].schedule_time + '</div><div class="schedule">' + res[0][i].schedule_comment + '</div><div class="delete btn"><button id="ajaxDelete" class="delete ajaxDelete">削除</button><input type="hidden" name="ajaxDeleteId" value="'+ res[0][i].id +'"><input type="hidden" name="ajaxDateKey" value="'+ dateKeyForDelete +'"></div></div>');
            $('#scheduleArea').html(schedule);
          }
      } else {
         schedule.push('<p>予定がありません</p>');
          $('#scheduleArea').html(schedule);
      }
    })
    //通信が失敗したとき
    .fail((error) => {
      console.log('error.statusText');
    });
    
});

$(".ajaxStoreBtn").click(function () {
  $.ajaxSetup({
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
  });
  var store_date_key = $('input[name="store_date_key"]').val();
  var store_schedule_hours = $('[name="schedule_hours"] option:selected').val();
  var store_schedule_minutes = $('[name="schedule_minutes"] option:selected').val();
  var store_schedule_text = $('input[name="schedule_text"]').val();
  //console.log(schedule_date_key);

  $.ajax({
    //POST通信
    type: "post", //HTTP通信のメソッドをPOSTで指定
    //ここでデータの送信先URLを指定します。
    url: "/ajax_store", //通信先のURL
    dataType: "json", // データタイプをjsonで指定
    data: {
        date_key:store_date_key,
        schedule_hours:store_schedule_hours,
        schedule_minutes:store_schedule_minutes,
        schedule_text:store_schedule_text,
    }, // serializeしたデータを指定
  })
    //通信が成功したとき
    .then((res) => {
      var schedule = [];
      var resLength = res[0].length;
      if(resLength != 0){
          for(var i = 0; i < resLength; i++){
            $('#store_date_key').html('<input class="form-control" type="hidden" name="store_date_key" value="' + store_date_key + '" />');
            schedule.push('<div class="scheduleBox"><div class="time">' + res[0][i].schedule_time + '</div><div class="schedule">' + res[0][i].schedule_comment + '</div><div class="delete btn"><button id="ajaxDelete" class="delete ajaxDelete">削除</button><input type="hidden" name="ajaxDeleteId" value="'+ res[0][i].id +'"><input type="hidden" name="ajaxDateKey" value="'+ store_date_key +'"></div></div>');
            $('#scheduleArea').html(schedule);
          }
      } else {
        var year = store_date_key.slice(0, 4);
        var month = store_date_key.slice(4, 6);
        var day = store_date_key.slice(6, 8);
        var yearText = '年';
        var monthText = '月';
        schedule_date_text = year + yearText + month + monthText + day + '日';
         $('#dateToday').text(schedule_date_text + 'の予定');
         $('#store_date_key').html('<input class="form-control" type="hidden" name="store_date_key" value="' + store_date_key + '" />');
         schedule.push('<input class="form-control" type="hidden" name="store_date_key" value="' + store_date_key + '" />');
         schedule.push('<div class="for_edit"><a href="/extra_holiday_setting/edit/' + store_date_key + '">編集</a></div>');
         schedule.push('<p>予定がありません</p>');
          $('#scheduleArea').html(schedule);
      }
    })
    //通信が失敗したとき
    .fail((error) => {
      console.log('error.statusText');
    });
});