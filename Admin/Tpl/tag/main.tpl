<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title>标签管理-<{jprass_config name="blog.title"}>-Powered by Joyphper</title>
        <link type="text/css" href="Css/admin.css" rel="stylesheet">
        <script type="text/javascript" src="../Script/jquery.min.js"></script>
        <script type="text/javascript" src="../Script/jquery.sdialog.js"></script>
        <script type="text/javascript" src="Script/common.js"></script>
    </head>
    <body>
        <{include file="../include/header.tpl"}>
        <{include file="../include/nav.tpl"}>
        <div class="breadcrumb wd">当前位置：<a href="index.php">首页</a>&gt;标签管理</div>
        <div class="main-panel wd">
            <div class="toolbtn">
				<a class="btn ajax-bulk-action" href="javascript:;" tip="您确定要删除选中的标签？" action="index.php?c=tag&a=delete">删除</a>
            </div>
            <table cellspacing="0" align="center" class="list-table">
                <tbody>
                    <tr>          
                        <th width="30"><input type="checkbox" class="checkedCtrl" title="选中/取消选中"></th>
						<th width="50">ID</th>
                        <th>标签名</th>
						<th>文章数</th>
                    </tr>
                    <{foreach from=$records item=tag}>
                    <tr>
                        <td><input type="checkbox" value="<{$tag.id}>"></td>
						<td title="<{$tag.id}>"><{$tag.id}></td>
                        <td title="<{$tag.tagname}>"><{$tag.tagname}></td>
                        <td title="<{$tag.arcnum}>篇文章"><{$tag.arcnum}></td>
                    </tr>
					<{/foreach}>
                </tbody>
            </table>
            <{$pager}>
        </div>
        <{include file="../include/footer.tpl"}>
    </body>
</html>