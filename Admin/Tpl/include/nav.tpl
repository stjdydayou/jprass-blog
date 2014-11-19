<div class="nav">
    <ul class="wd">
        <li><a href="index.php" <{if $handle_ctrl=="main"}>class="on"<{/if}>>首页</a></li>
        <li>
			<a href="index.php?c=article" <{if $handle_ctrl=="category" or $handle_ctrl=="article" or $handle_ctrl=="tag" or $handle_ctrl=="page" }>class="on"<{/if}>>内容管理</a>
			<dl>
				<dd><a href="index.php?c=article" <{if $handle_ctrl=="article"}>class="on"<{/if}>>文章管理</a></dd>
				<dd><a href="index.php?c=page" <{if $handle_ctrl=="page"}>class="on"<{/if}>>页面管理</a></dd>
				<dd><a href="index.php?c=tag" <{if $handle_ctrl=="tag"}>class="on"<{/if}>>标签管理</a></dd>
				<dd><a href="index.php?c=category" <{if $handle_ctrl=="category"}>class="on"<{/if}>>分类管理</a></dd>
			</dl>
		</li>
        <li><a href="index.php?c=flink" <{if $handle_ctrl=="flink"}>class="on"<{/if}>>链接管理</a></li>
		<li><a href="index.php?c=comment" <{if $handle_ctrl=="comment"}>class="on"<{/if}>>评论管理</a></li>
		<li><a href="index.php?c=upload" <{if $handle_ctrl=="upload"}>class="on"<{/if}>>附件管理</a></li>
		<li><a href="index.php?c=user" <{if $handle_ctrl=="user"}>class="on"<{/if}>>用户管理</a></li>
		<li>
			<a href="index.php?c=options" <{if $handle_ctrl=="options"}>class="on"<{/if}>>设置</a>
			<dl>
				<dd><a href="index.php?c=options" <{if $handle_ctrl=="options" and $handle_action=="main"}>class="on"<{/if}>>基本设置</a></dd>
				<dd><a href="index.php?c=options&a=upload" <{if $handle_ctrl=="options" and $handle_action=="upload"}>class="on"<{/if}>>上传设置</a></dd>
				<dd><a href="index.php?c=options&a=permalink" <{if $handle_ctrl=="options" and $handle_action=="permalink"}>class="on"<{/if}>>链接设置</a></dd>
				
			</dl>
		</li>
    </ul>
</div>
<script type="text/javascript">
	$(function() {
		$("div.nav > ul > li").hover(function() {
			$(this).find("dl").show()
					;
		}, function() {
			$(this).find("dl").hide();
		});
	});
</script>