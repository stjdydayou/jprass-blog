<div class="header">
    <div class="blog-title">
		<div class="title"><a href="<{$blog_url}>/"><{jprass_config name="blog.title"}></a></div>
		<div class="sub-title"><{jprass_config name="blog.subtitle"}></div>
    </div>
    <div class="navigator">
		<ul id="navList">
			<li><a href="<{$blog_url}>/">首页</a></li>
			<li><a href="<{jprass_url module='archives'}>">归档</a></li>
			<li><a href="<{jprass_url module='tag'}>">标签</a></li>
			<li><a href="<{jprass_url module='page' id='241'}>">关于</a></li>
		</ul>
		<div class="blog-states">
			文章-<{$article_count}>&nbsp;
			评论-<{$comment_count}>&nbsp;
			分类-<{$category_count}>&nbsp;
		</div>
    </div>
</div>