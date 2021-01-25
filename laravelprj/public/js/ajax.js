$(".ajaxBtn").click(function () {
  $.ajaxSetup({
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
  });
  //var schedule_hours = $('#schedule_hours option:selected').val();
  //var schedule_minutes = $('#schedule_minutes option:selected').val();
  //var schedule_date_key = $('input[name="date_key"]').val();
  var schedule_date_key = $(this).next().val();
  //var schedule_text = $('#schedule_text').val();
  //console.log(schedule_hours);
  //console.log(schedule_minutes);
  console.log(schedule_date_key);
  //console.log(schedule_text);

  $.ajax({
    //POST通信
    type: "post", //HTTP通信のメソッドをPOSTで指定
    //ここでデータの送信先URLを指定します。
    url: "http://localhost:8000/ajax_holiday_setting", //通信先のURL
    dataType: "json", // データタイプをjsonで指定
    data: {
        schedule_date_key:schedule_date_key,
    }, // serializeしたデータを指定
  })
    //通信が成功したとき
    .then((res) => {
      console.log(res);
      var schedule = res[0]['schedule_date_key'] + res[0]['schedule_text'];
      $('#schedule').html(schedule);
    })
    //通信が失敗したとき
    .fail((error) => {
      console.log('error.statusText');
    });
});