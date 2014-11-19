<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title>用户管理-<{jprass_config name="blog.title"}>-Powered by Joyphper</title>
        <link type="text/css" href="Css/admin.css" rel="stylesheet">
        <script type="text/javascript" src="../Script/jquery.min.js"></script>
        <script type="text/javascript" src="../Script/jquery.sdialog.js"></script>
        <script type="text/javascript" src="Script/common.js"></script>
    </head>
    <body>
        <{include file="../include/header.tpl"}>
        <{include file="../include/nav.tpl"}>
        <div class="breadcrumb wd">当前位置：<a href="index.php">首页</a>&gt;用户管理</div>
        <div class="main-panel wd">
            <div class="toolbtn">
                <a class="btn" href="index.php?c=user&a=add">添加</a>
                <a class="btn ajax-bulk-action" href="javascript:;" tip="您确定要启用选中的账号？" action="index.php?c=user&a=enable">启用</a>
                <a class="btn ajax-bulk-action" href="javascript:;" tip="您确定要禁用选中的账号？" action="index.php?c=user&a=disable">禁用</a>
            </div>
            <table cellspacing="0" align="center" class="list-table">
                <tbody>
                    <tr>          
                        <th style="width:30px"><input type="checkbox" class="checkedCtrl" title="选中/取消选中"></th>
                        <th>登录名</th>
                        <th>昵称</th>
                        <th>邮箱</th>
                        <th>最后登录ip</th>
                        <th>最后登录时间</th>
                        <th>状态</th>
                        <th width="50">操作</th>
                    </tr>
                    <{foreach from=$records item=user}>
                    <tr>
                        <td><input type="checkbox" value="<{$user.id}>"></td>
                        <td title="<{$user.login_name}>"><{$user.login_name}></td>
                        <td title="<{$user.screen_name}>"><{$user.screen_name}></td>
                        <td title="<{$user.email}>"><{$user.email}></td>
                        <td title="<{$user.last_login_ip}>"><{$user.last_login_ip}></td>
                        <td title="<{$user.last_login_time}>"><{$user.last_login_time|date_format:'%Y-%m-%d %H:%M:%S'}></td>
                        <td title="<{$user.last_login_time}>">
                            <{if $user.enable eq Y}>
                            正常
                            <{elseif $user.enable eq N}>
                            禁用
                            <{/if}>
                        </td>
                        <td title="修改"><a href="index.php?c=user&a=edit&id=<{$user.id}>">修改</a></td>
                    </tr>
					<{/foreach}>
                </tbody>
            </table>
            <{$pager}>
        </div>
        <{include file="../include/footer.tpl"}>
    </body>
</html>