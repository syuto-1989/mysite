(function ($) {
  // デフォルトの表示数
  var defaultNum = 3;
  // ボタンクリックで追加表示させる数
  var addNum = 3;
  // 現在の表示数
  var currentNum = 0;
$('#ajax_show').on('click',function(){
    var offsetNum = currentNum + addNum;
    $.ajax({
        // リクエスト方法
        type: "GET",
        // 送信先ファイル名
        url: "http://syuto-ito.boo.jp/manage/ajax_test_show.php",
        // 受け取りデータの種類
        datatype: "json",
        // 送信データ
        data:{
            // #id_numberのvalueをセット
            "number" : offsetNum
        }
    })

    // 通信が成功した時
    .done( function(data) {

        currentNum = offsetNum;
        $.each(data, function(i){
            if(data[i].img.length == 0){
                data[i].img = '../manage/event/register/images/no-img.png';
            }
            $('#event').append('<div class="event-block ajax_data_val fade"><div class="img-box"><div class="bg-img" style="background-image:url(../manage/event/register/images/' + data[i].img + ')"></div></div><div class="date">' + data[i].date + '</div><div class="event-txt">' + data[i].event + '</div><div class="price">¥' + data[i].price + '（+1drink）</div><div class="link flex"><div class="reserve"><button name="reserve" type="submit" value="' + data[i].id + '">予約</button></div><div class="detail"><a href="./detail/' + data[i].id + '">詳細</a></div></div></div>');
		});

        var dataNum = $('.event-block').length;
        var allNum = $('#id_number').text();
        if (dataNum == allNum) {
            $('#ajax_show').hide();
        }
        //console.log('通信成功');
        //console.log(dataNum);
    })

    // 通信が失敗した時
    .fail( function(data) {
        //console.log('通信失敗');
        console.log(data);
    });

    return false;
});





})(jQuery)
