(function(t){function e(e){for(var n,r,s=e[0],o=e[1],c=e[2],p=0,f=[];p<s.length;p++)r=s[p],Object.prototype.hasOwnProperty.call(a,r)&&a[r]&&f.push(a[r][0]),a[r]=0;for(n in o)Object.prototype.hasOwnProperty.call(o,n)&&(t[n]=o[n]);u&&u(e);while(f.length)f.shift()();return l.push.apply(l,c||[]),i()}function i(){for(var t,e=0;e<l.length;e++){for(var i=l[e],n=!0,s=1;s<i.length;s++){var o=i[s];0!==a[o]&&(n=!1)}n&&(l.splice(e--,1),t=r(r.s=i[0]))}return t}var n={},a={app:0},l=[];function r(e){if(n[e])return n[e].exports;var i=n[e]={i:e,l:!1,exports:{}};return t[e].call(i.exports,i,i.exports,r),i.l=!0,i.exports}r.m=t,r.c=n,r.d=function(t,e,i){r.o(t,e)||Object.defineProperty(t,e,{enumerable:!0,get:i})},r.r=function(t){"undefined"!==typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})},r.t=function(t,e){if(1&e&&(t=r(t)),8&e)return t;if(4&e&&"object"===typeof t&&t&&t.__esModule)return t;var i=Object.create(null);if(r.r(i),Object.defineProperty(i,"default",{enumerable:!0,value:t}),2&e&&"string"!=typeof t)for(var n in t)r.d(i,n,function(e){return t[e]}.bind(null,n));return i},r.n=function(t){var e=t&&t.__esModule?function(){return t["default"]}:function(){return t};return r.d(e,"a",e),e},r.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},r.p="";var s=window["webpackJsonp"]=window["webpackJsonp"]||[],o=s.push.bind(s);s.push=e,s=s.slice();for(var c=0;c<s.length;c++)e(s[c]);var u=o;l.push([0,"chunk-vendors"]),i()})({0:function(t,e,i){t.exports=i("56d7")},"0211":function(t,e,i){},"034f":function(t,e,i){"use strict";var n=i("85ec"),a=i.n(n);a.a},"08c5":function(t,e,i){t.exports=i.p+"img/artwork4.37e33402.jpg"},"14be":function(t,e,i){t.exports=i.p+"img/artwork2.98d66de1.png"},"15b9":function(t,e,i){},"25b5":function(t,e,i){},"3b87":function(t,e,i){},"3c32":function(t,e,i){"use strict";var n=i("0211"),a=i.n(n);a.a},"56d7":function(t,e,i){"use strict";i.r(e);i("e260"),i("e6cf"),i("cca6"),i("a79d");var n=i("2b0e"),a=function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("div",{attrs:{id:"app"}},[i("tab-menu"),i("router-view")],1)},l=[],r=function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("div",[i("ol",t._l(t.items,(function(e,n){return i("li",{key:n},[i("router-link",{attrs:{to:e.path}},[t._v(" "+t._s(e.title)+" ")])],1)})),0)])},s=[],o={name:"TabMenu",data:function(){return{items:[{title:"top",path:"/"},{title:"profile",path:"/profile"},{title:"skills",path:"/skills"},{title:"outputs",path:"/outputs"},{title:"graphic",path:"/graphic"}]}}},c=o,u=(i("b91c"),i("2877")),p=Object(u["a"])(c,r,s,!1,null,"1870a821",null),f=p.exports,d={name:"App",components:{TabMenu:f}},m=d,v=(i("034f"),Object(u["a"])(m,a,l,!1,null,null,null)),_=v.exports,b=i("8c4f"),h=function(){var t=this,e=t.$createElement;t._self._c;return t._m(0)},g=[function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{staticClass:"hello"},[n("h1",[t._v("Syuto Ito Portfolio Site")]),n("div",{staticClass:"img"},[n("img",{attrs:{src:i("84ec")}})])])}],y={name:"HelloWorld",props:{msg:String}},j=y,x=(i("d671"),Object(u["a"])(j,h,g,!1,null,"00c9e162",null)),C=x.exports,k=function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("div",{staticClass:"output"},[i("div",{staticClass:"content"},[i("ul",t._l(t.items,(function(e,n){return i("li",{key:n},[i("div",{staticClass:"ttl"},[i("a",{attrs:{href:e.link}},[t._v(t._s(e.title))])]),i("div",{staticClass:"txt"},[t._v(t._s(e.detail))])])})),0)])])},O=[],w={name:"Output",data:function(){return{name:"自主制作",text:"",items:[{title:"音楽活動宣伝用LP",detail:"",link:"http://syuto-ito.boo.jp/"},{title:"WEBチケット予約システム ",detail:"ライブのチケット予約用システム。送信フォームと連動している。",link:"http://syuto-ito.boo.jp/event/"},{title:"管理画面ログイン ",detail:"公演を登録する管理画面。(email:test@co.jp、pass:test1234でログインできます。)",link:"http://syuto-ito.boo.jp/manage/"}]}}},P=w,S=(i("3c32"),Object(u["a"])(P,k,O,!1,null,"0611d61e",null)),E=S.exports,M=function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("div",{staticClass:"profile"},[i("div",{staticClass:"content"},[t._m(0),i("div",{staticClass:"profile_txt"},[i("h3",[t._v(" "+t._s(t.name)+" ")]),i("p",{staticClass:"en"},[t._v(" "+t._s(t.name_en)+" ")]),i("p",{domProps:{innerHTML:t._s(t.text)}}),i("ul",t._l(t.items,(function(e,n){return i("li",{key:n},[i("div",{staticClass:"ttl"},[t._v(t._s(e.title))]),i("div",{staticClass:"txt"},[t._v(t._s(e.detail))])])})),0)])])])},$=[function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{staticClass:"profile-img"},[n("img",{attrs:{src:i("84ec")}})])}],L={name:"Profile",data:function(){return{name:"伊藤 秀人",name_en:"Syuto Ito",text:"元来からもの作りが好きで、これを活かして仕事にできるスキルを身に付けようと思い、2018年春頃よりWEB制作の学習を独学で開始する。<br>2018年11月にWEB制作会社へ実務未経験で入社。入社2ヵ月目でWEBサイトの下層ページ約6ページ分のデザイン・コーディングを約5日間で行う。<br>当初はWEBデザインがやりたいと考えていたが、業務でプログラミングにも触れていく中で、開発をやりたいという思いが強くなる。<br>将来的にはフロントエンド、バックエンド両方をカバーできるエンジニアになりたいと考えており、PHPは一人称での開発が可能、また現在Vue.jsを独学にて学習中。<br>未経験での入社だったため当初は苦労したが、その環境を楽しむことでスキルを高めることができ、困難であればあるほど成長できるタイプであると自負している。",items:[{title:"生年月日",detail:"1989/01/11"},{title:"年齢",detail:"31歳"},{title:"出身",detail:"福井県"},{title:"好きな映画",detail:"「青い春」、「パーマネントバケーション」、「ストレンジャー・ザン・パラダイス」"}]}}},W=L,T=(i("788a"),Object(u["a"])(W,M,$,!1,null,"772330d6",null)),H=T.exports,I=function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("div",{staticClass:"skills"},[i("div",{staticClass:"content"},[i("div",{staticClass:"profile_txt"},[i("h3",[t._v(" "+t._s(t.name)+" ")]),i("p",{staticClass:"en"},[t._v(" "+t._s(t.name_en)+" ")]),i("ul",t._l(t.items,(function(e,n){return i("li",{key:n},[i("div",{staticClass:"ttl"},[t._v(t._s(e.title))]),i("div",{staticClass:"txt"},[t._v(t._s(e.detail))])])})),0)])])])},B=[],J={name:"Skills",data:function(){return{name:"伊藤 秀人",name_en:"Syuto Ito",items:[{title:"PHP",detail:"実務1年～2年"},{title:"JavaScript ",detail:"実務1年～2年"},{title:"Photoshop",detail:"実務1年～2年"},{title:"Illustrator",detail:"実務1年～2年"},{title:"DreamWeaver ",detail:"実務1年未満"},{title:"CSS",detail:"実務1年～2年"},{title:"HTML",detail:"実務1年～2年"},{title:"Sass",detail:"実務1年"},{title:"jQuery",detail:"実務1年～2年"},{title:"Laravel",detail:"実務1年～2年"},{title:"MySQL",detail:"実務1年～2年"},{title:"Vue.js",detail:"独学"},{title:"Git",detail:"独学"},{title:"LAMP構築",detail:"独学"},{title:"グラフィックデザイン",detail:"独学"}]}}},V=J,q=(i("e2a0"),Object(u["a"])(V,I,B,!1,null,"e0f365b0",null)),A=q.exports,Q=function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("div",{staticClass:"graphic"},[i("div",{staticClass:"content"},[i("ul",{staticClass:"image-list"},t._l(t.blogs,(function(e,n){return i("li",{key:n},[i("div",{staticClass:"box"},[i("div",{staticClass:"ttl"},[t._v(t._s(e.title))]),i("div",{staticClass:"img"},[i("img",{attrs:{src:e.img}})])])])})),0)])])},D=[],G={name:"ImageList",data:function(){return{blogs:[{title:"アートワーク1",img:i("d106")},{title:"アートワーク2",img:i("14be")},{title:"アートワーク3",img:i("aca4")},{title:"アートワーク4",img:i("08c5")}]}}},z=G,F=(i("c9f2"),Object(u["a"])(z,Q,D,!1,null,"610d66dc",null)),K=F.exports;n["a"].use(b["a"]);var N=new b["a"]({routes:[{path:"/",name:"HelloWorld",component:C},{path:"/outputs",name:"Output",component:E},{path:"/profile",name:"Profile",component:H},{path:"/skills",name:"Skills",component:A},{path:"/graphic",name:"ImageList",component:K}]});n["a"].config.productionTip=!1,new n["a"]({router:N,render:function(t){return t(_)}}).$mount("#app"),new Vue2({el:"#app2",data:{question:""},methods:{add:function(){console.log(this.question)}}})},"788a":function(t,e,i){"use strict";var n=i("25b5"),a=i.n(n);a.a},"84a1":function(t,e,i){},"84ec":function(t,e,i){t.exports=i.p+"img/my-photo.1257bc66.jpg"},"85ec":function(t,e,i){},aca4:function(t,e,i){t.exports=i.p+"img/artwork3.17c23c97.jpg"},b91c:function(t,e,i){"use strict";var n=i("3b87"),a=i.n(n);a.a},c9f2:function(t,e,i){"use strict";var n=i("15b9"),a=i.n(n);a.a},d106:function(t,e,i){t.exports=i.p+"img/artwork1.6214d463.jpg"},d671:function(t,e,i){"use strict";var n=i("db34"),a=i.n(n);a.a},db34:function(t,e,i){},e2a0:function(t,e,i){"use strict";var n=i("84a1"),a=i.n(n);a.a}});
//# sourceMappingURL=app.6e3165bb.js.map