<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title>分类管理-<{jprass_config name="blog.title"}>-Powered by Joyphper</title>
        <link type="text/css" href="Css/admin.css" rel="stylesheet">
        <script type="text/javascript" src="../Script/jquery.min.js"></script>
        <script type="text/javascript" src="../Script/jquery.sdialog.js"></script>
        <script type="text/javascript" src="Script/common.js"></script>
    </head>
    <body>
        <{include file="../include/header.tpl"}>
        <{include file="../include/nav.tpl"}>
        <div class="breadcrumb wd">当前位置：
			<a href="index.php">首页</a>&gt;
			分类管理
		</div>
        <div class="main-panel wd">
            <div class="toolbtn">
                <a class="btn" href="index.php?c=category&a=add">添加</a>
				<a class="btn ajax-bulk-action" href="javascript:;" tip="您确定要删除选中的分类？" action="index.php?c=category&a=delete">删除</a>
            </div>
            <table cellspacing="0" align="center" class="list-table">
                <tbody>
                    <tr>          
                        <th width="30"><input type="checkbox" class="checkedCtrl" title="选中/取消选中"></th>
						<th width="30">ID</th>
                        <th>名称</th>
                        <th>统计</th>
                        <th>排序</th>
                        <th width="50">操作</th>
                    </tr>
                    <{foreach from=$list item=category}>
                    <tr>
                        <td><input type="checkbox" value="<{$category.id}>"></td>
                        <td title="<{$category.id}>"><{$category.id}></td>
                        <td title="<{$category.catename}>"><{$category.catename}> <{if $category.ishide}>[<font color="red">隐藏</font>]<{/if}></td>
                        <td title="<{$category.count}>">
							<{if $category.arcnum}>
								<{$category.arcnum}>
							<{else}>
							0
							<{/if}>
						</td>
                        <td title="<{$category.orderid}>"><{$category.orderid}></td>
                        <td title="修改"><a href="index.php?c=category&a=edit&id=<{$category.id}>">修改</a></td>
                    </tr>
					<{/foreach}>
                </tbody>
            </table>
        </div>
        <{include file="../include/footer.tpl"}>
    </body>
</html>