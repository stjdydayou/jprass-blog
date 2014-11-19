<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title>评论管理-<{jprass_config name="blog.title"}>-Powered by Joyphper</title>
        <link type="text/css" href="Css/admin.css" rel="stylesheet">
        <script type="text/javascript" src="../Script/jquery.min.js"></script>
        <script type="text/javascript" src="../Script/jquery.sdialog.js"></script>
        <script type="text/javascript" src="Script/common.js"></script>
		<script type="text/javascript">
			$(function() {
				$(".form-search > a#searchBtn").live("click", function() {
					$("#ischeck").val($(this).attr("ischeck"));
					$(this).closest("form").submit();
				});
			});
		</script>
    </head>
    <body>
        <{include file="../include/header.tpl"}>
        <{include file="../include/nav.tpl"}>
        <div class="breadcrumb wd">
			当前位置：<a href="index.php">首页</a>&gt;评论管理
		</div>
        <div class="main-panel wd">
            <div class="toolbtn">
				<form class="form-stacked form-search" action="index.php">
					<input type="hidden" name="c" value="comment" />
					<input type="hidden" name="ischeck" id="ischeck" value="<{$ischeck}>" />
					<input type="text" name="s_key" id="s_key" class="large" value="<{$sKey}>" />
					<a class="btn" id="searchBtn" href="javascript:;">查找</a>
					<a class="btn" href="index.php?c=comment">所有评论</a>
					<a class="btn" id="searchBtn" ischeck="0" href="javascript:;">未审核(<{$noCheckCount}>)</a>
					<a class="btn" id="searchBtn" ischeck="1" href="javascript:;">已审核</a>
				</form>
                <a class="btn ajax-bulk-action" href="javascript:;" tip="您确定要删除选中的评论？" action="index.php?c=comment&a=delete">删除</a>
				<a class="btn ajax-bulk-action" href="javascript:;" tip="您确定要审核选中的评论？" action="index.php?c=comment&a=check">审核</a>
				<a class="btn ajax-bulk-action" href="javascript:;" tip="您确定要取消审核选中的评论？" action="index.php?c=comment&a=nocheck">取消审核</a>
				<a class="btn ajax-bulk-action" href="javascript:;" tip="您确定要限制选中的评论的IP地址？" action="index.php?c=comment&a=restrictedip">限制IP</a>
            </div>
            <table cellspacing="0" align="center" class="list-table">
                <tbody>
                    <tr>          
                        <th style="width:30px"><input type="checkbox" class="checkedCtrl" title="选中/取消选中"></th>
						<th>评论</th>
                        <th width="100">时间</th>
                    </tr>
                    <{foreach from=$records item=row}>
                    <tr>
                        <td><input type="checkbox" value="<{$row.id}>"></td>
						<td>
							<p>
								<{if !$row['ischeck'] }>[<a href="index.php?c=comment&ischeck=0"><strong style="color:red">未审核</strong></a>]<{/if}>
								<strong><{$row['username']}></strong> | <{if $row['homepage']}><{$row['homepage']}>|<{/if}>
								<a href="mailto:<{$row['email']}>" title="发送邮件"><{$row['email']}></a> | 
								<{jprass_ipinfo ip=$row['ip']}>
							</p>
							<p><{$row['content']}></p>
							<p style="color:#666">
								所在日志：<a href="<{jprass_url module='article' id=$row.aid dateline=$row.arttime}>" target="_blank"><{$row['arctitle']}></a> 
								发表于：<{$row.arttime|date_format:'%Y-%m-%d %H:%M'}>
							</p>
						</td>
                        <td title="<{$row.dateline|date_format:'%Y-%m-%d %H:%M'}>"><{$row.dateline|date_format:'%Y-%m-%d %H:%M'}></td>
                    </tr>
					<{/foreach}>
                </tbody>
            </table>
            <{$pager}>
        </div>
        <{include file="../include/footer.tpl"}>
    </body>
</html>