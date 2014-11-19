<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title>上传设置-<{jprass_config name="blog.title"}>-Powered by Joyphper</title>
        <link type="text/css" href="Css/admin.css" rel="stylesheet">
        <script type="text/javascript" src="../Script/jquery.min.js"></script>
    </head>
    <body>
        <{include file="../include/header.tpl"}>
        <{include file="../include/nav.tpl"}>
        <div class="breadcrumb wd">当前位置：<a href="index.php">首页</a>&gt;上传设置</div>
        <div class="main-panel wd">
			<div class="title_line">上传设置</div>
			<form class="form form-aligned" id="ajax-submit-form" action="index.php?c=options&a=upload" method="post">
                <div class="control-group">
                    <label>最大文件大小</label>
                    <input type="text" name="max_size" id="max_size" value="<{$options.max_size}>" class="large" />
					<span>KB，1MB = 1024 KB</span>
                </div>
                <div class="control-group">
                    <label>允许文件类型</label>
					<p>
						<span><input type="checkbox" value="true" name="file_ext_image" <{if $options.file_ext_image eq 'true'}>checked<{/if}>>图片文件 <strong>gif jpg png tiff bmp</strong></span><br/>
						<span><input type="checkbox" value="true" name="file_ext_media" <{if $options.file_ext_media eq 'true'}>checked<{/if}>>多媒体文件 <strong>mp3 wmv wma rmvb rm avi flv</strong></span><br/>
						<span><input type="checkbox" value="true" name="file_ext_doc" <{if $options.file_ext_doc eq 'true'}>checked<{/if}>>常用档案文件 <strong>txt doc docx xls xlsx ppt pptx zip rar pdf</strong></span><br/>
						<span>其他文件格式<input type="text" name="file_ext_other" value="<{$options.file_ext_other}>"></span> 用逗号 "," 将后缀名隔开, 例如: php,java,html,cpp<br/>
						
					</p>
                </div>
                <div class="control-group">
                    <label>&nbsp;</label>
                    <button class="btn" id="submit-btn" type="submit">提交保存</button>
                    <span id="validator-msg"></span>
                </div>
            </form>
        </div>
        <{include file="../include/footer.tpl"}>
    </body>
</html>