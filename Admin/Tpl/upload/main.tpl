<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title>附件管理-<{jprass_config name="blog.title"}>-Powered by Joyphper</title>
        <link type="text/css" href="Css/admin.css" rel="stylesheet">
        <script type="text/javascript" src="../Script/jquery.min.js"></script>
        <script type="text/javascript" src="../Script/jquery.sdialog.js"></script>
        <script type="text/javascript" src="Script/common.js"></script>
    </head>
    <body>
        <{include file="../include/header.tpl"}>
        <{include file="../include/nav.tpl"}>
        <div class="breadcrumb wd">当前位置：<a href="index.php">首页</a>&gt;附件管理</div>
        <div class="main-panel wd">
            <div class="toolbtn">
				<a class="btn ajax-bulk-action" href="javascript:;" tip="您确定要删除选中的文章？" action="index.php?c=upload&a=delete">删除</a>
            </div>
            <table cellspacing="0" align="center" class="list-table">
                <tbody>
                    <tr>          
                        <th style="width:30px"><input type="checkbox" class="checkedCtrl" title="选中/取消选中"></th>
						<th>ID</th>
                        <th>文件名</th>
                        <th>所属文章</th>
                        <th>文件大小</th>
						<th>上传时间</th>
                    </tr>
                    <{foreach from=$records item=upload}>
                    <tr>
                        <td><input type="checkbox" value="<{$upload.id}>"></td>
						<td title="<{$upload.id}>"><{$upload.id}></td>
                        <td title="<{$upload.originalname}>"><a href="<{jprass_config name='blog.url'}>/<{$upload.filepath}>" target="_blank"><{$upload.originalname}></a></td>
                        <td title="<{$upload.arctitle}>">
							<{if $upload.arctitle != ''}>
							<a href="<{jprass_url module='article' id=$upload.aid dateline=$upload.arcdateline}>" target="_blank"><{$upload.arctitle}></a>
							<{else}>
							<font color='#aaa'>未归档</font>
							<{/if}>
						</td>
                        <td title="<{$upload.filesize}>">
							<{if $upload.filesize > 1024 * 1024}>
							<{$upload.filesize/(1024 * 1024) }>MB
							<{elseif $upload.filesize > 1024 && $upload.filesize < 1024 * 1024}>
							<{($upload.filesize/1024)|string_format:"%.2f"}>KB
							<{else}>
							<{$upload.filesize}>B
							<{/if}>
							
						</td>
						<td title="<{$upload.dateline|date_format:'%Y-%m-%d %H:%M:%S'}>"><{$upload.dateline|date_format:'%Y-%m-%d %H:%M:%S'}></td>
                    </tr>
					<{/foreach}>
                </tbody>
            </table>
            <{$pager}>
        </div>
        <{include file="../include/footer.tpl"}>
    </body>
</html>