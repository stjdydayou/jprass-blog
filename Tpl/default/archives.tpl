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
		<div class="container archives">
			<{foreach from=$list item="archives" key="years"}>
			<strong><{$years}></strong>

			<{foreach from=$archives item="archive"}>
			<span><a href="<{$archive.url}>" title="<{$archive.arcnum}>篇文章"><{$archive.month}>(<{$archive.arcnum}>)</a></span>
			<{/foreach}>

			<{/foreach}>
		</div>
		<div class="clear"></div>
		<{include file="./footer.tpl"}>
    </body>
</html>