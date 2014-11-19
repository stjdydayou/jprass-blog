<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title>修改页面:<{$page.title}>-<{jprass_config name="blog.title"}>-Powered by Joyphper</title>
        <link type="text/css" href="Css/admin.css" rel="stylesheet">
        <script type="text/javascript" src="../Script/jquery.min.js"></script>
		<script type="text/javascript" src="../Script/xheditor/xheditor-1.1.14-zh_cn.min.js" charset="utf-8" ></script>
		<script type="text/javascript" src="../Script/jquery.sdialog.js"></script>
		<script type="text/javascript" src="Script/swfupload/swfupload.js"></script>
		<script type="text/javascript" src="Script/swfupload/swfupload.queue.js"></script>
		<script type="text/javascript" src="Script/swfupload/handler.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				editor = $('textarea[name="content"]').xheditor();

				$("#btn-save").click(function() {
					$("#status").val(2);
					$("#page-form").submit();
				});
				$("#btn-submit").click(function() {
					$("#status").val(1);
					$("#page-form").submit();
				});

				$('#swfu-progress a.insert').click(insertEditor);
				$('#swfu-progress a.delete').click(deleteUpload);
				var settings = {
					flash_url: "Script/swfupload/swfupload.swf",
					upload_url: "index.php",
					post_params: {"c": "upload", "a": "handler", 'PHPSESSID': '<{$smarty.cookies.PHPSESSID}>'},
					file_size_limit: "<{$maxSize}>",
					file_types: "<{$extArr}>",
					file_types_description: "所有文件",
					file_upload_limit: 0,
					file_queue_limit: 0,
					// Button Settings
					button_placeholder_id: "swfu-placeholder",
					button_text: '上传文件',
					button_image_url: "Css/swfupload_btn.png",
					button_width: 61,
					button_height: 22,
					button_window_mode: SWFUpload.WINDOW_MODE.TRANSPARENT,
					button_cursor: SWFUpload.CURSOR.HAND,
					//Handle Settings
					file_dialog_complete_handler: fileDialogComplete,
					upload_start_handler: uploadStart,
					upload_progress_handler: uploadProgress,
					upload_success_handler: uploadSuccess,
					queue_complete_handler: uploadComplete,
					upload_error_handler: uploadError
				};
				new SWFUpload(settings);
			});
		</script>
    </head>
    <body>
        <{include file="../include/header.tpl"}>
        <{include file="../include/nav.tpl"}>
        <div class="breadcrumb wd">当前位置：
			<a href="index.php">首页</a>&gt;
			<a href="index.php?c=<{$handle_ctrl}>">文章页面</a>&gt;
			修改页面:<{$page.title}></div>
        <div class="main-panel wd">
            <div class="title_line">修改页面:<{$page.title}></div>
            <form class="form form-stacked" id="page-form" action="index.php?c=page&a=edit" method="post" style="margin:0 10px;">
				<input type="hidden" name="arcid" id="arcid" value="<{$page.id}>" />
				<input type="hidden" name="status" id="status" value="1" />
				<label><strong>标题</strong></label>
				<input type="text" name="title" id="title" value="<{$page.title}>" class="xfull" />
				<label><strong>描述</strong></label>
				<textarea name="description" id="description" class="xfull" style="height:40px;"><{$page.description}></textarea>
				<label><strong>内容</strong><span href="javascript:;" id="attach-btn"><a id="swfu-placeholder"></a></span></label>
				<ul class="upload-progress xfull" id="swfu-progress">
					<{foreach from=$page.upload item=upload key=i}>
					<li class="upload-progress-item clearfix" id="SWFUpload_0_0">
						<strong><{$upload.originalname}></strong>
						<small data_id="<{$upload.id}>" is_image="<{$upload.isImage}>" url="<{$upload.filepath}>">
							<a href="javascript:;" class="insert">插入</a> | <a href="javascript:;" class="delete">删除</a></small>
						<input type="hidden" name="upload[]" value="<{$upload.id}>">
					</li>
					<{/foreach}>
				</ul>
				<textarea name="content" id="content" class="xfull" style="height: 382px;"><{$page.content}></textarea>
				<label><strong>标签</strong></label>
				<input type="text" name="tags" id="tags" value="<{$page.tags}>" class="xxlarge" />
				<span>多个标签用英文","分开</span>
				<div style="text-align: right">
					<button class="btn" id="btn-save" type="button">保存草稿</button>
					<button class="btn" id="btn-submit" type="button">发布</button>
				</div>
            </form>
        </div>
        <{include file="../include/footer.tpl"}>
    </body>
</html>