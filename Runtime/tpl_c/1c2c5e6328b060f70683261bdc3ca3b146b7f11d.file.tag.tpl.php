<?php /* Smarty version Smarty-3.1.14, created on 2014-11-22 20:26:23
         compiled from "D:\PHProot\jprass-blog\Tpl\default\tag.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2241547080ef4d6661-14603002%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1c2c5e6328b060f70683261bdc3ca3b146b7f11d' => 
    array (
      0 => 'D:\\PHProot\\jprass-blog\\Tpl\\default\\tag.tpl',
      1 => 1416408167,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2241547080ef4d6661-14603002',
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
    'tag' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_547080ef5c4b12_37060911',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_547080ef5c4b12_37060911')) {function content_547080ef5c4b12_37060911($_smarty_tpl) {?><?php if (!is_callable('smarty_function_jprass_config')) include 'D:\\PHProot\\jprass-blog\\Core\\smarty\\plugins\\function.jprass_config.php';
if (!is_callable('smarty_function_jprass_url')) include 'D:\\PHProot\\jprass-blog\\Core\\smarty\\plugins\\function.jprass_url.php';
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

		<div class="container tag">
			<?php  $_smarty_tpl->tpl_vars["tag"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["tag"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["tag"]->key => $_smarty_tpl->tpl_vars["tag"]->value){
$_smarty_tpl->tpl_vars["tag"]->_loop = true;
?>
			<a href="<?php echo smarty_function_jprass_url(array('module'=>'tag','id'=>$_smarty_tpl->tpl_vars['tag']->value['id']),$_smarty_tpl);?>
" title="<?php echo $_smarty_tpl->tpl_vars['tag']->value['arcnum'];?>
篇文章"><?php echo $_smarty_tpl->tpl_vars['tag']->value['tagname'];?>
</a>
			<?php } ?>
		</div>
		<div class="clear"></div>
		<?php echo $_smarty_tpl->getSubTemplate ("./footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

    </body>
</html><?php }} ?>