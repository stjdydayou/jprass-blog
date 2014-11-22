<?php /* Smarty version Smarty-3.1.14, created on 2014-11-22 19:56:11
         compiled from "D:\PHProot\jprass-blog\Tpl\default\sidebar.tpl" */ ?>
<?php /*%%SmartyHeaderCode:29952547079db2bcb53-94119209%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'be7115b05a0ee9224edd41ee0678baf0a20e4c37' => 
    array (
      0 => 'D:\\PHProot\\jprass-blog\\Tpl\\default\\sidebar.tpl',
      1 => 1416402662,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '29952547079db2bcb53-94119209',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'vo' => 0,
    'handle_ctrl' => 0,
    'handle_action' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_547079db3456f8_11886706',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_547079db3456f8_11886706')) {function content_547079db3456f8_11886706($_smarty_tpl) {?><?php if (!is_callable('smarty_block_jprass_category')) include 'D:\\PHProot\\jprass-blog\\Core\\smarty\\plugins\\block.jprass_category.php';
if (!is_callable('smarty_block_jprass_archives')) include 'D:\\PHProot\\jprass-blog\\Core\\smarty\\plugins\\block.jprass_archives.php';
if (!is_callable('smarty_block_jprass_tag')) include 'D:\\PHProot\\jprass-blog\\Core\\smarty\\plugins\\block.jprass_tag.php';
if (!is_callable('smarty_block_jprass_flink')) include 'D:\\PHProot\\jprass-blog\\Core\\smarty\\plugins\\block.jprass_flink.php';
?><div class="sidebar">
    <div class="baidu-ad">
		<script type="text/javascript">
			/*200*200，net右则广告_2*/
			var cpro_id = 'u380711';
		</script>
		<script src="http://cpro.baidu.com/cpro/ui/c.js" type="text/javascript"></script>
    </div>
    <dl>
		<dt>分类</dt>
		<dd>
			<?php $_smarty_tpl->smarty->_tag_stack[] = array('jprass_category', array()); $_block_repeat=true; echo smarty_block_jprass_category(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

			<span><a href="<?php echo $_smarty_tpl->tpl_vars['vo']->value['url'];?>
"><?php echo $_smarty_tpl->tpl_vars['vo']->value['catename'];?>
(<?php echo $_smarty_tpl->tpl_vars['vo']->value['arcnum'];?>
)</a></span>
			<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_jprass_category(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

		</dd>
    </dl>
    <dl>
		<dt>归档</dt>
		<dd>
			<?php $_smarty_tpl->smarty->_tag_stack[] = array('jprass_archives', array()); $_block_repeat=true; echo smarty_block_jprass_archives(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

			<span><a href="<?php echo $_smarty_tpl->tpl_vars['vo']->value['url'];?>
"><?php echo $_smarty_tpl->tpl_vars['vo']->value['months'];?>
 <?php echo $_smarty_tpl->tpl_vars['vo']->value['years'];?>
(<?php echo $_smarty_tpl->tpl_vars['vo']->value['arcnum'];?>
)</a></span>
			<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_jprass_archives(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

		</dd>
    </dl>
    <dl>
		<dt>标签</dt>
		<dd>
			<?php $_smarty_tpl->smarty->_tag_stack[] = array('jprass_tag', array('limit'=>"0,30")); $_block_repeat=true; echo smarty_block_jprass_tag(array('limit'=>"0,30"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

			<a href="<?php echo $_smarty_tpl->tpl_vars['vo']->value['url'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['vo']->value['arcnum'];?>
篇文章"><?php echo $_smarty_tpl->tpl_vars['vo']->value['tagname'];?>
</a>
			<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_jprass_tag(array('limit'=>"0,30"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

		</dd>
    </dl>
    <?php if ($_smarty_tpl->tpl_vars['handle_ctrl']->value=='main'&&$_smarty_tpl->tpl_vars['handle_action']->value=='index'){?>
    <dl>
		<dt>友情链接</dt>
		<dd>
			<?php $_smarty_tpl->smarty->_tag_stack[] = array('jprass_flink', array('visible'=>"Y")); $_block_repeat=true; echo smarty_block_jprass_flink(array('visible'=>"Y"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

			<span><a href="<?php echo $_smarty_tpl->tpl_vars['vo']->value['url'];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['vo']->value['name'];?>
</a></span>
			<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_jprass_flink(array('visible'=>"Y"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

		</dd>
    </dl>
    <?php }?>
</div><?php }} ?>