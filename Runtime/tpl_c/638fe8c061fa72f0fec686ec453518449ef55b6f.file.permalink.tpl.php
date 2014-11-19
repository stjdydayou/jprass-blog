<?php /* Smarty version Smarty-3.1.14, created on 2014-11-20 00:09:10
         compiled from "D:\PHProot\jprass-blog\Admin\Tpl\options\permalink.tpl" */ ?>
<?php /*%%SmartyHeaderCode:7623546cc0a6db3b08-25066379%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '638fe8c061fa72f0fec686ec453518449ef55b6f' => 
    array (
      0 => 'D:\\PHProot\\jprass-blog\\Admin\\Tpl\\options\\permalink.tpl',
      1 => 1416408098,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7623546cc0a6db3b08-25066379',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'options' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_546cc0a6e4ff30_62902534',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_546cc0a6e4ff30_62902534')) {function content_546cc0a6e4ff30_62902534($_smarty_tpl) {?><?php if (!is_callable('smarty_function_jprass_config')) include 'D:\\PHProot\\jprass-blog\\Core\\smarty\\plugins\\function.jprass_config.php';
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title>链接设置-<?php echo smarty_function_jprass_config(array('name'=>"blog.title"),$_smarty_tpl);?>
-Powered by Joyphper</title>
        <link type="text/css" href="Css/admin.css" rel="stylesheet">
        <script type="text/javascript" src="../Script/jquery.min.js"></script>
    </head>
    <body>
        <?php echo $_smarty_tpl->getSubTemplate ("../include/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

        <?php echo $_smarty_tpl->getSubTemplate ("../include/nav.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

        <div class="breadcrumb wd">当前位置：<a href="index.php">首页</a>&gt;链接设置</div>
        <div class="main-panel wd">
			<div class="title_line">链接设置</div>
			<form class="form form-aligned" id="ajax-submit-form" action="index.php?c=options&a=permalink" method="post">
                <div class="control-group">
					<label>使用地址重写</label>
					<p>
						<span><input type="radio" value="0" name="rewrite" <?php if (!$_smarty_tpl->tpl_vars['options']->value['rewrite']){?>checked="checked"<?php }?> />不启用</span>
						<span><input type="radio" value="1" name="rewrite" <?php if ($_smarty_tpl->tpl_vars['options']->value['rewrite']){?>checked="checked"<?php }?>>启用</span><br/>
						<span>地址重写即rewrite功能是某些服务器软件提供的优化内部连接的功能。</span><br/>
						<span>打开此功能可以让你的链接看上去完全是静态地址！</span>
					</p>
                </div>
                <div class="control-group">
                    <label>自定义文章URL</label>
                    <p>
						<span><input type="radio" value="1" name="archives_url_pattern" <?php if ($_smarty_tpl->tpl_vars['options']->value['archives_url_pattern']=='1'){?>checked="checked"<?php }?> >默认风格 <strong>/archives/{cid}.html</strong></span><br/>
						<span><input type="radio" value="2" name="archives_url_pattern" <?php if ($_smarty_tpl->tpl_vars['options']->value['archives_url_pattern']=='2'){?>checked="checked"<?php }?>>按日期归档 <strong>/archives/{y}{m}{d}/{cid}.html</strong></span><br/>
						<span>可用参数：{cid} 日志ID、{y} 年、{m} 月、{d} 日</span><br/>
						<span>选择一种合适的文章静态路径风格, 使得你的网站链接更加友好.</span><br/>
						<span>一旦你选择了某种链接风格请不要轻易修改它.</span>
					</p>
                </div>
				<div class="control-group">
                    <label>URL后缀</label>
                    <p>
						<span><input type="radio" value="" name="url_ext" checked="checked"><strong>无</strong></span>
						<span><input type="radio" value=".htm" name="url_ext" <?php if ($_smarty_tpl->tpl_vars['options']->value['url_ext']=='.htm'){?>checked="checked"<?php }?>><strong>htm</strong></span>
						<span><input type="radio" value=".html" name="url_ext" <?php if ($_smarty_tpl->tpl_vars['options']->value['url_ext']=='.html'){?>checked="checked"<?php }?>><strong>html</strong></span>
						<span><input type="radio" value=".php" name="url_ext" <?php if ($_smarty_tpl->tpl_vars['options']->value['url_ext']=='.php'){?>checked="checked"<?php }?>><strong>php</strong></span><br/>
						<span>可用参数：{cid} 日志ID、{y} 年、{m} 月、{d} 日</span><br/>
						<span>选择一种合适的文章静态路径风格, 使得你的网站链接更加友好.</span><br/>
						<span>一旦你选择了某种链接风格请不要轻易修改它.</span>
					</p>
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