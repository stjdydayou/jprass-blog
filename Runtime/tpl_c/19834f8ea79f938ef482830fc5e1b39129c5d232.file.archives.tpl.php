<?php /* Smarty version Smarty-3.1.14, created on 2014-11-22 20:26:22
         compiled from "D:\PHProot\jprass-blog\Tpl\default\archives.tpl" */ ?>
<?php /*%%SmartyHeaderCode:17832547080ee65cd24-73199434%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '19834f8ea79f938ef482830fc5e1b39129c5d232' => 
    array (
      0 => 'D:\\PHProot\\jprass-blog\\Tpl\\default\\archives.tpl',
      1 => 1416408146,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17832547080ee65cd24-73199434',
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
    'years' => 0,
    'archives' => 0,
    'archive' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_547080ee918147_48620509',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_547080ee918147_48620509')) {function content_547080ee918147_48620509($_smarty_tpl) {?><?php if (!is_callable('smarty_function_jprass_config')) include 'D:\\PHProot\\jprass-blog\\Core\\smarty\\plugins\\function.jprass_config.php';
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

		<div class="container archives">
			<?php  $_smarty_tpl->tpl_vars["archives"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["archives"]->_loop = false;
 $_smarty_tpl->tpl_vars["years"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["archives"]->key => $_smarty_tpl->tpl_vars["archives"]->value){
$_smarty_tpl->tpl_vars["archives"]->_loop = true;
 $_smarty_tpl->tpl_vars["years"]->value = $_smarty_tpl->tpl_vars["archives"]->key;
?>
			<strong><?php echo $_smarty_tpl->tpl_vars['years']->value;?>
</strong>

			<?php  $_smarty_tpl->tpl_vars["archive"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["archive"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['archives']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["archive"]->key => $_smarty_tpl->tpl_vars["archive"]->value){
$_smarty_tpl->tpl_vars["archive"]->_loop = true;
?>
			<span><a href="<?php echo $_smarty_tpl->tpl_vars['archive']->value['url'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['archive']->value['arcnum'];?>
篇文章"><?php echo $_smarty_tpl->tpl_vars['archive']->value['month'];?>
(<?php echo $_smarty_tpl->tpl_vars['archive']->value['arcnum'];?>
)</a></span>
			<?php } ?>

			<?php } ?>
		</div>
		<div class="clear"></div>
		<?php echo $_smarty_tpl->getSubTemplate ("./footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

    </body>
</html><?php }} ?>