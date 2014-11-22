<?php /* Smarty version Smarty-3.1.14, created on 2014-11-22 19:56:11
         compiled from "D:\PHProot\jprass-blog\Tpl\default\list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:17970547079db197b91-58766823%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b03dba64e84dee929dbe3a8701dff34390521873' => 
    array (
      0 => 'D:\\PHProot\\jprass-blog\\Tpl\\default\\list.tpl',
      1 => 1416408159,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17970547079db197b91-58766823',
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
    'list' => 0,
    'article' => 0,
    'pager' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_547079db25ef41_82943511',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_547079db25ef41_82943511')) {function content_547079db25ef41_82943511($_smarty_tpl) {?><?php if (!is_callable('smarty_function_jprass_config')) include 'D:\\PHProot\\jprass-blog\\Core\\smarty\\plugins\\function.jprass_config.php';
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
    </head>
    <body>
		<?php echo $_smarty_tpl->getSubTemplate ("./header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

		<div class="clear"></div>
		<?php echo $_smarty_tpl->getSubTemplate ("./sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

		<div class="container">
			<?php  $_smarty_tpl->tpl_vars['article'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['article']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['article']->key => $_smarty_tpl->tpl_vars['article']->value){
$_smarty_tpl->tpl_vars['article']->_loop = true;
?>
			<dl class="list-article">
				<dt><a href="<?php echo smarty_function_jprass_url(array('module'=>'article','id'=>$_smarty_tpl->tpl_vars['article']->value['id'],'dateline'=>$_smarty_tpl->tpl_vars['article']->value['dateline']),$_smarty_tpl);?>
"><?php echo $_smarty_tpl->tpl_vars['article']->value['title'];?>
</a></dt>
				<dd>
					<p class="excerpt">
						<?php echo $_smarty_tpl->tpl_vars['article']->value['description'];?>

						<a href="<?php echo smarty_function_jprass_url(array('module'=>'article','id'=>$_smarty_tpl->tpl_vars['article']->value['id'],'dateline'=>$_smarty_tpl->tpl_vars['article']->value['dateline']),$_smarty_tpl);?>
">阅读全文</a>
					</p>
					<p class="info">
						posted @ <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['article']->value['dateline'],'%Y-%m-%d %H:%M');?>

						阅读(<?php echo $_smarty_tpl->tpl_vars['article']->value['views'];?>
) 评论(<?php if ($_smarty_tpl->tpl_vars['article']->value['comments']){?><?php echo $_smarty_tpl->tpl_vars['article']->value['comments'];?>
<?php }else{ ?>0<?php }?>)
					</p>
				</dd>
			</dl>
			<?php } ?>
			<?php echo $_smarty_tpl->tpl_vars['pager']->value;?>

		</div>
		<div class="clear"></div>
		<?php echo $_smarty_tpl->getSubTemplate ("./footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

    </body>
</html><?php }} ?>