<?php /* Smarty version Smarty-3.1.14, created on 2014-11-22 19:56:11
         compiled from "D:\PHProot\jprass-blog\Tpl\default\footer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:313547079db38fa81-36088571%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '547bfc3e43241489fc74b3a4e8e345c7aa00c3cf' => 
    array (
      0 => 'D:\\PHProot\\jprass-blog\\Tpl\\default\\footer.tpl',
      1 => 1416402662,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '313547079db38fa81-36088571',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_547079db3b2d14_41245229',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_547079db3b2d14_41245229')) {function content_547079db3b2d14_41245229($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'D:\\PHProot\\jprass-blog\\Core\\smarty\\plugins\\modifier.date_format.php';
if (!is_callable('smarty_function_jprass_config')) include 'D:\\PHProot\\jprass-blog\\Core\\smarty\\plugins\\function.jprass_config.php';
?><div class="footer">
    Copyright &copy; <?php echo smarty_modifier_date_format(time(),'%Y');?>
 joyphper.net <a href="<?php echo smarty_function_jprass_config(array('name'=>'blog.url'),$_smarty_tpl);?>
/" title="<?php echo smarty_function_jprass_config(array('name'=>'blog.title'),$_smarty_tpl);?>
" target="_blank"><?php echo smarty_function_jprass_config(array('name'=>"blog.title"),$_smarty_tpl);?>
</a> All Rights Reserved.  湘ICP备12012952号
    <script src="http://s15.cnzz.com/stat.php?id=2399046&web_id=2399046" language="JavaScript"></script>
</div><?php }} ?>