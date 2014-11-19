<?php /* Smarty version Smarty-3.1.14, created on 2014-11-20 00:09:11
         compiled from "D:\PHProot\jprass-blog\Admin\Tpl\flink\main.tpl" */ ?>
<?php /*%%SmartyHeaderCode:32756546cc0a7d5a105-14852398%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '95915fea96c494edf2c6c06e09ac95fb51a5b7f7' => 
    array (
      0 => 'D:\\PHProot\\jprass-blog\\Admin\\Tpl\\flink\\main.tpl',
      1 => 1416408099,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '32756546cc0a7d5a105-14852398',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'sKey' => 0,
    'visible' => 0,
    'records' => 0,
    'flink' => 0,
    'pager' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_546cc0a7e1d631_07929468',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_546cc0a7e1d631_07929468')) {function content_546cc0a7e1d631_07929468($_smarty_tpl) {?><?php if (!is_callable('smarty_function_jprass_config')) include 'D:\\PHProot\\jprass-blog\\Core\\smarty\\plugins\\function.jprass_config.php';
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title>链接管理-<?php echo smarty_function_jprass_config(array('name'=>"blog.title"),$_smarty_tpl);?>
-Powered by Joyphper</title>
        <link type="text/css" href="Css/admin.css" rel="stylesheet">
        <script type="text/javascript" src="../Script/jquery.min.js"></script>
        <script type="text/javascript" src="../Script/jquery.sdialog.js"></script>
        <script type="text/javascript" src="Script/common.js"></script>
    </head>
    <body>
        <?php echo $_smarty_tpl->getSubTemplate ("../include/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

        <?php echo $_smarty_tpl->getSubTemplate ("../include/nav.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

        <div class="breadcrumb wd">当前位置：
			<a href="index.php">首页</a>&gt;链接管理
		</div>
        <div class="main-panel wd">
            <div class="toolbtn">
				<form class="form-stacked form-search" action="index.php">
					<input type="hidden" name="c" value="flink" />
					关键词：<input type="text" name="s_key" id="s_key" class="large" value="<?php echo $_smarty_tpl->tpl_vars['sKey']->value;?>
" />
					可见：
					<select name="s_visible">
						<option value="" selected="true">所有</option>
						<option value="Y" <?php if ($_smarty_tpl->tpl_vars['visible']->value=='Y'){?>selected<?php }?>>是</option>
						<option value="N" <?php if ($_smarty_tpl->tpl_vars['visible']->value=='N'){?>selected<?php }?>>否</option>
					</select>
					<input type="submit" class="btn" value="查找"/>
				</form>
                <a class="btn" href="index.php?c=flink&a=add">添加</a>
				<a class="btn ajax-bulk-action" href="javascript:;" tip="您确定要删除选中的链接？" action="index.php?c=flink&a=delete">删除</a>
            </div>
            <table cellspacing="0" align="center" class="list-table">
                <tbody>
                    <tr>          
                        <th style="width:30px"><input type="checkbox" class="checkedCtrl" title="选中/取消选中"></th>
						<th>ID</th>
                        <th>链接名</th>
                        <th>链接地址</th>
                        <th>可见</th>
						<th width="50">操作</th>
                    </tr>
                    <?php  $_smarty_tpl->tpl_vars['flink'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['flink']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['records']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['flink']->key => $_smarty_tpl->tpl_vars['flink']->value){
$_smarty_tpl->tpl_vars['flink']->_loop = true;
?>
                    <tr>
                        <td><input type="checkbox" value="<?php echo $_smarty_tpl->tpl_vars['flink']->value['id'];?>
"></td>
						<td title="<?php echo $_smarty_tpl->tpl_vars['flink']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['flink']->value['id'];?>
</td>
                        <td title="<?php echo $_smarty_tpl->tpl_vars['flink']->value['name'];?>
"><?php echo $_smarty_tpl->tpl_vars['flink']->value['name'];?>
</td>
                        <td title="<?php echo $_smarty_tpl->tpl_vars['flink']->value['url'];?>
"><?php echo $_smarty_tpl->tpl_vars['flink']->value['url'];?>
</td>
                        <td title="<?php echo $_smarty_tpl->tpl_vars['flink']->value['visible'];?>
">
							<?php if ($_smarty_tpl->tpl_vars['flink']->value['visible']=='Y'){?>
							<font color="green">是</font>
							<?php }else{ ?>
							<font color="red">否</font>
							<?php }?>
						</td>
						<td title="修改"><a href="index.php?c=flink&a=edit&id=<?php echo $_smarty_tpl->tpl_vars['flink']->value['id'];?>
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