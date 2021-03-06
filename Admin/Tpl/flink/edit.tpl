<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title>修改链接:<{$flink.name}>-<{jprass_config name="blog.title"}>-Powered by Joyphper</title>
        <link type="text/css" href="Css/admin.css" rel="stylesheet">
        <script type="text/javascript" src="../Script/jquery.min.js"></script>
        <script type="text/javascript" src="../Script/jquery.form-validator.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				$.validate();
			});
		</script>
    </head>
    <body>
        <{include file="../include/header.tpl"}>
        <{include file="../include/nav.tpl"}>
        <div class="breadcrumb wd">当前位置：
			<a href="index.php">首页</a>&gt;
			<a href="index.php?c=<{$handle_ctrl}>">链接管理</a>&gt;
			修改链接:<{$flink.name}>
		</div>
        <div class="main-panel wd">
            <div class="title_line">修改链接：<{$flink.name}></div>
			<div id="validator-msg"></div>
            <form class="form form-aligned" id="ajax-submit-form" action="index.php?c=flink&a=edit" method="post">
				<input type="hidden" name="id" value="<{$flink.id}>"/>
                <div class="control-group">
                    <label>链接名</label>
                    <input type="text" name="name" id="name" value="<{$flink.name}>" data-rule="链接名:required" class="large" />
                    <span class="required">*</span>
                </div>
                <div class="control-group">
                    <label>链接地址</label>
                    <input type="text" name="url" id="url" value="<{$flink.url}>" data-rule="链接地址:required" class="xxlarge" />
                    <span class="required">*</span>
					<span>别忘了加上http://</span>
                </div>
                <div class="control-group">
                    <label>LOGO地址</label>
                    <input type="text" name="logo" id="logo" value="<{$flink.logo}>" class="xxlarge" />
					<span>别忘了加上http://</span>
                </div>
                <div class="control-group">
                    <label>描述</label>
                    <textarea name="description" class="xxlarge"><{$flink.description}></textarea>
                </div>
                <div class="control-group">
					<label>是否隐藏</label>
					<span><input type="radio" name="visible" value="Y" <{if $flink.visible=='Y'}>checked<{/if}> />显示</span>
                    <span><input type="radio" name="visible" value="N" <{if $flink.visible=='N'}>checked<{/if}>/>隐藏</span>
                </div>
                <div class="control-group">
                    <label>&nbsp;</label>
                    <button class="btn" id="submit-btn" type="submit">提交保存</button>
                </div>
            </form>
        </div>
        <{include file="../include/footer.tpl"}>
    </body>
</html>