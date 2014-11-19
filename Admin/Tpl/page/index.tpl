<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title>页面管理-<{jprass_config name="blog.title"}>-Powered by Joyphper</title>
        <link type="text/css" href="Css/admin.css" rel="stylesheet">
        <script type="text/javascript" src="../Script/jquery.min.js"></script>
        <script type="text/javascript" src="../Script/jquery.sdialog.js"></script>
        <script type="text/javascript" src="Script/common.js"></script>
    </head>
    <body>
        <{include file="../include/header.tpl"}>
        <{include file="../include/nav.tpl"}>
        <div class="breadcrumb wd">当前位置：<a href="index.php">首页</a>&gt;页面管理</div>
        <div class="main-panel wd">
            <div class="toolbtn">
				<a class="btn" href="index.php?c=page&a=add">添加</a>
				<a class="btn ajax-bulk-action" href="javascript:;" tip="您确定要删除选中的文章？" action="index.php?c=page&a=delete">删除</a>
            </div>
            <table cellspacing="0" align="center" class="list-table">
                <tbody>
                    <tr>          
                        <th style="width:30px"><input type="checkbox" class="checkedCtrl" title="选中/取消选中"></th>
						<th width="50">ID</th>
                        <th>标题</th>
                        <th width="50">阅读</th>
                        <th width="150">时间</th>
                        <th width="50">评论</th>
                        <th width="50">操作</th>
                    </tr>
                    <{foreach from=$records item=page}>
                    <tr>
                        <td><input type="checkbox" value="<{$page.id}>"></td>
						<td title="<{$page.id}>"><{$page.id}></td>
                        <td title="<{$page.title}>">
							<{if $page.status == 2}><font color='red'>[草稿]</font><{/if}>
							<a href="<{jprass_url module='page' id=$page.id dateline=$page.dateline}>" target="_blank"><{$page.title}></a>
						</td>
                        <td title="<{$page.views}>"><{$page.views}></td>
                        <td title="<{$page.dateline|date_format:'%Y-%m-%d %H:%M'}>"><{$page.dateline|date_format:'%Y-%m-%d %H:%M'}></td>
                        <td title="<{$page.comments}>"><{if $page.comments}><{$page.comments}><{else}>0<{/if}></td>
                        <td title="修改"><a href="index.php?c=page&a=edit&id=<{$page.id}>">修改</a></td>
                    </tr>
					<{/foreach}>
                </tbody>
            </table>
			<{$pager}>
        </div>
        <{include file="../include/footer.tpl"}>
    </body>
</html>