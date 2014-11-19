<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title>编辑用户:<{$user.login_name}>-<{jprass_config name="blog.title"}>-Powered by Joyphper</title>
        <link type="text/css" href="Css/admin.css" rel="stylesheet">
        <script type="text/javascript" src="../js/jquery.min.js"></script>
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
			编辑用户:<{$user.login_name}></div>
        <div class="main-panel wd">
            <div class="title_line">帐号信息</div>
            <form class="form form-aligned" id="ajax-submit-form" action="index.php?c=user&a=edit" method="post">
                <input type="hidden" name="id" value="<{$user.id}>"/>
                <div class="control-group">
                    <label>用户名</label>
                    <input type="text" value="<{$user.login_name}>" disabled="disabled" class="large" />
                </div>
                <div class="control-group">
                    <label>密码</label>
                    <input type="password" name="loginPwd" id="loginPwd" class="large" />
                    <span class="required">不修改密码时为空</span>
                </div>
                <div class="control-group">
                    <label>确认密码</label>
                    <input type="password" name="reloginPwd" id="reloginPwd" class="large" />
                </div>
                <div class="title_line">用户信息</div>
                <div class="control-group">
                    <label>昵称</label>
                    <input type="text" value="<{$user.screen_name}>" name="screenName" data-rule="昵称:required" id="screenName" class="large" />
                    <span class="required">*</span>
                </div>
                <div class="control-group">
                    <label>邮箱</label>
                    <input type="text" value="<{$user.email}>" name="email" id="email" class="large" />
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