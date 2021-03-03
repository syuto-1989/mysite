(function ($) {
  $('#select_year,#select_month').on({
      change : function() {
          // 要素取得と初期化
          var dateSelect = $('#select_day');
          dateSelect.empty();

          var year = $('[name=year] option:selected').text();
          var month = $('#select_month').val();
          console.log(year);
          console.log(month);

          // 閏年判定
          if (2 == month && (0 == year % 400 || (0 == year % 4 && 0 != year % 100))) {
              var last = 29;
          } else {
              var last = new Array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31)[month - 1];
          }

          //  日の要素生成
          var options = [];
          last += 1;
          for (var i = 1; i < last; i++) {
              var option = $('<option>').attr('value', i).text(i);
              options.push(option);
          }
          dateSelect.append(options);
      }
  });



})(jQuery)
