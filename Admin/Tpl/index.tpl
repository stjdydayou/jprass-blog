<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title>管理首页-<{jprass_config name="blog.title"}>-Powered by Joyphper</title>
        <link type="text/css" href="Css/admin.css" rel="stylesheet">
		<script type="text/javascript" src="../Script/jquery.min.js"></script>
        <style type="text/css">
			.main-panel{position: relative;overflow: hidden}
            .user-info{height:130px;width:60%; position: absolute}
            .user-info dt img{margin:10px;float:left;height:100px;width:100px;border: 1px solid #DEE4C5;padding:2px;}
            .user-info dd{float:left}
            .user-info dd h2{margin-top:10px;font-weight: 600;}
			.sysinfo{width: 60%;position: absolute; top: 130px;}
			.sysinfo dt{border-bottom: 2px solid #D9E3EC;padding: 10px;margin: 0 10px;font-size: 14px;font-weight: bold;}
			.sysinfo dd{line-height: 25px;text-indent: 2em;}

			.latest-article dt{border-bottom: 2px solid #D9E3EC;padding: 10px;margin: 0 10px;font-size: 14px;font-weight: bold;}
			.latest-article{width: 37%;position: absolute; left:63%;}
			.latest-article dd{line-height: 25px;margin-left: 1em; margin-top: 5px;}
			.latest-article dd p{margin: 0}

        </style>
    </head>
    <body>
        <{include file="./include/header.tpl"}>
        <{include file="./include/nav.tpl"}>
        <div class="main-panel wd" style="margin-top:12px;">
            <dl class="user-info">
                <dt><{jprass_gravatar email=$loginUser.email}></dt>
                <dd>
                    <h2><{$loginUser.login_name}><cite>(<{$loginUser.screen_name}>)</cite></h2>
                    <p>目前共有<{$articleCount}> 篇文章,<{$commentCount}>条评论，<{$categoryCount}>个分类，<{$uploadCount}>个附件,<{$flinkCount}>个链接</p>
                    <p>上次登录时间: <{$loginUser.last_login_time|date_format:'%Y-%m-%d %H:%M:%S'}></p>
                    <p>上次登录IP: <{$loginUser.last_login_ip}></p>
                </dd>
            </dl>

			<dl class="sysinfo">
				<dt>服务器信息</dt>
				<dd>
					PHP环境：<{$sysinfo.environment}>
				</dd>
				<dd>
					MySQL客户端版本：<{$sysinfo.mysql_version}>
				</dd>
				<dd>
					GD库版本：<{$sysinfo.gd}>
				</dd>
				<dd>
					Register_Globals：<{$sysinfo.register_globals}>
				</dd>
				<dd>
					safe_mode：<{$sysinfo.safe_mode}>
				</dd>
				<dd>
					最大上传：<{$sysinfo.allow_upload_size}>
				</dd>
				<dd>
					内存占用率：<{$sysinfo.memory}>
				</dd>
			</dl>
			<dl class="latest-article">
				<dt>最新文章</dt>
				<{foreach from=$listArticle item=article}>
				<dd>
					<{if $article.status == 2}><font color='red'>[草稿]</font><{/if}>
					[<{$article.dateline|date_format:'Y-m-d'}>]
					<a href="<{jprass_url module='article' id=$article.id dateline=$article.dateline}>" target="_blank"><{$article.title}></a>
				</dd>
				<{/foreach}>
			</dl>
        </div>
        <{include file="./include/footer.tpl"}>
    </body>
</html>