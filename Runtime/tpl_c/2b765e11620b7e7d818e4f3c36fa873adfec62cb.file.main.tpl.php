<?php /* Smarty version Smarty-3.1.14, created on 2014-11-20 00:09:15
         compiled from "D:\PHProot\jprass-blog\Admin\Tpl\upload\main.tpl" */ ?>
<?php /*%%SmartyHeaderCode:20323546cc0ab7482e3-15670204%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2b765e11620b7e7d818e4f3c36fa873adfec62cb' => 
    array (
      0 => 'D:\\PHProot\\jprass-blog\\Admin\\Tpl\\upload\\main.tpl',
      1 => 1416408097,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20323546cc0ab7482e3-15670204',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'records' => 0,
    'upload' => 0,
    'pager' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_546cc0ab871137_10609496',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_546cc0ab871137_10609496')) {function content_546cc0ab871137_10609496($_smarty_tpl) {?><?php if (!is_callable('smarty_function_jprass_config')) include 'D:\\PHProot\\jprass-blog\\Core\\smarty\\plugins\\function.jprass_config.php';
if (!is_callable('smarty_function_jprass_url')) include 'D:\\PHProot\\jprass-blog\\Core\\smarty\\plugins\\function.jprass_url.php';
if (!is_callable('smarty_modifier_date_format')) include 'D:\\PHProot\\jprass-blog\\Core\\smarty\\plugins\\modifier.date_format.php';
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title>附件管理-<?php echo smarty_function_jprass_config(array('name'=>"blog.title"),$_smarty_tpl);?>
-Powered by Joyphper</title>
        <link type="text/css" href="Css/admin.css" rel="stylesheet">
        <script type="text/javascript" src="../Script/jquery.min.js"></script>
        <script type="text/javascript" src="../Script/jquery.sdialog.js"></script>
        <script type="text/javascript" src="Script/common.js"></script>
    </head>
    <body>
        <?php echo $_smarty_tpl->getSubTemplate ("../include/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

        <?php echo $_smarty_tpl->getSubTemplate ("../include/nav.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

        <div class="breadcrumb wd">当前位置：<a href="index.php">首页</a>&gt;附件管理</div>
        <div class="main-panel wd">
            <div class="toolbtn">
				<a class="btn ajax-bulk-action" href="javascript:;" tip="您确定要删除选中的文章？" action="index.php?c=upload&a=delete">删除</a>
            </div>
            <table cellspacing="0" align="center" class="list-table">
                <tbody>
                    <tr>          
                        <th style="width:30px"><input type="checkbox" class="checkedCtrl" title="选中/取消选中"></th>
						<th>ID</th>
                        <th>文件名</th>
                        <th>所属文章</th>
                        <th>文件大小</th>
						<th>上传时间</th>
                    </tr>
                    <?php  $_smarty_tpl->tpl_vars['upload'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['upload']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['records']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['upload']->key => $_smarty_tpl->tpl_vars['upload']->value){
$_smarty_tpl->tpl_vars['upload']->_loop = true;
?>
                    <tr>
                        <td><input type="checkbox" value="<?php echo $_smarty_tpl->tpl_vars['upload']->value['id'];?>
"></td>
						<td title="<?php echo $_smarty_tpl->tpl_vars['upload']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['upload']->value['id'];?>
</td>
                        <td title="<?php echo $_smarty_tpl->tpl_vars['upload']->value['originalname'];?>
"><a href="<?php echo smarty_function_jprass_config(array('name'=>'blog.url'),$_smarty_tpl);?>
/<?php echo $_smarty_tpl->tpl_vars['upload']->value['filepath'];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['upload']->value['originalname'];?>
</a></td>
                        <td title="<?php echo $_smarty_tpl->tpl_vars['upload']->value['arctitle'];?>
">
							<?php if ($_smarty_tpl->tpl_vars['upload']->value['arctitle']!=''){?>
							<a href="<?php echo smarty_function_jprass_url(array('module'=>'article','id'=>$_smarty_tpl->tpl_vars['upload']->value['aid'],'dateline'=>$_smarty_tpl->tpl_vars['upload']->value['arcdateline']),$_smarty_tpl);?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['upload']->value['arctitle'];?>
</a>
							<?php }else{ ?>
							<font color='#aaa'>未归档</font>
							<?php }?>
						</td>
                        <td title="<?php echo $_smarty_tpl->tpl_vars['upload']->value['filesize'];?>
">
							<?php if ($_smarty_tpl->tpl_vars['upload']->value['filesize']>1024*1024){?>
							<?php echo $_smarty_tpl->tpl_vars['upload']->value['filesize']/(1024*1024);?>
MB
							<?php }elseif($_smarty_tpl->tpl_vars['upload']->value['filesize']>1024&&$_smarty_tpl->tpl_vars['upload']->value['filesize']<1024*1024){?>
							<?php echo sprintf("%.2f",($_smarty_tpl->tpl_vars['upload']->value['filesize']/1024));?>
KB
							<?php }else{ ?>
							<?php echo $_smarty_tpl->tpl_vars['upload']->value['filesize'];?>
B
							<?php }?>
							
						</td>
						<td title="<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['upload']->value['dateline'],'%Y-%m-%d %H:%M:%S');?>
"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['upload']->value['dateline'],'%Y-%m-%d %H:%M:%S');?>
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