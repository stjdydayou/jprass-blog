<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title><{$title}>-<{jprass_config name="blog.title"}></title>
		<meta name="keywords" content="<{$keywords}>" />
		<meta name="description" content="<{$description}>" />
        <link type="text/css" href="<{$theme_url}>/style.css" rel="stylesheet">
		<link rel="alternate" type="application/rss+xml" title="最新文章" href="<{$blog_url}>/rss" />
    </head>
    <body>
		<{include file="./header.tpl"}>
		<div class="clear"></div>
		<{include file="./sidebar.tpl"}>
		<div class="container">
			<{foreach from=$list item=article}>
			<dl class="list-article">
				<dt><a href="<{jprass_url module='article' id=$article.id dateline=$article.dateline}>"><{$article.title}></a></dt>
				<dd>
					<p class="excerpt">
						<{$article.description}>
						<a href="<{jprass_url module='article' id=$article.id dateline=$article.dateline}>">阅读全文</a>
					</p>
					<p class="info">
						posted @ <{$article.dateline|date_format:'%Y-%m-%d %H:%M'}>
						阅读(<{$article.views}>) 评论(<{if $article.comments}><{$article.comments}><{else}>0<{/if}>)
					</p>
				</dd>
			</dl>
			<{/foreach}>
			<{$pager}>
		</div>
		<div class="clear"></div>
		<{include file="./footer.tpl"}>
    </body>
</html>