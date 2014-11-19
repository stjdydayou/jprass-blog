<?php /* Smarty version Smarty-3.1.14, created on 2014-11-20 00:09:14
         compiled from "D:\PHProot\jprass-blog\Admin\Tpl\comment\main.tpl" */ ?>
<?php /*%%SmartyHeaderCode:22930546cc0aaaed9b8-67584234%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a3b3e5be8ef0a398a7303753f445bc70ea1d4769' => 
    array (
      0 => 'D:\\PHProot\\jprass-blog\\Admin\\Tpl\\comment\\main.tpl',
      1 => 1416408100,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '22930546cc0aaaed9b8-67584234',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'ischeck' => 0,
    'sKey' => 0,
    'noCheckCount' => 0,
    'records' => 0,
    'row' => 0,
    'pager' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_546cc0aabfb274_87438170',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_546cc0aabfb274_87438170')) {function content_546cc0aabfb274_87438170($_smarty_tpl) {?><?php if (!is_callable('smarty_function_jprass_config')) include 'D:\\PHProot\\jprass-blog\\Core\\smarty\\plugins\\function.jprass_config.php';
if (!is_callable('smarty_function_jprass_ipinfo')) include 'D:\\PHProot\\jprass-blog\\Core\\smarty\\plugins\\function.jprass_ipinfo.php';
if (!is_callable('smarty_function_jprass_url')) include 'D:\\PHProot\\jprass-blog\\Core\\smarty\\plugins\\function.jprass_url.php';
if (!is_callable('smarty_modifier_date_format')) include 'D:\\PHProot\\jprass-blog\\Core\\smarty\\plugins\\modifier.date_format.php';
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title>评论管理-<?php echo smarty_function_jprass_config(array('name'=>"blog.title"),$_smarty_tpl);?>
-Powered by Joyphper</title>
        <link type="text/css" href="Css/admin.css" rel="stylesheet">
        <script type="text/javascript" src="../Script/jquery.min.js"></script>
        <script type="text/javascript" src="../Script/jquery.sdialog.js"></script>
        <script type="text/javascript" src="Script/common.js"></script>
		<script type="text/javascript">
			$(function() {
				$(".form-search > a#searchBtn").live("click", function() {
					$("#ischeck").val($(this).attr("ischeck"));
					$(this).closest("form").submit();
				});
			});
		</script>
    </head>
    <body>
        <?php echo $_smarty_tpl->getSubTemplate ("../include/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

        <?php echo $_smarty_tpl->getSubTemplate ("../include/nav.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

        <div class="breadcrumb wd">
			当前位置：<a href="index.php">首页</a>&gt;评论管理
		</div>
        <div class="main-panel wd">
            <div class="toolbtn">
				<form class="form-stacked form-search" action="index.php">
					<input type="hidden" name="c" value="comment" />
					<input type="hidden" name="ischeck" id="ischeck" value="<?php echo $_smarty_tpl->tpl_vars['ischeck']->value;?>
" />
					<input type="text" name="s_key" id="s_key" class="large" value="<?php echo $_smarty_tpl->tpl_vars['sKey']->value;?>
" />
					<a class="btn" id="searchBtn" href="javascript:;">查找</a>
					<a class="btn" href="index.php?c=comment">所有评论</a>
					<a class="btn" id="searchBtn" ischeck="0" href="javascript:;">未审核(<?php echo $_smarty_tpl->tpl_vars['noCheckCount']->value;?>
)</a>
					<a class="btn" id="searchBtn" ischeck="1" href="javascript:;">已审核</a>
				</form>
                <a class="btn ajax-bulk-action" href="javascript:;" tip="您确定要删除选中的评论？" action="index.php?c=comment&a=delete">删除</a>
				<a class="btn ajax-bulk-action" href="javascript:;" tip="您确定要审核选中的评论？" action="index.php?c=comment&a=check">审核</a>
				<a class="btn ajax-bulk-action" href="javascript:;" tip="您确定要取消审核选中的评论？" action="index.php?c=comment&a=nocheck">取消审核</a>
				<a class="btn ajax-bulk-action" href="javascript:;" tip="您确定要限制选中的评论的IP地址？" action="index.php?c=comment&a=restrictedip">限制IP</a>
            </div>
            <table cellspacing="0" align="center" class="list-table">
                <tbody>
                    <tr>          
                        <th style="width:30px"><input type="checkbox" class="checkedCtrl" title="选中/取消选中"></th>
						<th>评论</th>
                        <th width="100">时间</th>
                    </tr>
                    <?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['records']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value){
$_smarty_tpl->tpl_vars['row']->_loop = true;
?>
                    <tr>
                        <td><input type="checkbox" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['id'];?>
"></td>
						<td>
							<p>
								<?php if (!$_smarty_tpl->tpl_vars['row']->value['ischeck']){?>[<a href="index.php?c=comment&ischeck=0"><strong style="color:red">未审核</strong></a>]<?php }?>
								<strong><?php echo $_smarty_tpl->tpl_vars['row']->value['username'];?>
</strong> | <?php if ($_smarty_tpl->tpl_vars['row']->value['homepage']){?><?php echo $_smarty_tpl->tpl_vars['row']->value['homepage'];?>
|<?php }?>
								<a href="mailto:<?php echo $_smarty_tpl->tpl_vars['row']->value['email'];?>
" title="发送邮件"><?php echo $_smarty_tpl->tpl_vars['row']->value['email'];?>
</a> | 
								<?php echo smarty_function_jprass_ipinfo(array('ip'=>$_smarty_tpl->tpl_vars['row']->value['ip']),$_smarty_tpl);?>

							</p>
							<p><?php echo $_smarty_tpl->tpl_vars['row']->value['content'];?>
</p>
							<p style="color:#666">
								所在日志：<a href="<?php echo smarty_function_jprass_url(array('module'=>'article','id'=>$_smarty_tpl->tpl_vars['row']->value['aid'],'dateline'=>$_smarty_tpl->tpl_vars['row']->value['arttime']),$_smarty_tpl);?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['row']->value['arctitle'];?>
</a> 
								发表于：<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['row']->value['arttime'],'%Y-%m-%d %H:%M');?>

							</p>
						</td>
                        <td title="<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['row']->value['dateline'],'%Y-%m-%d %H:%M');?>
"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['row']->value['dateline'],'%Y-%m-%d %H:%M');?>
</td>
                    </tr>
					<?php } ?>
                </tbody>
            </table>
            <?php echo $_smarty_tpl->tpl_vars['pager']->value;?>

        </div>
        <?php echo $_smarty_tpl->getSubTemplate ("../include/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

    </body>
</html><?php }} ?>