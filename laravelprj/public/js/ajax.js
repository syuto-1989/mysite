$(".ajaxBtn").click(function () {
  $.ajaxSetup({
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
  });
  var schedule_date_key = $(this).next().val();
  console.log(schedule_date_key);

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
      console.log(res);
      var schedule = [];
      var resLength = res[0].length;
      console.log(resLength);
      if(resLength != 0){
          schedule.push('<h1>' + res[0][0].date_key + 'の予定</h1>');schedule.push('<div class="for_edit"><a href="/extra_holiday_setting/edit/' + schedule_date_key + '">編集</a></div>');
          for(var i = 0; i < resLength; i++){
            schedule.push('<div class="scheduleBox"><div class="time">' + res[0][i].schedule_time + '</div><div class="schedule">' + res[0][i].schedule_comment + '</div><div class="delete btn"><button id="ajaxDelete" class="delete ajaxDelete">削除</button><input type="hidden" name="ajaxDeleteId" value="'+ res[0][i].id +'"></div></div>');
            $('#schedule').html(schedule);
          }
      } else {
        var year = schedule_date_key.slice(0, 4);
        var month = schedule_date_key.slice(4, 6);
        var day = schedule_date_key.slice(6, 8);
          console.log(year);
          console.log(month);
          console.log(day);
        var yearText = '年';
        var monthText = '月';
        schedule_date_text = year + yearText + month + monthText + day + '日';
         schedule.push('<h1>' + schedule_date_text + 'の予定</h1>');
         schedule.push('<div class="for_edit"><a href="/extra_holiday_setting/edit/' + schedule_date_key + '">編集</a></div>');
         schedule.push('<p>予定がありません</p>');
          $('#schedule').html(schedule);
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
　console.log(id);
  

  $.ajax({
    //POST通信
    type: "post", //HTTP通信のメソッドをPOSTで指定
    //ここでデータの送信先URLを指定します。
    url: "/ajax_delete", //通信先のURL
    dataType: "json", // データタイプをjsonで指定
    data: {
        id:id,
    }, // serializeしたデータを指定
  })
    //通信が成功したとき
    .then((res) => {
      console.log(res);
      var schedule = [];
      /*
      var resLength = res[0].length;
      console.log(resLength);
      if(resLength != 0){
          schedule.push('<h1>' + res[0][0].date_key + 'の予定</h1>');schedule.push('<div class="for_edit"><a href="/extra_holiday_setting/edit/' + schedule_date_key + '">編集</a></div>');
          for(var i = 0; i < resLength; i++){
            schedule.push('<div class="scheduleBox"><div class="time">' + res[0][i].schedule_time + '</div><div class="schedule">' + res[0][i].schedule_comment + '</div><div class="delete btn"><button id="ajaxDelete" value="'+ res[0][i].id +'" class="delete">削除</button></div></div>');
            $('#schedule').html(schedule);
          }
      } else {
        var year = schedule_date_key.slice(0, 4);
        var month = schedule_date_key.slice(4, 6);
        var day = schedule_date_key.slice(6, 8);
          console.log(year);
          console.log(month);
          console.log(day);
        var yearText = '年';
        var monthText = '月';
        schedule_date_text = year + yearText + month + monthText + day + '日';
         schedule.push('<h1>' + schedule_date_text + 'の予定</h1>');
         schedule.push('<div class="for_edit"><a href="/extra_holiday_setting/edit/' + schedule_date_key + '">編集</a></div>');
         schedule.push('<p>予定がありません</p>');
          $('#schedule').html(schedule);
      }*/
    })
    //通信が失敗したとき
    .fail((error) => {
      console.log('error.statusText');
    });
    
});