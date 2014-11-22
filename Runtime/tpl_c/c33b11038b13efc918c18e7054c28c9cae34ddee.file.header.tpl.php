<?php /* Smarty version Smarty-3.1.14, created on 2014-11-22 19:56:11
         compiled from "D:\PHProot\jprass-blog\Tpl\default\header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:20355547079db26e941-98951441%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c33b11038b13efc918c18e7054c28c9cae34ddee' => 
    array (
      0 => 'D:\\PHProot\\jprass-blog\\Tpl\\default\\header.tpl',
      1 => 1416402662,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20355547079db26e941-98951441',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'blog_url' => 0,
    'article_count' => 0,
    'comment_count' => 0,
    'category_count' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_547079db2b0fd3_61200553',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_547079db2b0fd3_61200553')) {function content_547079db2b0fd3_61200553($_smarty_tpl) {?><?php if (!is_callable('smarty_function_jprass_config')) include 'D:\\PHProot\\jprass-blog\\Core\\smarty\\plugins\\function.jprass_config.php';
if (!is_callable('smarty_function_jprass_url')) include 'D:\\PHProot\\jprass-blog\\Core\\smarty\\plugins\\function.jprass_url.php';
?><div class="header">
    <div class="blog-title">
		<div class="title"><a href="<?php echo $_smarty_tpl->tpl_vars['blog_url']->value;?>
/"><?php echo smarty_function_jprass_config(array('name'=>"blog.title"),$_smarty_tpl);?>
</a></div>
		<div class="sub-title"><?php echo smarty_function_jprass_config(array('name'=>"blog.subtitle"),$_smarty_tpl);?>
</div>
    </div>
    <div class="navigator">
		<ul id="navList">
			<li><a href="<?php echo $_smarty_tpl->tpl_vars['blog_url']->value;?>
/">首页</a></li>
			<li><a href="<?php echo smarty_function_jprass_url(array('module'=>'archives'),$_smarty_tpl);?>
">归档</a></li>
			<li><a href="<?php echo smarty_function_jprass_url(array('module'=>'tag'),$_smarty_tpl);?>
">标签</a></li>
			<li><a href="<?php echo smarty_function_jprass_url(array('module'=>'page','id'=>'241'),$_smarty_tpl);?>
">关于</a></li>
		</ul>
		<div class="blog-states">
			文章-<?php echo $_smarty_tpl->tpl_vars['article_count']->value;?>
&nbsp;
			评论-<?php echo $_smarty_tpl->tpl_vars['comment_count']->value;?>
&nbsp;
			分类-<?php echo $_smarty_tpl->tpl_vars['category_count']->value;?>
&nbsp;
		</div>
    </div>
</div><?php }} ?>