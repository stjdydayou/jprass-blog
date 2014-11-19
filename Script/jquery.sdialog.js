/*!
 * jdialog 1.0.0
 * Date: 2013-06-27
 * http://code.google.com/p/sdialog/
 * (c) 2009-2012 joyphper, http://www.joyphper.net
 * var dialog = $.sdialog({	
 title:"标题1",
 ok:function(){alert("确认");},
 cancel:true,
 content:"系统运行的内存：<%=runtime.totalMemory()/1024/1024%> M"
 });
 
 dialog.close();
 dialog.content({type:"ajax",content:"/test.html"});
 dialog.title("可以设置标题");
 dialog.content("可以直接设置内容");
 dialog.content({type:"string",conteng:"可以指定string类型设置内容"});
 dialog.cancel(true); //点击cancel直接关闭
 dialog.cancel(function(){
 alert("取消");
 });
 dialog.cancelVal("取消BT的名字");
 dialog.ok(true); //点击OK直接关闭
 dialog.ok(function(){
 alert("确认");
 });
 dialog.okVal("取消BT的名字");
 */

;
(function($) {
	var dialog = function(settings) {
		settings = jQuery.extend(dialog.settings, settings);
		return new dialog.fn._init(settings);
	};

	dialog.settings = {
		version: "1.0.0", //版本号
		style: "sdialog/jquery.sdialog.css", //样式文件
		title: '系统提示', // 默认标题
		ok: false, //确认按钮的回调方法
		okVal: "确定", // 确定按钮文本. 默认''
		cancel: false, //取消按钮的回调方法
		cancelVal: '取消', // 取消按钮文本. 默认'取消'
		content: "", //内容
		width: 0, //宽度
		height: 0, //高度
		drag: true, //允许拖拽
		layer: true						//固定背景
	};

	var sequence = 1;

	dialog.fn = dialogFN = {
		_init: function(settings) {
			var that = this;
			that.sequence = sequence++;
			that.settings = settings;

			$("body").append("<div class='system_dialog' id='system_dialog_" + that.sequence + "'></div>");
			that.DOM = $("#system_dialog_" + that.sequence);
			that.DOM.append("<div class='dialog_title' id='dialog_title'><font></font><a href='javascript:void(0);' id='dialog_close'>×</a></div>");
			that.DOM.append("<div class='dialog_content' id='dialog_content'></div>");
			that.DOM.append("<div class='dialog_buttons' id='dialog_buttons'></div>");
			that.DOM.find("#dialog_title > font").html(that.settings.title);
			that.DOM.find("#dialog_buttons").hide();

			that.DOM.css({'position': 'fixed', 'left': '0', 'top': '0'});

			jQuery.extend(that, dialog.fn)
			if (settings.ok != false) {
				that.ok(settings.ok, settings.okVal);
			}
			if (settings.cancel != false)
				that.cancel(settings.cancel, settings.cancelVal);
			if (settings.content != "" && settings.content != undefined)
				that.content(settings.content);
			if (settings.icon != undefined && settings.icon != "")
				that.DOM.find("#dialog_content").addClass(icon);

			if (that.settings.cancel == true || that.settings.cancel == false) {
				that.DOM.find("#dialog_close").click(function() {
					that.close();
				});
			} else {
				that.DOM.find("#dialog_close").click(function() {
					var result = that.settings.cancel();
					that.close();
				});
			}

			if (settings.drag == true) {
				that._drag();
			}

			if (settings.layer == true) {
				that._layer();
			}
			$(window).resize(function() {
				that._reposition();
				if (settings.layer == true && $("#mask_layer_" + that.sequence).length > 0) {
					that._layer();
				}
			});
			return that;
		},
		close: function() {
			this.DOM.remove();
			$("#mask_layer_" + this.sequence).remove();
			return this;
		},
		title: function(title) {
			this.DOM.find("#dialog_title > font").text(title);
			return this;
		},
		content: function(s) {
			var that = this;
			if (typeof s === 'string' || s.nodeType === 1) {
				that.DOM.find("#dialog_content").html(s);
			} else {

				var type = s.type;
				var content = s.content;
				if (type == "" || type == undefined || (type != 'string' && type != 'ajax')) {
					return;
				}

				if (type == "string") {
					that.DOM.find("#dialog_content").html(s.content);
				}

				if (type == "ajax") {
					that.DOM.find("#dialog_content").html("数据加载中。。。");
					$.ajax({url: s.content, cache: false, dataType: "text",
						success: function(data)
						{
							that.DOM.find("#dialog_content").html(data);
						},
						error: function(XMLHttpRequest, textStatus, errorThrown) {
							that.DOM.find("#dialog_content").html("加载用户信息失败！请刷新页面。");
						}
					});
				}
			}

			if (that.settings.width == 0 && that.settings.height == 0) {
				that._resize();
			} else {
				if (that.settings.width != 0)
					that.DOM.css("width", that.settings.width + "px");
				if (that.settings.height != 0)
					that.DOM.css("height", that.settings.height + "px");
			}

			that._reposition();
			return that;
		},
		cancel: function(callback, cancelVal) {
			var that = this;

			that.settings.cancelVal = cancelVal != '' && cancelVal != undefined ? cancelVal : that.settings.cancelVal;

			that.settings.cancel = callback;

			that.DOM.find("#dialog_buttons").find('#dialog_cancel').remove();

			if (that.settings.cancel == false)
				return this;

			that.DOM.find("#dialog_buttons").append('<input type="button" value="' + that.settings.cancelVal + '" id="dialog_cancel"/>').show();

			if (that.settings.cancel == true) {
				that.DOM.find("#dialog_cancel").click(function() {
					that.close();
				});
			} else {
				that.DOM.find("#dialog_cancel").click(function() {
					var result = that.settings.cancel();
					if (result == true) {
						that.close();
					}
				});
			}
			return this;
		},
		calcelVal: function(cancelVal) {

			var that = this;

			cancelVal = cancelVal != '' && cancelVal != undefined ? cancelVal : that.settings.cancelVal;

			that.DOM.find("#dialog_cancel").val(cancelVal);

		}
		,
		ok: function(callback, okVal) {
			var that = this;

			that.settings.okVal = okVal != '' && okVal != undefined ? okVal : that.settings.okVal;

			that.settings.ok = callback;

			that.DOM.find("#dialog_buttons").find('#dialog_ok').remove();

			if (that.settings.ok == false)
				return this;

			that.DOM.find("#dialog_buttons").append('<input type="button" value="' + that.settings.okVal + '" id="dialog_ok"/>').show();

			if (that.settings.ok == true) {
				that.DOM.find("#dialog_ok").click(function() {
					that.close();
				});
			} else {
				that.DOM.find("#dialog_ok").click(function() {
					var result = that.settings.ok();
					if (result == true) {
						that.close();
					}
				});
			}
			return this;
		},
		okVal: function(okVal) {

			var that = this;

			okVal = okVal != '' && okVal != undefined ? okVal : that.settings.okVal;

			that.DOM.find("#dialog_ok").val(okVal);

		},
		icon: function(icon) {
			var that = this;
			if (icon != "" && icon != undefined)
				that.DOM.find("#dialog_content").addClass(icon);
		},
		_resize: function() {
			var width = $(this.DOM).width();
			var height = $(this.DOM).height();
			if (width < 300) {
				this.DOM.css("width", "300px");
			}
		},
		_reposition: function() {
			var width = $(this.DOM).width();
			var height = $(this.DOM).height();

			var _height = $(window).height() < $(document).height() ? $(window).height() : $(document).height();
			var _width = $(window).width() < $(document).width() ? $(window).width() : $(document).width();

			var left = (_width - width) / 2;
			var top = (_height - height) / 4;
			this.DOM.css("left", left + "px").css("top", top + "px");
		},
		_layer: function() {
			$("#mask_layer_" + this.sequence).remove();
			var maxHeight = $(window).height() > $(document).height() ? $(window).height() : $(document).height();
			var maxWidth = $(window).width() > $(document).width() ? $(window).width() : $(document).width();
			$("body").append("<div id='mask_layer_" + this.sequence + "' class='mask_layer'></div>");
			$("#mask_layer_" + this.sequence).css("height", maxHeight + "px").css("width", maxWidth + "px");
		}
		,
		_drag: function() {
			var that = this;
			var title = that.DOM.find("#dialog_title > font");
			var draging = false;
			var startLeft, startTop;
			var startX, startY;


			title.css('cursor', 'move').css('position', 'fixed');
			$(title).mousedown(function(event) {
				var offset = $(that.DOM).offset();
				startLeft = offset.left;
				startTop = offset.top;
				startX = event.clientX;
				startY = event.clientY;
				draging = true;
			}).mousemove(function(event) {
				if (draging == false)
					return;
				var deltaX = event.clientX - startX;
				var deltaY = event.clientY - startY;
				var left = startLeft + deltaX;
				var top = startTop + deltaY;
				if (left < 0)
					left = 0;
				if (top < 0)
					top = 0
				$(that.DOM).css('left', left + 'px').css('top', top + 'px');
			}).mouseup(function(event) {
				draging = false;
			}).mouseout(function(event) {
				draging = false;
			});
		}
	};

	$.sdialog = function(s) {
		return dialog(s);
	};

	var _thisScript;
	var _path = window['_artDialog_path'] || (function(script, i, me) {
		for (i in script) {
			// 如果通过第三方脚本加载器加载本文件，请保证文件名含有"artDialog"字符
			if (script[i].src && script[i].src.indexOf('artDialog') !== -1)
				me = script[i];
		}
		;

		_thisScript = me || script[script.length - 1];
		me = _thisScript.src.replace(/\\/g, '/');
		return me.lastIndexOf('/') < 0 ? '.' : me.substring(0, me.lastIndexOf('/'));
	}(document.getElementsByTagName('script')));

	$(_thisScript).before('<link rel="stylesheet" href="' + _path + '/' + dialog.settings.style + '?' + dialog.settings.version + '">');

})(jQuery);
