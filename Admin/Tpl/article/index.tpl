<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title>文章管理-<{jprass_config name="blog.title"}>-Powered by Joyphper</title>
        <link type="text/css" href="Css/admin.css" rel="stylesheet">
        <script type="text/javascript" src="../Script/jquery.min.js"></script>
        <script type="text/javascript" src="../Script/jquery.sdialog.js"></script>
        <script type="text/javascript" src="Script/common.js"></script>
    </head>
    <body>
        <{include file="../include/header.tpl"}>
        <{include file="../include/nav.tpl"}>
        <div class="breadcrumb wd">当前位置：<a href="index.php">首页</a>&gt;文章管理</div>
        <div class="main-panel wd">
            <div class="toolbtn">
				<form class="form-stacked form-search" action="index.php">
					<input type="hidden" name="c" value="article" />
					<input type="text" name="s_key" id="s_key" class="large" value="<{$sKey}>" />
					<select name="s_cate">
						<option value="">所有分类</option>
						<{foreach from=$listCate item=cate  key=i}>
						<option value="<{$cate.id}>" <{if $sCate eq $cate.id}>selected<{/if}>><{$cate.catename}></option>
						<{/foreach}>
					</select>
					<input type="submit" class="btn" value="查找"/>
				</form>
				<a class="btn" href="index.php?c=article&a=add">添加</a>
				<a class="btn ajax-bulk-action" href="javascript:;" tip="您确定要删除选中的文章？" action="index.php?c=article&a=delete">删除</a>

            </div>
            <table cellspacing="0" align="center" class="list-table">
                <tbody>
                    <tr>          
                        <th style="width:30px"><input type="checkbox" class="checkedCtrl" title="选中/取消选中"></th>
						<th>ID</th>
                        <th>标题</th>
						<th style="width:100px">分类</th>
                        <th>阅读</th>
                        <th>时间</th>
                        <th>评论</th>
                        <th width="50">操作</th>
                    </tr>
                    <{foreach from=$records item=article}>
                    <tr>
                        <td><input type="checkbox" value="<{$article.id}>"></td>
						<td title="<{$article.id}>"><{$article.id}></td>
                        <td title="<{$article.title}>">
							<{if $article.status == 2}><font color='red'>[草稿]</font><{/if}>
							<a href="<{jprass_url module='article' id=$article.id dateline=$article.dateline}>" target="_blank"><{$article.title}></a>
						</td>
						<td>
							<{foreach from=$article.category item=category key="k"}>
							<{if $k > 0}>,<{/if}><a href="<{jprass_url module='category' id=$category.id}>" target="_blank"><{$category.catename}></a>
							<{/foreach}>
						</td>
                        <td title="<{$article.views}>"><{$article.views}></td>
                        <td title="<{$article.dateline|date_format:'%Y-%m-%d %H:%M'}>"><{$article.dateline|date_format:'%Y-%m-%d %H:%M'}></td>
                        <td title="<{$article.comments}>">
							<{if $article.comments}>
							<{$article.comments}>
							<{else}>
							0
							<{/if}>
						</td>
                        <td title="修改"><a href="index.php?c=article&a=edit&id=<{$article.id}>">修改</a></td>
                    </tr>
					<{/foreach}>
                </tbody>
            </table>
			<{$pager}>
        </div>
        <{include file="../include/footer.tpl"}>
    </body>
</html>