/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
var editor;

var fileDialogComplete = function(numFilesSelected, numFilesQueued) {
	try {
		this.startUpload();
	} catch (ex) {
		this.debug(ex);
	}
};

var uploadStart = function(file) {
	$("#swfu-progress").prepend('<li class="upload-progress-item clearfix" id="' + file.id + '"><strong>' + file.name + '</strong></li>');
};

var uploadSuccess = function(file, serverData) {
	var json = eval('(' + serverData + ')');
	var $el = $('#' + file.id);
	if (json.error === 0) {
		var $small = $('<small></small>');
		$small.attr('data_id', json.id).attr('is_image', json.isImage).attr('url', json.url);
		$small.html('<a href="javascript:;" class="insert">插入</a> | <a href="javascript:;" class="delete">删除</a>');
		$el.append($small);
		$small.find("a.insert").click(insertEditor);
		$small.find("a.delete").click(deleteUpload);

		$el.append('<input type="hidden" name="upload[]" value="' + json.id + '" />');
		$el.removeAttr('style');
	} else {
		$el.append(' 上传失败,' + json.message + '(' + json.error + ')');
		$el.css({
			'background-image': 'none',
			'color': '#FFFFFF',
			'background-color': '#CC0000'
		});
	}
};

var uploadComplete = function(file) {
};

var uploadError = function(file, errorCode, message) {
	var $el = $('#' + file.id);
	$el.append(' 上传失败,' + message + '(' + errorCode + ')');
	$el.css({
		'background-image': 'none',
		'color': '#FFFFFF',
		'background-color': '#CC0000'
	});
};

var uploadProgress = function(file, bytesLoaded, bytesTotal) {
	var $el = $('#' + file.id);
	var percent = Math.ceil((1 - (bytesLoaded / bytesTotal)) * $el.width());
	$el.css('background-position', '-' + percent + 'px 0');
};


var deleteUpload = function() {
	var $small = $(this).closest("small");
	var $li = $(this).closest("li");
	var ids = $small.attr('data_id');
	$.sdialog({content: "确定要删除此附件？"}).cancel(true).ok(function() {
		$.post('index.php?c=upload&a=delete', {"ids": ids}, function(data) {

			if (data.state){
				$li.remove();
			}else
				$.sdialog({content: data.message}).ok(function() {
					return true;
				}).icon("error");
		}, "json");
		return true;
	}).icon("confirm");
};
var insertEditor = function() {
	var $small = $(this).closest("small");
	var isImage = $small.attr('is_image');
	var url = $small.attr('url');
	if(isImage === 'true'){
		editor.pasteHTML('[img]'+url+'[/img]');
	}else{
		editor.pasteHTML('[file]'+url+'[/file]');
	}
};