<?xml version="1.0" encoding="utf-8" ?>
<rss version="2.0" 
     xmlns:content="http://purl.org/rss/1.0/modules/content/" 
     xmlns:wfw="http://wellformedweb.org/CommentAPI/" 
     xmlns:dc="http://purl.org/dc/elements/1.1/" 
     xmlns:atom="http://www.w3.org/2005/Atom" 
     xmlns:sy="http://purl.org/rss/1.0/modules/syndication/" >
    <channel>
	<title><{jprass_config name="blog.title"}></title>
	<atom:link href="<{jprass_config name='blog.url'}>/" rel="self" type="application/rss+xml" />
	<link><{jprass_config name="blog.url"}>/</link>
	<description><{jprass_config name="blog.description"}></description>
	<language>zh-cn</language>
	<copyright>Powered By jprass.com Copyright <{$smarty.now|date_format:'%Y'}> <{jprass_config name="blog.title"}> All Rights Reserved.</copyright>
	<pubDate><{$smarty.now|date_format:'r':'':'date'}></pubDate>
	<generator>jprass.com</generator>
	<{foreach from=$list item="row" }>

	<item>
	    <title><{$row.title}></title>
	    <link><{jprass_url module='article' id=$row.id dateline=$row.dateline}></link>
	    <description><![CDATA[<{$row.description}>]]></description>
	    <category><{$row.category}></category>
	    <comments><{jprass_url module='article' id=$row.id dateline=$row.dateline}>#comments</comments>
	    <guid><{jprass_url module='article' id=$row.id dateline=$row.dateline}></guid>
	    <pubDate><{$row.dateline|date_format:'r':'':'date'}></pubDate>
	</item>
	<{/foreach}>
    </channel>
</rss>