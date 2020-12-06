(function ($) {

  // レコードを全件表示する
  // 試しに関数にしてみただけ
  function getAllData(){
      $.ajax({
          // 通信先ファイル名
          url: "/manage/ajax_test_show_all.php",
          // 通信が成功した時
          success: function(data) {
              // 取得したレコードをeachで順次取り出す
              $.each(data, function(key, value){
                  // #all_show_result内にappendで追記していく
                  //$('#all_show_result').append("<tr><td>" + value.id + "</td><td>" + value.name + "</td><td>" + value.price + "</td></tr>");
                  $('#all_show_result').append(
                    '<div class="event-block fade"><div class="img-box"><div class="bg-img" style="background-image:url(/manage/blog/register/images/'+ value.img +')"></div></div><div class="date">'+ value.date +'</div><div class="event-txt">'+ value.title +'</div><div class="price">'+ value.comment +'</div><div class="link flex"><div class="detail"><a href="./detail/index.php?id='+ value.id +'">詳細</a></div></div></div>'
                  );
              });

              console.log("通信成功");
              console.log(data);
          },

          // 通信が失敗した時
          error: function(){
              console.log("通信失敗");
              console.log(data);
          }
      });
  }

  // 関数を実行
  getAllData();


})(jQuery)
