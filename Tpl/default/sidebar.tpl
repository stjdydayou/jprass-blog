<div class="sidebar">
    <div class="baidu-ad">
		<script type="text/javascript">
			/*200*200，net右则广告_2*/
			var cpro_id = 'u380711';
		</script>
		<script src="http://cpro.baidu.com/cpro/ui/c.js" type="text/javascript"></script>
    </div>
    <dl>
		<dt>分类</dt>
		<dd>
			<{jprass_category}>
			<span><a href="<{$vo.url}>"><{$vo.catename}>(<{$vo.arcnum}>)</a></span>
			<{/jprass_category}>
		</dd>
    </dl>
    <dl>
		<dt>归档</dt>
		<dd>
			<{jprass_archives}>
			<span><a href="<{$vo.url}>"><{$vo.months}> <{$vo.years}>(<{$vo.arcnum}>)</a></span>
			<{/jprass_archives}>
		</dd>
    </dl>
    <dl>
		<dt>标签</dt>
		<dd>
			<{jprass_tag limit="0,30"}>
			<a href="<{$vo.url}>" title="<{$vo.arcnum}>篇文章"><{$vo.tagname}></a>
			<{/jprass_tag}>
		</dd>
    </dl>
    <{if $handle_ctrl eq 'main' && $handle_action eq 'index'}>
    <dl>
		<dt>友情链接</dt>
		<dd>
			<{jprass_flink visible="Y"}>
			<span><a href="<{$vo.url}>" target="_blank"><{$vo.name}></a></span>
			<{/jprass_flink}>
		</dd>
    </dl>
    <{/if}>
</div>