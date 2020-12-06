<?php
//--------ページ設定--------//
	$ttl = "";
	$dec = "";
	$kw = "";

//-----------------------//
?>
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.min.js"></script>

<?php
include("common/php/header.php")?>
<style>
ul {
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
}
li {
    width: 50%;
    padding: 5px;
}
.img {
    width: 100%;
    max-width: 100%;
}
img {
    width: 100%;
    background: #fff;
}
    
</style>
<main>
<section id="top">
    <div class="content-wrap">
    <div class="top-container" style="color: #fff;">
<!---
	<div id="app3">
		<ul>
			<li v-for="(blog,index) in blogs" :key=index>
				<div class="ttl">{{ blog.title }}</div>
				<div class="img"><img v-bind:src="blog.img" width="100" height="100"></div>
		  </li>
		</ul>
	</div>
--->
	<div id="app4">
		<graphics></graphics>
	</div>

    </div>
    </div>
</section>

<script src="http://syuto-ito.boo.jp/common/js/common_test2.js"></script>

</main>
