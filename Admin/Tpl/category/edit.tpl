<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title>修改分类:<{$category.catename}>-<{jprass_config name="blog.title"}>-Powered by Joyphper</title>
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
        <div class="breadcrumb wd">
			当前位置：
			<a href="index.php">首页</a>&gt;
			<a href="index.php?c=<{$handle_ctrl}>">分类管理</a>&gt;
			修改分类：<{$category.catename}>
		</div>
        <div class="main-panel wd">
            <div class="title_line">修改分类：<{$category.catename}></div>
			<div id="validator-msg"></div>
            <form class="form form-aligned" id="ajax-submit-form" action="index.php?c=category&a=edit" method="post">
                <input type="hidden" name="id" value="<{$category.id}>"/>
				<div class="control-group">
                    <label>分类名称</label>
                    <input type="text" name="catename" id="catename" value="<{$category.catename}>" data-rule="分类名称:required" class="large" />
                    <span class="required">*</span>
                </div>
                <div class="control-group">
                    <label>关键字</label>
                    <input type="text" name="keywords" id="keywords" value="<{$category.keywords}>" class="xxlarge" />
                </div>
                <div class="control-group">
                    <label>描述</label>
                    <textarea name="description" id="description" class="xxlarge"><{$category.description}></textarea>
                </div>
                <div class="control-group">
					<label>属性</label>
					<span><input type="radio" name="ishide" value="0" <{if !$category.ishide}>checked<{/if}> />公开</span>
                    <span><input type="radio" name="ishide" value="1" <{if $category.ishide}>checked<{/if}> />隐藏</span>
                </div>
				<div class="control-group">
					<label>排序</label>
					<input type="text" name="orderid" id="orderid" value="<{$category.orderid}>" class="mini" />
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