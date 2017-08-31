layui.define(['element'], function(exports){
   var  element = layui.element,
//		layer = parent.layer === undefined ? layui.layer : parent.layer,
        $ = layui.jquery;
	var $titleBox=	$('ul.layui-tab-title');
   

	/**
	 * 根据tabTitle获取该tab的id,如果尚未创建则返回-1
	 */
   var getTabId = function(title) {
	    var	tabId=-1;
		$titleBox.find('li').each(function(i, e) {
			var $em = $(this).children('span');
			if ($em.text() === title) {
				tabId=title;
				return false;
			}
		});
		return tabId;
	}
   var navtab = {
	   /**
	     * [tabAdd 增加选项卡，如果已存在则切换到此tab]
	     * @param  data--- {title:"",url:"",icon:""}
	     */
	     tabAdd : function(data){
		    var tabId = getTabId(data.title);
		    if (tabId === -1) {
				// 创建新tab
				element.tabAdd('page-tab', {
					id:data.title,
					title : '<span>' + data.title + '</span>',
					content : "<iframe src=\"" + data.url + "\" class=\"layui-iframe\"></iframe>"
				});
				// 切换到此tab
				element.tabChange('page-tab',  data.title);
			} else {
				element.tabChange('page-tab', tabId);
			}
	    }
   };
   
   exports("navtab",navtab);
    
});
