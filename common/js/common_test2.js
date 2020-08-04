/*const URL_API = "https://api.zipaddress.net/";

const vm = new Vue ({
  el: '#zip',
  data: {
    inputZip:'',
    defaultZip:'1000000',
    results:''
  },
  computed: {
    computedZip: function(){
      return !isNaN(this.inputZip) && this.inputZip.length == 7 ? this.inputZip : this.defaultZip
    }
  },
  methods: {
      getAddress: function(z){
        let params = {params:{zipcode: z}};
        axios
          .get(URL_API, params)
          .then(res => {
            this.results = res.data.code == 200 ? res.data.data.fullAddress : res.data.message;
        });
      }
    }
  })*/

  // YYYY-mm-dd HH:mm:ss
  //フィルター
Vue.filter('date-filter', function (val) {
  if (!val) return;
  return [val.getFullYear(),(val.getMonth()+1),val.getDate()]
    .join('-') + ' ' +
    [val.getHours(),val.getMinutes(),val.getSeconds()].join(':');
})

  var app = new Vue({
      el:'#app',
      data:{
        newItem:"",
        todos:[]
      },
      methods:{
        addItem:function(event){
          //alert();
          if(this.newItem == '')return;//タスク未入力の場合は追加しない
          var todo = {
            item: this.newItem,
            isDone:false
          };
          this.todos.push(todo);
          this.newItem = ''//タスク追加後に入力欄を空にする
        },
        deleteItem:function(index){ //indexを引数に指定
              this.todos.splice(index,1) //indexで指定された要素を1つ削除
            }
      }
})

  var app2 = new Vue({
  el:'#app2',
  data: {
    items: [],
    question: ''
  },
  methods: {
    add: function() {
      //console.log(this.question)
      var vm = this;
      axios.get('https://yesno.wtf/api')
      .then(function(response){
        console.log(response.data);
        var item = {
          date: new Date(),
          question: vm.question,
          answer: response.data.answer,
          image: response.data.image
        };
        vm.items.push(item);
      });
    }
  },
  computed: {
    total: function (){
      return this.items.length;
    },
    deleteItem:function(index){ //indexを引数に指定
          this.items.splice(index,1) //indexで指定された要素を1つ削除
        }
  }
})

Vue.component('my-component', {
  props: ['message'],
  template: '<h1>{{message}}</h1>'
});

Vue.component('my-button', {
    props: {
      label: {  // バリデーション
      type: String, // 文字列
      required: true  // 必須
    }
  },
  template: '<button v-on:click="clickLabel" style="background: #fff; color: #000;">{{ label }}</button>',
  methods: {
    clickLabel: function () {
      // イベント発火
      this.$emit('click', this.label);
    }
  },
});

Vue.component('my-spinner', {
  template: `<div class="my-spinner rotate" v-bind:style="style" v-show="loading"></div>`,
  props: {
    loading: {  // 表示・非表示のフラグ
      type: Boolean,
      default: true
    },
    color: {  // スピナーの色
      type: String,
      default: '#ffffff'
    },
    size: { // スピナーのサイズ
      type: Number,
      default: 16,
    }
  },
  computed: {
    style: function () {
      return {
        height: this.size + 'px',
        width: this.size + 'px',
        borderColor: this.color + ' ' + this.color + ' ' + 'transparent',
      };
    }
  }


});

new Vue ({
  el: '#main',
  data: {
      message: 'click my buttons',
  },
  methods: {
      labelClick: function (label) {
        this.message = label + ' button click!';
    }
  }
});

var app3 = new Vue({
    el: '#app3',
    data: {
    blogs: []
    },
    methods: {
      getBlogs: async function(){
              const response = await axios.get('http://syuto-ito.boo.jp/manage/json.php')
              console.log(response.data);

                  response.data.forEach(element => {
                      this.blogs.push({
                          title: element.title,
                          img: 'http://syuto-ito.boo.jp/manage/blog/register/images/' + element.img,
                      });
                  });

      },
      /*
        async getBlogs() {
        var url = 'http://syuto-ito.boo.jp/manage/json.php'
        await axios.get(url).then(x => {
          //console.log(x.data.comment);
            this.blogs = x.data
       })
     }
     */
        //getBlogs: function() {
          //console.log(this.question)
          //var vm = this;
        //  axios.get('http://syuto-ito.boo.jp/manage/json.php')
        //  .then(function(response){
        //    console.log(response.data);
          //  var item = {
          //    title: response.data.title,
            //  comment: response.data.comment
        //    };
        //    vm.blogs.push(item);
      //    });
        //}
    },
    mounted() {
        this.getBlogs()
    }
})
