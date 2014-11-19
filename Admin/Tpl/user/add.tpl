<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title>添加用户-<{jprass_config name="blog.title"}>-Powered by Joyphper</title>
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
			<a href="index.php?c=<{$handle_ctrl}>">用户管理</a>&gt;
			添加用户
		</div>
        <div class="main-panel wd">
			 <div id="validator-msg"></div>
            <div class="title_line">帐号信息</div>
            <form class="form form-aligned" id="ajax-submit-form" action="index.php?c=user&a=add" method="post">
                <div class="control-group">
                    <label>用户名</label>
                    <input type="text" name="loginName" id="loginName" data-rule="用户名:username" class="large" />
                    <span class="required">*</span>
                </div>
                <div class="control-group">
                    <label>密码</label>
                    <input type="password" name="loginPwd" id="loginPwd" data-rule="登录密码:password" class="large" />
                    <span class="required">*</span>
                </div>
                <div class="control-group">
                    <label>确认密码</label>
                    <input type="password" name="reloginPwd" id="reloginPwd" data-rule="确认密码:match" data-rule-match="#loginPwd" class="large" />
                    <span class="required">*</span>
                </div>
                <div class="title_line">用户信息</div>
                <div class="control-group">
                    <label>昵称</label>
                    <input type="text" name="screenName" id="screenName" class="large" />
                </div>
                <div class="control-group">
                    <label>邮箱</label>
                    <input type="text" name="email" id="email" class="large" />
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