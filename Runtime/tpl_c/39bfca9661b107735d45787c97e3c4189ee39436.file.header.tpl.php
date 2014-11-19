<?php /* Smarty version Smarty-3.1.14, created on 2014-11-20 00:08:55
         compiled from "D:\PHProot\jprass-blog\Admin\Tpl\include\header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:11365546cc09706d9d9-76745066%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '39bfca9661b107735d45787c97e3c4189ee39436' => 
    array (
      0 => 'D:\\PHProot\\jprass-blog\\Admin\\Tpl\\include\\header.tpl',
      1 => 1416402664,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '11365546cc09706d9d9-76745066',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'loginUser' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_546cc0970756d9_98165500',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_546cc0970756d9_98165500')) {function content_546cc0970756d9_98165500($_smarty_tpl) {?><div class="header wd">
    <div class="logo f-left">
        <a href="index.php"><image src="Css/logo.png" height="50px"/></a>
    </div>
    <div class="setinfo f-right">
        <span class="userGreet">您好，<?php echo $_smarty_tpl->tpl_vars['loginUser']->value['screen_name'];?>
</span>
        <span class=""><a href="../" target="_blank">博客首页</a></span>
        <span class="lastset"><a href="index.php?a=logout" target="_parent">退出</a></span>
    </div>
</div><?php }} ?>