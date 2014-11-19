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
		<script type="text/javascript" src="<{$blog_url}>/Script/jquery.min.js"></script>
		<script type="text/javascript" src="<{$blog_url}>/Script/jquery.form-validator.js"></script>
		<script type="text/javascript" src="<{$blog_url}>/Script/jquery.form.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				$('div.content').find('img').each(function() {
					var width = $(this).width();
					if (width > 500) {
						$(this).css("width", "500px").css("cursor", "pointer").click(function() {
							window.open($(this).attr('src'));
						});
					}
				});
				$.validate();
				$("#comment-form").ajaxForm({
					beforeSubmit: function() {
						$("#validator-msg").hide();
					},
					dataType: "json",
					success: function(json) {
						if (json.state) {
							window.location.reload();
						} else {
							captcha();
							$("#validator-msg").html(json.message);
							$("#validator-msg").addClass("validator-error").show();
						}
					}
				});
			});
			function captcha() {
				$("#captcha").val("");
				$('#captchaImage').attr('src', '<{$blog_url}>/captcha.php?_=' + Math.random());
			}
        </script>
    </head>
    <body>
		<{include file="./header.tpl"}>
		<div class="clear"></div>
		<{include file="./sidebar.tpl"}>
		<div class="container">
			<div class="article">
				<h1><a href="<{jprass_url module='page' id=$page.id}>"><{$page.title}></a></h1>
				<p class="info">
					posted @ <{$page.dateline|date_format:'%Y-%m-%d %H:%M'}> |
					阅读:<{$page.views}> |
					评论:<{$comments|@count}>
				</p>
				<div class="content"><{$page.content}></div>

				<{if $page.tags|@count gt 0}>
				<p>
					TAG：
					<{foreach from=$page.tags item=vo key="k"}>
					<{if $k gt 0}>,<{/if}>
					<a href="<{jprass_url module='tag' id=$vo.id}>" target="_blank"><{$vo.tagname}></a>
					<{/foreach}>
				</p>
				<{/if}>
			</div>
			<div class="comments">
				<h2>
					<a name="comments"></a>
					共有<{$comments|@count}>条评论
					<a href="#comment-form">发表评论&gt;&gt;</a>
				</h2>
				<{foreach from=$comments item="comment" key="k"}>
				<dl <{if $k is even}>class="alt"<{/if}>>
					<dt>
					<strong><{$comment.username}></strong>
					<cite>发表于:<{$comment.dateline|date_format:'%Y-%m-%d %H:%M'}></cite>
					</dt>
					<dd><{$comment.content}></dd>
				</dl>
				<{/foreach}>
				<a name="comment-form"></a>
				<form name="comment-form" id="comment-form" method="post" action="<{$blog_url}>/index.php?c=comment&aid=<{$page.id}>">
					<div class="author-info">
						<div>
							<label for="username">昵称 (必须)</label>
							<input type="text" name="tx_username" id="tx_username" data-rule="昵称:required" class="text" /> 
						</div>
						<div>
							<label for="email">邮箱 (不公开, 必须)</label>
							<input type="text" name="tx_email" id="tx_email" data-rule="邮箱:required;email" class="text"/>
						</div>
						<div>
							<label for="homepage">网站</label>
							<input type="text" name="tx_homepage" id="tx_homepage"  class="text"/>
						</div>
					</div>
					<div class="row">
						<textarea name="tx_content" id="tx_content"></textarea>
					</div>
					<div class="row">
						<input type="text" name="tx_captcha" id="tx_captcha" data-rule="验证码:captcha" class="text"/>
						<label for="captcha">请输入图片上的数字 (必须)</label>
					</div>
					<div class="row">
						<img src="<{$blog_url}>/captcha.php" id="captchaImage" onclick="captcha();" style="cursor:pointer;vertical-align:bottom;" alt="点击换一张验证码" /> 
					</div>
					<input name="submit" type="submit" id="submit" class="btn" value="提交评论" />
					<div class="control validator-msg-wrap" id="validator-msg" style="display:none"></div>

				</form>
			</div>
		</div>
		<div class="clear"></div>
		<{include file="./footer.tpl"}>
    </body>
</html>