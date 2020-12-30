(function ($) {
$('#ajax_show').on('click',function(){
    var id = $('#id').val();
    var lang = $("input[name='lyric_lang']:checked").val();
    console.log(lang);
    $.ajax({
        // リクエスト方法
        type: "GET",
        // 送信先ファイル名
        url: "http://syuto-ito.boo.jp/manage/ajax_lyrics.php",
        // 受け取りデータの種類
        datatype: "json",
        // 送信データ
        data:{
            // #id_numberのvalueをセット
            "id" : id
        }
    })

    // 通信が成功した時
    .done( function(data) {
        console.log(data);
        if (lang == 'en'){
            var lyric = data[0].lyric;
        } else if (lang == 'ja') {
            var lyric = data[0].lyric_ja;
        }
        $('#lyrics').addClass('show');
        $('#lyrics').css('background-image', 'url(./style/img/bg-img-' + data[0].album_id + '.jpg)');
        $('#lyrics').html('<div class="event-block ajax_data_val fade in"><div class="event-txt"><div class="title">' + data[0].title + '</div>' + lyric + '</div><div class="youtube"><iframe width="" height="" src="https://www.youtube.com/embed/' + data[0].movie_id + '" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div></div>');
        //console.log('通信成功');
    })

    // 通信が失敗した時
    .fail( function(data) {
        //console.log('通信失敗');
        console.log(data);
    });

    return false;
});



    

})(jQuery)