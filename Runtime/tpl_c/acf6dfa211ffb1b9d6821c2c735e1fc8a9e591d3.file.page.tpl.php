<?php /* Smarty version Smarty-3.1.14, created on 2014-11-22 20:26:24
         compiled from "D:\PHProot\jprass-blog\Tpl\default\page.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14438547080f0b20178-71888768%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'acf6dfa211ffb1b9d6821c2c735e1fc8a9e591d3' => 
    array (
      0 => 'D:\\PHProot\\jprass-blog\\Tpl\\default\\page.tpl',
      1 => 1416408164,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14438547080f0b20178-71888768',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'title' => 0,
    'keywords' => 0,
    'description' => 0,
    'theme_url' => 0,
    'blog_url' => 0,
    'page' => 0,
    'comments' => 0,
    'k' => 0,
    'vo' => 0,
    'comment' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_547080f0c971c8_55399841',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_547080f0c971c8_55399841')) {function content_547080f0c971c8_55399841($_smarty_tpl) {?><?php if (!is_callable('smarty_function_jprass_config')) include 'D:\\PHProot\\jprass-blog\\Core\\smarty\\plugins\\function.jprass_config.php';
if (!is_callable('smarty_function_jprass_url')) include 'D:\\PHProot\\jprass-blog\\Core\\smarty\\plugins\\function.jprass_url.php';
if (!is_callable('smarty_modifier_date_format')) include 'D:\\PHProot\\jprass-blog\\Core\\smarty\\plugins\\modifier.date_format.php';
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
-<?php echo smarty_function_jprass_config(array('name'=>"blog.title"),$_smarty_tpl);?>
</title>
		<meta name="keywords" content="<?php echo $_smarty_tpl->tpl_vars['keywords']->value;?>
" />
		<meta name="description" content="<?php echo $_smarty_tpl->tpl_vars['description']->value;?>
" />
        <link type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['theme_url']->value;?>
/style.css" rel="stylesheet">
		<link rel="alternate" type="application/rss+xml" title="最新文章" href="<?php echo $_smarty_tpl->tpl_vars['blog_url']->value;?>
/rss" />
		<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['blog_url']->value;?>
/Script/jquery.min.js"></script>
		<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['blog_url']->value;?>
/Script/jquery.form-validator.js"></script>
		<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['blog_url']->value;?>
/Script/jquery.form.js"></script>
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
				$('#captchaImage').attr('src', '<?php echo $_smarty_tpl->tpl_vars['blog_url']->value;?>
/captcha.php?_=' + Math.random());
			}
        </script>
    </head>
    <body>
		<?php echo $_smarty_tpl->getSubTemplate ("./header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

		<div class="clear"></div>
		<?php echo $_smarty_tpl->getSubTemplate ("./sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

		<div class="container">
			<div class="article">
				<h1><a href="<?php echo smarty_function_jprass_url(array('module'=>'page','id'=>$_smarty_tpl->tpl_vars['page']->value['id']),$_smarty_tpl);?>
"><?php echo $_smarty_tpl->tpl_vars['page']->value['title'];?>
</a></h1>
				<p class="info">
					posted @ <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['page']->value['dateline'],'%Y-%m-%d %H:%M');?>
 |
					阅读:<?php echo $_smarty_tpl->tpl_vars['page']->value['views'];?>
 |
					评论:<?php echo count($_smarty_tpl->tpl_vars['comments']->value);?>

				</p>
				<div class="content"><?php echo $_smarty_tpl->tpl_vars['page']->value['content'];?>
</div>

				<?php if (count($_smarty_tpl->tpl_vars['page']->value['tags'])>0){?>
				<p>
					TAG：
					<?php  $_smarty_tpl->tpl_vars['vo'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['vo']->_loop = false;
 $_smarty_tpl->tpl_vars["k"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['page']->value['tags']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['vo']->key => $_smarty_tpl->tpl_vars['vo']->value){
$_smarty_tpl->tpl_vars['vo']->_loop = true;
 $_smarty_tpl->tpl_vars["k"]->value = $_smarty_tpl->tpl_vars['vo']->key;
?>
					<?php if ($_smarty_tpl->tpl_vars['k']->value>0){?>,<?php }?>
					<a href="<?php echo smarty_function_jprass_url(array('module'=>'tag','id'=>$_smarty_tpl->tpl_vars['vo']->value['id']),$_smarty_tpl);?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['vo']->value['tagname'];?>
</a>
					<?php } ?>
				</p>
				<?php }?>
			</div>
			<div class="comments">
				<h2>
					<a name="comments"></a>
					共有<?php echo count($_smarty_tpl->tpl_vars['comments']->value);?>
条评论
					<a href="#comment-form">发表评论&gt;&gt;</a>
				</h2>
				<?php  $_smarty_tpl->tpl_vars["comment"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["comment"]->_loop = false;
 $_smarty_tpl->tpl_vars["k"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['comments']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["comment"]->key => $_smarty_tpl->tpl_vars["comment"]->value){
$_smarty_tpl->tpl_vars["comment"]->_loop = true;
 $_smarty_tpl->tpl_vars["k"]->value = $_smarty_tpl->tpl_vars["comment"]->key;
?>
				<dl <?php if (!(1 & $_smarty_tpl->tpl_vars['k']->value)){?>class="alt"<?php }?>>
					<dt>
					<strong><?php echo $_smarty_tpl->tpl_vars['comment']->value['username'];?>
</strong>
					<cite>发表于:<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['comment']->value['dateline'],'%Y-%m-%d %H:%M');?>
</cite>
					</dt>
					<dd><?php echo $_smarty_tpl->tpl_vars['comment']->value['content'];?>
</dd>
				</dl>
				<?php } ?>
				<a name="comment-form"></a>
				<form name="comment-form" id="comment-form" method="post" action="<?php echo $_smarty_tpl->tpl_vars['blog_url']->value;?>
/index.php?c=comment&aid=<?php echo $_smarty_tpl->tpl_vars['page']->value['id'];?>
">
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
						<img src="<?php echo $_smarty_tpl->tpl_vars['blog_url']->value;?>
/captcha.php" id="captchaImage" onclick="captcha();" style="cursor:pointer;vertical-align:bottom;" alt="点击换一张验证码" /> 
					</div>
					<input name="submit" type="submit" id="submit" class="btn" value="提交评论" />
					<div class="control validator-msg-wrap" id="validator-msg" style="display:none"></div>

				</form>
			</div>
		</div>
		<div class="clear"></div>
		<?php echo $_smarty_tpl->getSubTemplate ("./footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

    </body>
</html><?php }} ?>