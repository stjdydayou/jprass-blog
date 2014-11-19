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
		<div class="container tag">
			<{foreach from=$list item="tag"}>
			<a href="<{jprass_url module='tag' id=$tag.id}>" title="<{$tag.arcnum}>篇文章"><{$tag.tagname}></a>
			<{/foreach}>
		</div>
		<div class="clear"></div>
		<{include file="./footer.tpl"}>
    </body>
</html>