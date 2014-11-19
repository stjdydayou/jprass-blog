<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title>修改文章:<{$article.title}>-<{jprass_config name="blog.title"}>-Powered by Joyphper</title>
        <link type="text/css" href="Css/admin.css" rel="stylesheet">
        <script type="text/javascript" src="../Script/jquery.min.js"></script>
		<script type="text/javascript" src="../Script/xheditor/xheditor-1.1.14-zh_cn.min.js" charset="utf-8" ></script>
		<script type="text/javascript" src="../Script/jquery.sdialog.js"></script>
		<script type="text/javascript" src="Script/swfupload/swfupload.js"></script>
		<script type="text/javascript" src="Script/swfupload/swfupload.queue.js"></script>
		<script type="text/javascript" src="Script/swfupload/handler.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				editor=$('textarea[name="content"]').xheditor();
				
				$("#btn-save").click(function() {
					$("#status").val(2);
					$("#article-form").submit();
				});
				$("#btn-submit").click(function() {
					$("#status").val(1);
					$("#article-form").submit();
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
			<a href="index.php?c=<{$handle_ctrl}>">文章管理</a>&gt;
			修改文章:<{$article.title}></div>
        <div class="main-panel wd">
            <div class="title_line">修改文章:<{$article.title}></div>
            <form class="form form-stacked" id="article-form" action="index.php?c=article&a=edit" method="post">
				<input type="hidden" name="arcid" id="arcid" value="<{$article.id}>" />
				<input type="hidden" name="status" id="status" value="1" />
				<table cellspacing="0" align="center" width="960">
					<tr>
						<td>
							<label><strong>文章标题</strong></label>
							<input type="text" name="title" id="title" value="<{$article.title}>" class="xfull" />
							<!--<label><strong>关键字</strong></label>
							<input type="text" name="keywords" id="keywords" class="xfull" />-->
							<label><strong>描述</strong></label>
							<textarea name="description" id="description" class="xfull" style="height:40px;"><{$article.description}></textarea>
							<label><strong>内容</strong><span href="javascript:;" id="attach-btn"><a id="swfu-placeholder"></a></span></label>
							<ul class="upload-progress xfull" id="swfu-progress">
								<{foreach from=$article.upload item=upload key=i}>
								<li class="upload-progress-item clearfix" id="SWFUpload_0_0">
									<strong><{$upload.originalname}></strong>
									<small data_id="<{$upload.id}>" is_image="<{$upload.isImage}>" url="<{$upload.filepath}>">
										<a href="javascript:;" class="insert">插入</a> | <a href="javascript:;" class="delete">删除</a></small>
									<input type="hidden" name="upload[]" value="<{$upload.id}>">
								</li>
								<{/foreach}>
							</ul>
							<textarea name="content" id="content" class="xfull" style="height: 382px;"><{$article.content}></textarea>
							<label><strong>标签</strong></label>
							<input type="text" name="tags" id="tags" value="<{$article.tags}>" class="xxlarge" />
							<span>多个标签用英文","分开</span>
							<button class="btn" id="btn-save" type="button">保存草稿</button>
							<button class="btn" id="btn-submit" type="button">发布文章</button>
						</td>
						<td width="230" valign="top">
							<label><strong>时间</strong></label>
							<input type="text" name="_year" id="year" maxlength="4" style="width:35px" value="<{$article.dateline|date_format:'%Y'}>" />
							<span>-</span>
							<input type="text" name="_month" id="month" maxlength="2" style="width:20px" value="<{$article.dateline|date_format:'%m'}>" />
							<span>-</span>
							<input type="text" name="_day" id="day" maxlength="2" style="width:20px" value="<{$article.dateline|date_format:'%d'}>" />
							<span>@</span>
							<input type="text" name="_hour" id="hour" maxlength="2" style="width:20px" value="<{$article.dateline|date_format:'%H'}>" />
							<span>:</span>
							<input type="text" name="_min" id="min" maxlength="2" style="width:20px" value="<{$article.dateline|date_format:'%M'}>" />
							<label><strong>文章来源</strong></label>
							<input type="text" name="from" id="from" value="<{$article.from}>" class="xfull" />
							<label><strong>文章来源地址</strong></label>
							<input type="text" name="fromurl" id="fromurl" value="<{$article.fromurl}>" class="xfull" />
							<label><strong>分类</strong></label>
							<div class="select-cate">
								<{foreach from=$listCate item=cate key=i}>
								<label><input type="checkbox" name="cid[]" value="<{$cate.id}>" <{if $cate.id|in_array:$article.category}>checked<{/if}>/><{$cate.catename}></label>
								<{/foreach}>
							</div>
						</td>
					</tr>
				</table>
            </form>
        </div>
        <{include file="../include/footer.tpl"}>
    </body>
</html>