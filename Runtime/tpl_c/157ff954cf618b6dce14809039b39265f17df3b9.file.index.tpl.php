<?php /* Smarty version Smarty-3.1.14, created on 2014-11-20 00:09:12
         compiled from "D:\PHProot\jprass-blog\Admin\Tpl\article\index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:797546cc0a8509421-89994057%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '157ff954cf618b6dce14809039b39265f17df3b9' => 
    array (
      0 => 'D:\\PHProot\\jprass-blog\\Admin\\Tpl\\article\\index.tpl',
      1 => 1416408102,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '797546cc0a8509421-89994057',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'sKey' => 0,
    'listCate' => 0,
    'cate' => 0,
    'sCate' => 0,
    'records' => 0,
    'article' => 0,
    'k' => 0,
    'category' => 0,
    'pager' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_546cc0a8668d88_49517422',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_546cc0a8668d88_49517422')) {function content_546cc0a8668d88_49517422($_smarty_tpl) {?><?php if (!is_callable('smarty_function_jprass_config')) include 'D:\\PHProot\\jprass-blog\\Core\\smarty\\plugins\\function.jprass_config.php';
if (!is_callable('smarty_function_jprass_url')) include 'D:\\PHProot\\jprass-blog\\Core\\smarty\\plugins\\function.jprass_url.php';
if (!is_callable('smarty_modifier_date_format')) include 'D:\\PHProot\\jprass-blog\\Core\\smarty\\plugins\\modifier.date_format.php';
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title>文章管理-<?php echo smarty_function_jprass_config(array('name'=>"blog.title"),$_smarty_tpl);?>
-Powered by Joyphper</title>
        <link type="text/css" href="Css/admin.css" rel="stylesheet">
        <script type="text/javascript" src="../Script/jquery.min.js"></script>
        <script type="text/javascript" src="../Script/jquery.sdialog.js"></script>
        <script type="text/javascript" src="Script/common.js"></script>
    </head>
    <body>
        <?php echo $_smarty_tpl->getSubTemplate ("../include/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

        <?php echo $_smarty_tpl->getSubTemplate ("../include/nav.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

        <div class="breadcrumb wd">当前位置：<a href="index.php">首页</a>&gt;文章管理</div>
        <div class="main-panel wd">
            <div class="toolbtn">
				<form class="form-stacked form-search" action="index.php">
					<input type="hidden" name="c" value="article" />
					<input type="text" name="s_key" id="s_key" class="large" value="<?php echo $_smarty_tpl->tpl_vars['sKey']->value;?>
" />
					<select name="s_cate">
						<option value="">所有分类</option>
						<?php  $_smarty_tpl->tpl_vars['cate'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['cate']->_loop = false;
 $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['listCate']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['cate']->key => $_smarty_tpl->tpl_vars['cate']->value){
$_smarty_tpl->tpl_vars['cate']->_loop = true;
 $_smarty_tpl->tpl_vars['i']->value = $_smarty_tpl->tpl_vars['cate']->key;
?>
						<option value="<?php echo $_smarty_tpl->tpl_vars['cate']->value['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['sCate']->value==$_smarty_tpl->tpl_vars['cate']->value['id']){?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['cate']->value['catename'];?>
</option>
						<?php } ?>
					</select>
					<input type="submit" class="btn" value="查找"/>
				</form>
				<a class="btn" href="index.php?c=article&a=add">添加</a>
				<a class="btn ajax-bulk-action" href="javascript:;" tip="您确定要删除选中的文章？" action="index.php?c=article&a=delete">删除</a>

            </div>
            <table cellspacing="0" align="center" class="list-table">
                <tbody>
                    <tr>          
                        <th style="width:30px"><input type="checkbox" class="checkedCtrl" title="选中/取消选中"></th>
						<th>ID</th>
                        <th>标题</th>
						<th style="width:100px">分类</th>
                        <th>阅读</th>
                        <th>时间</th>
                        <th>评论</th>
                        <th width="50">操作</th>
                    </tr>
                    <?php  $_smarty_tpl->tpl_vars['article'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['article']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['records']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['article']->key => $_smarty_tpl->tpl_vars['article']->value){
$_smarty_tpl->tpl_vars['article']->_loop = true;
?>
                    <tr>
                        <td><input type="checkbox" value="<?php echo $_smarty_tpl->tpl_vars['article']->value['id'];?>
"></td>
						<td title="<?php echo $_smarty_tpl->tpl_vars['article']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['article']->value['id'];?>
</td>
                        <td title="<?php echo $_smarty_tpl->tpl_vars['article']->value['title'];?>
">
							<?php if ($_smarty_tpl->tpl_vars['article']->value['status']==2){?><font color='red'>[草稿]</font><?php }?>
							<a href="<?php echo smarty_function_jprass_url(array('module'=>'article','id'=>$_smarty_tpl->tpl_vars['article']->value['id'],'dateline'=>$_smarty_tpl->tpl_vars['article']->value['dateline']),$_smarty_tpl);?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['article']->value['title'];?>
</a>
						</td>
						<td>
							<?php  $_smarty_tpl->tpl_vars['category'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['category']->_loop = false;
 $_smarty_tpl->tpl_vars["k"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['article']->value['category']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['category']->key => $_smarty_tpl->tpl_vars['category']->value){
$_smarty_tpl->tpl_vars['category']->_loop = true;
 $_smarty_tpl->tpl_vars["k"]->value = $_smarty_tpl->tpl_vars['category']->key;
?>
							<?php if ($_smarty_tpl->tpl_vars['k']->value>0){?>,<?php }?><a href="<?php echo smarty_function_jprass_url(array('module'=>'category','id'=>$_smarty_tpl->tpl_vars['category']->value['id']),$_smarty_tpl);?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['category']->value['catename'];?>
</a>
							<?php } ?>
						</td>
                        <td title="<?php echo $_smarty_tpl->tpl_vars['article']->value['views'];?>
"><?php echo $_smarty_tpl->tpl_vars['article']->value['views'];?>
</td>
                        <td title="<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['article']->value['dateline'],'%Y-%m-%d %H:%M');?>
"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['article']->value['dateline'],'%Y-%m-%d %H:%M');?>
</td>
                        <td title="<?php echo $_smarty_tpl->tpl_vars['article']->value['comments'];?>
">
							<?php if ($_smarty_tpl->tpl_vars['article']->value['comments']){?>
							<?php echo $_smarty_tpl->tpl_vars['article']->value['comments'];?>

							<?php }else{ ?>
							0
							<?php }?>
						</td>
                        <td title="修改"><a href="index.php?c=article&a=edit&id=<?php echo $_smarty_tpl->tpl_vars['article']->value['id'];?>
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