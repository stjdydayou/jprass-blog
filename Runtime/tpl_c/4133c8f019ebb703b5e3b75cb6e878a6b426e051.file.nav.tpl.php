<?php /* Smarty version Smarty-3.1.14, created on 2014-11-20 00:08:55
         compiled from "D:\PHProot\jprass-blog\Admin\Tpl\include\nav.tpl" */ ?>
<?php /*%%SmartyHeaderCode:23866546cc0970850d6-19894162%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4133c8f019ebb703b5e3b75cb6e878a6b426e051' => 
    array (
      0 => 'D:\\PHProot\\jprass-blog\\Admin\\Tpl\\include\\nav.tpl',
      1 => 1416403115,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '23866546cc0970850d6-19894162',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'handle_ctrl' => 0,
    'handle_action' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_546cc097158006_67453291',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_546cc097158006_67453291')) {function content_546cc097158006_67453291($_smarty_tpl) {?><div class="nav">
    <ul class="wd">
        <li><a href="index.php" <?php if ($_smarty_tpl->tpl_vars['handle_ctrl']->value=="main"){?>class="on"<?php }?>>首页</a></li>
        <li>
			<a href="index.php?c=article" <?php if ($_smarty_tpl->tpl_vars['handle_ctrl']->value=="category"||$_smarty_tpl->tpl_vars['handle_ctrl']->value=="article"||$_smarty_tpl->tpl_vars['handle_ctrl']->value=="tag"||$_smarty_tpl->tpl_vars['handle_ctrl']->value=="page"){?>class="on"<?php }?>>内容管理</a>
			<dl>
				<dd><a href="index.php?c=article" <?php if ($_smarty_tpl->tpl_vars['handle_ctrl']->value=="article"){?>class="on"<?php }?>>文章管理</a></dd>
				<dd><a href="index.php?c=page" <?php if ($_smarty_tpl->tpl_vars['handle_ctrl']->value=="page"){?>class="on"<?php }?>>页面管理</a></dd>
				<dd><a href="index.php?c=tag" <?php if ($_smarty_tpl->tpl_vars['handle_ctrl']->value=="tag"){?>class="on"<?php }?>>标签管理</a></dd>
				<dd><a href="index.php?c=category" <?php if ($_smarty_tpl->tpl_vars['handle_ctrl']->value=="category"){?>class="on"<?php }?>>分类管理</a></dd>
			</dl>
		</li>
        <li><a href="index.php?c=flink" <?php if ($_smarty_tpl->tpl_vars['handle_ctrl']->value=="flink"){?>class="on"<?php }?>>链接管理</a></li>
		<li><a href="index.php?c=comment" <?php if ($_smarty_tpl->tpl_vars['handle_ctrl']->value=="comment"){?>class="on"<?php }?>>评论管理</a></li>
		<li><a href="index.php?c=upload" <?php if ($_smarty_tpl->tpl_vars['handle_ctrl']->value=="upload"){?>class="on"<?php }?>>附件管理</a></li>
		<li><a href="index.php?c=user" <?php if ($_smarty_tpl->tpl_vars['handle_ctrl']->value=="user"){?>class="on"<?php }?>>用户管理</a></li>
		<li>
			<a href="index.php?c=options" <?php if ($_smarty_tpl->tpl_vars['handle_ctrl']->value=="options"){?>class="on"<?php }?>>设置</a>
			<dl>
				<dd><a href="index.php?c=options" <?php if ($_smarty_tpl->tpl_vars['handle_ctrl']->value=="options"&&$_smarty_tpl->tpl_vars['handle_action']->value=="main"){?>class="on"<?php }?>>基本设置</a></dd>
				<dd><a href="index.php?c=options&a=upload" <?php if ($_smarty_tpl->tpl_vars['handle_ctrl']->value=="options"&&$_smarty_tpl->tpl_vars['handle_action']->value=="upload"){?>class="on"<?php }?>>上传设置</a></dd>
				<dd><a href="index.php?c=options&a=permalink" <?php if ($_smarty_tpl->tpl_vars['handle_ctrl']->value=="options"&&$_smarty_tpl->tpl_vars['handle_action']->value=="permalink"){?>class="on"<?php }?>>链接设置</a></dd>
				
			</dl>
		</li>
    </ul>
</div>
<script type="text/javascript">
	$(function() {
		$("div.nav > ul > li").hover(function() {
			$(this).find("dl").show()
					;
		}, function() {
			$(this).find("dl").hide();
		});
	});
</script><?php }} ?>