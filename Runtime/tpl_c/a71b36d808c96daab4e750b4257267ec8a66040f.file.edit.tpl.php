<?php /* Smarty version Smarty-3.1.14, created on 2014-11-20 00:09:03
         compiled from "D:\PHProot\jprass-blog\Admin\Tpl\user\edit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14152546cc09f313381-30613521%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a71b36d808c96daab4e750b4257267ec8a66040f' => 
    array (
      0 => 'D:\\PHProot\\jprass-blog\\Admin\\Tpl\\user\\edit.tpl',
      1 => 1416408094,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14152546cc09f313381-30613521',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'user' => 0,
    'handle_ctrl' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_546cc09f394225_93246318',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_546cc09f394225_93246318')) {function content_546cc09f394225_93246318($_smarty_tpl) {?><?php if (!is_callable('smarty_function_jprass_config')) include 'D:\\PHProot\\jprass-blog\\Core\\smarty\\plugins\\function.jprass_config.php';
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title>编辑用户:<?php echo $_smarty_tpl->tpl_vars['user']->value['login_name'];?>
-<?php echo smarty_function_jprass_config(array('name'=>"blog.title"),$_smarty_tpl);?>
-Powered by Joyphper</title>
        <link type="text/css" href="Css/admin.css" rel="stylesheet">
        <script type="text/javascript" src="../js/jquery.min.js"></script>
        <script type="text/javascript" src="../Script/jquery.form-validator.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				$.validate();
			});
		</script>
    </head>
    <body>
        <?php echo $_smarty_tpl->getSubTemplate ("../include/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

        <?php echo $_smarty_tpl->getSubTemplate ("../include/nav.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

        <div class="breadcrumb wd">当前位置：
			<a href="index.php">首页</a>&gt;
			<a href="index.php?c=<?php echo $_smarty_tpl->tpl_vars['handle_ctrl']->value;?>
">用户管理</a>&gt;
			编辑用户:<?php echo $_smarty_tpl->tpl_vars['user']->value['login_name'];?>
</div>
        <div class="main-panel wd">
            <div class="title_line">帐号信息</div>
            <form class="form form-aligned" id="ajax-submit-form" action="index.php?c=user&a=edit" method="post">
                <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['user']->value['id'];?>
"/>
                <div class="control-group">
                    <label>用户名</label>
                    <input type="text" value="<?php echo $_smarty_tpl->tpl_vars['user']->value['login_name'];?>
" disabled="disabled" class="large" />
                </div>
                <div class="control-group">
                    <label>密码</label>
                    <input type="password" name="loginPwd" id="loginPwd" class="large" />
                    <span class="required">不修改密码时为空</span>
                </div>
                <div class="control-group">
                    <label>确认密码</label>
                    <input type="password" name="reloginPwd" id="reloginPwd" class="large" />
                </div>
                <div class="title_line">用户信息</div>
                <div class="control-group">
                    <label>昵称</label>
                    <input type="text" value="<?php echo $_smarty_tpl->tpl_vars['user']->value['screen_name'];?>
" name="screenName" data-rule="昵称:required" id="screenName" class="large" />
                    <span class="required">*</span>
                </div>
                <div class="control-group">
                    <label>邮箱</label>
                    <input type="text" value="<?php echo $_smarty_tpl->tpl_vars['user']->value['email'];?>
" name="email" id="email" class="large" />
                </div>
                <div class="control-group">
                    <label>&nbsp;</label>
                    <button class="btn" id="submit-btn" type="submit">提交保存</button>
                    <span id="validator-msg"></span>
                </div>
            </form>
        </div>
        <?php echo $_smarty_tpl->getSubTemplate ("../include/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

    </body>
</html><?php }} ?>