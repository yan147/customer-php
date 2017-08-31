layui.use([ 'element', 'layer',"navtab"], function() {
	var $ = layui.jquery,
	element = layui.element,
	navtab = layui.navtab;
	// iframe自适应
	$(window).on('resize', function() {
		var $obj = $('#tabContainers');
		$obj.height($(this).height() - 200);
		$obj.find('iframe').each(function() {
			$(this).height($obj.height());
		});
	}).resize();
	
	//监听侧边导航按钮
	element.on('nav(sidebar)',function($elem) {
		var $a = $elem.find("a");
		var data = {
			url : $a.data("url"),
			title : $a.children("span").text()
		}
		if (data.url != undefined) {
			navtab.tabAdd(data);
			// frame高度自适应
			var $content = $('.layui-tab-content');
			$content.find('iframe').each(function() {
				$(this).height($content.height());
			});
		}
	});

})