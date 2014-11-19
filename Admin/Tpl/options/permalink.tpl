<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title>链接设置-<{jprass_config name="blog.title"}>-Powered by Joyphper</title>
        <link type="text/css" href="Css/admin.css" rel="stylesheet">
        <script type="text/javascript" src="../Script/jquery.min.js"></script>
    </head>
    <body>
        <{include file="../include/header.tpl"}>
        <{include file="../include/nav.tpl"}>
        <div class="breadcrumb wd">当前位置：<a href="index.php">首页</a>&gt;链接设置</div>
        <div class="main-panel wd">
			<div class="title_line">链接设置</div>
			<form class="form form-aligned" id="ajax-submit-form" action="index.php?c=options&a=permalink" method="post">
                <div class="control-group">
					<label>使用地址重写</label>
					<p>
						<span><input type="radio" value="0" name="rewrite" <{if !$options.rewrite}>checked="checked"<{/if}> />不启用</span>
						<span><input type="radio" value="1" name="rewrite" <{if $options.rewrite}>checked="checked"<{/if}>>启用</span><br/>
						<span>地址重写即rewrite功能是某些服务器软件提供的优化内部连接的功能。</span><br/>
						<span>打开此功能可以让你的链接看上去完全是静态地址！</span>
					</p>
                </div>
                <div class="control-group">
                    <label>自定义文章URL</label>
                    <p>
						<span><input type="radio" value="1" name="archives_url_pattern" <{if $options.archives_url_pattern eq '1'}>checked="checked"<{/if}> >默认风格 <strong>/archives/{cid}.html</strong></span><br/>
						<span><input type="radio" value="2" name="archives_url_pattern" <{if $options.archives_url_pattern eq '2'}>checked="checked"<{/if}>>按日期归档 <strong>/archives/{y}{m}{d}/{cid}.html</strong></span><br/>
						<span>可用参数：{cid} 日志ID、{y} 年、{m} 月、{d} 日</span><br/>
						<span>选择一种合适的文章静态路径风格, 使得你的网站链接更加友好.</span><br/>
						<span>一旦你选择了某种链接风格请不要轻易修改它.</span>
					</p>
                </div>
				<div class="control-group">
                    <label>URL后缀</label>
                    <p>
						<span><input type="radio" value="" name="url_ext" checked="checked"><strong>无</strong></span>
						<span><input type="radio" value=".htm" name="url_ext" <{if $options.url_ext eq '.htm'}>checked="checked"<{/if}>><strong>htm</strong></span>
						<span><input type="radio" value=".html" name="url_ext" <{if $options.url_ext eq '.html'}>checked="checked"<{/if}>><strong>html</strong></span>
						<span><input type="radio" value=".php" name="url_ext" <{if $options.url_ext eq '.php'}>checked="checked"<{/if}>><strong>php</strong></span><br/>
						<span>可用参数：{cid} 日志ID、{y} 年、{m} 月、{d} 日</span><br/>
						<span>选择一种合适的文章静态路径风格, 使得你的网站链接更加友好.</span><br/>
						<span>一旦你选择了某种链接风格请不要轻易修改它.</span>
					</p>
                </div>
                <div class="control-group">
                    <label>&nbsp;</label>
                    <button class="btn" id="submit-btn" type="submit">提交保存</button>
                    <span id="validator-msg"></span>
                </div>
            </form>
        </div>
        <{include file="../include/footer.tpl"}>
    </body>
</html>