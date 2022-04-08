<footer>
	<p>2022 Ryosuke Suzuki.</p>
</footer>
<!----- /footer ----->
<!-- jQuery -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://coco-factory.jp/ugokuweb/wp-content/themes/ugokuweb/data/5-2-4/js/5-2-4.js"></script>
<!-- slickのJavaScript -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script>
	$('.slider').slick({
		dots: true,
		autoplay: true, //自動的に動き出すか。初期値はfalse。
		infinite: true, //スライドをループさせるかどうか。初期値はtrue。
		speed: 150,
		arrows: true,
		swipe: true,
		slidesToShow: 4,
		slidesToScroll: 4,
		responsive: [{
				breakpoint: 1024,
				settings: {
					slidesToShow: 3,
					slidesToScroll: 3,
					infinite: true,
					dots: true
				}
			},
			{
				breakpoint: 600,
				settings: {
					slidesToShow: 2,
					slidesToScroll: 2
				}
			},
			{
				breakpoint: 480,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1
				}
			}
			// You can unslick at a given breakpoint now by adding:
			// settings: "unslick"
			// instead of a settings object
		]
	});
</script>

<script>
	$(".openbtn4").click(function() {
		$(this).toggleClass('active');
		$("#g-nav").toggleClass('panelactive');
	});

	$("#g-nav a").click(function() { //ナビゲーションのリンクがクリックされたら
		$(".openbtn4").removeClass('active'); //ボタンの activeクラスを除去し
		$("#g-nav").removeClass('panelactive'); //ナビゲーションのpanelactiveクラスも除去
	});
</script>
<?php wp_footer() ?>
</body>

</html>