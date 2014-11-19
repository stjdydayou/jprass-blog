<?php /* Smarty version Smarty-3.1.14, created on 2014-11-20 00:08:59
         compiled from "D:\PHProot\jprass-blog\Admin\Tpl\user\main.tpl" */ ?>
<?php /*%%SmartyHeaderCode:28858546cc09b9c92d8-72731526%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cccfd1f8e85bf81752c8d6e019e9a421522a91f2' => 
    array (
      0 => 'D:\\PHProot\\jprass-blog\\Admin\\Tpl\\user\\main.tpl',
      1 => 1416408086,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '28858546cc09b9c92d8-72731526',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'records' => 0,
    'user' => 0,
    'pager' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_546cc09ba94500_50064512',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_546cc09ba94500_50064512')) {function content_546cc09ba94500_50064512($_smarty_tpl) {?><?php if (!is_callable('smarty_function_jprass_config')) include 'D:\\PHProot\\jprass-blog\\Core\\smarty\\plugins\\function.jprass_config.php';
if (!is_callable('smarty_modifier_date_format')) include 'D:\\PHProot\\jprass-blog\\Core\\smarty\\plugins\\modifier.date_format.php';
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title>用户管理-<?php echo smarty_function_jprass_config(array('name'=>"blog.title"),$_smarty_tpl);?>
-Powered by Joyphper</title>
        <link type="text/css" href="Css/admin.css" rel="stylesheet">
        <script type="text/javascript" src="../Script/jquery.min.js"></script>
        <script type="text/javascript" src="../Script/jquery.sdialog.js"></script>
        <script type="text/javascript" src="Script/common.js"></script>
    </head>
    <body>
        <?php echo $_smarty_tpl->getSubTemplate ("../include/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

        <?php echo $_smarty_tpl->getSubTemplate ("../include/nav.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

        <div class="breadcrumb wd">当前位置：<a href="index.php">首页</a>&gt;用户管理</div>
        <div class="main-panel wd">
            <div class="toolbtn">
                <a class="btn" href="index.php?c=user&a=add">添加</a>
                <a class="btn ajax-bulk-action" href="javascript:;" tip="您确定要启用选中的账号？" action="index.php?c=user&a=enable">启用</a>
                <a class="btn ajax-bulk-action" href="javascript:;" tip="您确定要禁用选中的账号？" action="index.php?c=user&a=disable">禁用</a>
            </div>
            <table cellspacing="0" align="center" class="list-table">
                <tbody>
                    <tr>          
                        <th style="width:30px"><input type="checkbox" class="checkedCtrl" title="选中/取消选中"></th>
                        <th>登录名</th>
                        <th>昵称</th>
                        <th>邮箱</th>
                        <th>最后登录ip</th>
                        <th>最后登录时间</th>
                        <th>状态</th>
                        <th width="50">操作</th>
                    </tr>
                    <?php  $_smarty_tpl->tpl_vars['user'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['user']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['records']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['user']->key => $_smarty_tpl->tpl_vars['user']->value){
$_smarty_tpl->tpl_vars['user']->_loop = true;
?>
                    <tr>
                        <td><input type="checkbox" value="<?php echo $_smarty_tpl->tpl_vars['user']->value['id'];?>
"></td>
                        <td title="<?php echo $_smarty_tpl->tpl_vars['user']->value['login_name'];?>
"><?php echo $_smarty_tpl->tpl_vars['user']->value['login_name'];?>
</td>
                        <td title="<?php echo $_smarty_tpl->tpl_vars['user']->value['screen_name'];?>
"><?php echo $_smarty_tpl->tpl_vars['user']->value['screen_name'];?>
</td>
                        <td title="<?php echo $_smarty_tpl->tpl_vars['user']->value['email'];?>
"><?php echo $_smarty_tpl->tpl_vars['user']->value['email'];?>
</td>
                        <td title="<?php echo $_smarty_tpl->tpl_vars['user']->value['last_login_ip'];?>
"><?php echo $_smarty_tpl->tpl_vars['user']->value['last_login_ip'];?>
</td>
                        <td title="<?php echo $_smarty_tpl->tpl_vars['user']->value['last_login_time'];?>
"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['user']->value['last_login_time'],'%Y-%m-%d %H:%M:%S');?>
</td>
                        <td title="<?php echo $_smarty_tpl->tpl_vars['user']->value['last_login_time'];?>
">
                            <?php if ($_smarty_tpl->tpl_vars['user']->value['enable']=='Y'){?>
                            正常
                            <?php }elseif($_smarty_tpl->tpl_vars['user']->value['enable']=='N'){?>
                            禁用
                            <?php }?>
                        </td>
                        <td title="修改"><a href="index.php?c=user&a=edit&id=<?php echo $_smarty_tpl->tpl_vars['user']->value['id'];?>
">修改</a></td>
                    </tr>
					<?php } ?>
                </tbody>
            </table>
            <?php echo $_smarty_tpl->tpl_vars['pager']->value;?>

        </div>
        <?php echo $_smarty_tpl->getSubTemplate ("../include/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

    </body>
</html><?php }} ?>