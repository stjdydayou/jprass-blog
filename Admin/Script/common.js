$(document).ready(function() {
	$(".checkedCtrl").click(function() {
		var thisChecked = $(this).attr("checked");
		if (thisChecked) {
			$("input[type='checkbox']").attr('checked', true);
		} else {
			$("input[type='checkbox']").attr('checked', false);
		}
	});
	$(".ajax-bulk-action").click(function() {
		var ids = "";
		$("td").find("input[type='checkbox']:checked").each(function() {
			if (ids !== '')
				ids += ",";
			ids += $(this).val();

		});
		var tip = $(this).attr("tip");
		if (typeof(tip) === 'undefined')
			tip = "您确定要执行此操作？";
		var actionUrl = $(this).attr("action");
		if (ids === '') {
			$.sdialog({content: "您还没有选择需要操作的记录！"}).ok(true).icon("error");
			return false;
		}
		$.sdialog({content: tip}).cancel(true).ok(function() {
			$.post(actionUrl, {"ids": ids}, function(data) {
				var dialog = $.sdialog({content: data.message}).ok(function() {
					if (typeof(data.needRefresh) !== 'undefined' && data.needRefresh === true)
						window.location.reload();
					return true;
				});
				if (data.state)
					dialog.icon("success");
				else
					dialog.icon("error");
			}, "json");
			return true;
		}).icon("confirm");

	});
});


