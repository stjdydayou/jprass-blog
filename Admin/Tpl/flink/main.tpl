<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title>链接管理-<{jprass_config name="blog.title"}>-Powered by Joyphper</title>
        <link type="text/css" href="Css/admin.css" rel="stylesheet">
        <script type="text/javascript" src="../Script/jquery.min.js"></script>
        <script type="text/javascript" src="../Script/jquery.sdialog.js"></script>
        <script type="text/javascript" src="Script/common.js"></script>
    </head>
    <body>
        <{include file="../include/header.tpl"}>
        <{include file="../include/nav.tpl"}>
        <div class="breadcrumb wd">当前位置：
			<a href="index.php">首页</a>&gt;链接管理
		</div>
        <div class="main-panel wd">
            <div class="toolbtn">
				<form class="form-stacked form-search" action="index.php">
					<input type="hidden" name="c" value="flink" />
					关键词：<input type="text" name="s_key" id="s_key" class="large" value="<{$sKey}>" />
					可见：
					<select name="s_visible">
						<option value="" selected="true">所有</option>
						<option value="Y" <{if $visible =='Y'}>selected<{/if}>>是</option>
						<option value="N" <{if $visible == 'N'}>selected<{/if}>>否</option>
					</select>
					<input type="submit" class="btn" value="查找"/>
				</form>
                <a class="btn" href="index.php?c=flink&a=add">添加</a>
				<a class="btn ajax-bulk-action" href="javascript:;" tip="您确定要删除选中的链接？" action="index.php?c=flink&a=delete">删除</a>
            </div>
            <table cellspacing="0" align="center" class="list-table">
                <tbody>
                    <tr>          
                        <th style="width:30px"><input type="checkbox" class="checkedCtrl" title="选中/取消选中"></th>
						<th>ID</th>
                        <th>链接名</th>
                        <th>链接地址</th>
                        <th>可见</th>
						<th width="50">操作</th>
                    </tr>
                    <{foreach from=$records item=flink}>
                    <tr>
                        <td><input type="checkbox" value="<{$flink.id}>"></td>
						<td title="<{$flink.id}>"><{$flink.id}></td>
                        <td title="<{$flink.name}>"><{$flink.name}></td>
                        <td title="<{$flink.url}>"><{$flink.url}></td>
                        <td title="<{$flink.visible}>">
							<{if $flink.visible=='Y'}>
							<font color="green">是</font>
							<{else}>
							<font color="red">否</font>
							<{/if}>
						</td>
						<td title="修改"><a href="index.php?c=flink&a=edit&id=<{$flink.id}>">修改</a></td>
                    </tr>
					<{/foreach}>
                </tbody>
            </table>
            <{$pager}>
        </div>
        <{include file="../include/footer.tpl"}>
    </body>
</html>