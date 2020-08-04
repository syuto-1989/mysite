(function(){
	var CyberUnload = {};

	CyberUnload.addEvent = function(obj, type, func) {
    	if (obj.addEventListener) {
        	obj.addEventListener(type, func, false);
	    } else if (obj.attachEvent) {
    	    obj.attachEvent('on' + type, func);
    	}
	};

	CyberUnload.removeEvent = function(obj, type, func) {
    	if (obj.removeEventListener) {
        	obj.removeEventListener(type, func, false);
	    } else if (obj.detachEvent) {
    	    obj.detachEvent('on' + type, func);
	    }
	};

	CyberUnload.onload = function(elm, func) {
    	if ("onreadystatechange" in elm) {//IE
        	elm.onreadystatechange = function(e) {
            	if (elm.readyState === "loaded" || elm.readyState === "complete") {
                	return func(e);
            	}
        	};
    	} else {// Not IE
        	elm.onload = func;
    	}
	};

	CyberUnload.addEvent(window, 'load', function() {
		var i;
		var aObj = document.getElementsByTagName('A');
		var splits=[];

		for(i=0; i < aObj.length; i++) {
			splits = aObj[i].className.split(' ');
			if (splits.indexOf('extmove') < 0){
				continue;
			}
			//alert(aObj[i].protocol + ' : ' + aObj[i].className);
			CyberUnload.addEvent(aObj[i], 'click', function(ev) {
				if(window.confirm('お問い合わせは完了しておりません。このページから移動してもよろしいですか？')){
					return true;
				}
				ev.preventDefault();
				ev.stopPropagation();
				return false;
			});
		}
	});
})();
