<?php /* Smarty version Smarty-3.1.14, created on 2014-11-20 00:09:07
         compiled from "D:\PHProot\jprass-blog\Admin\Tpl\options\main.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10721546cc0a3aa5b91-15879147%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '20c5e3ee13d1f5316645e0d0d68e6ab27109fc0d' => 
    array (
      0 => 'D:\\PHProot\\jprass-blog\\Admin\\Tpl\\options\\main.tpl',
      1 => 1416408099,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10721546cc0a3aa5b91-15879147',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'options' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_546cc0a3c248f9_55633924',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_546cc0a3c248f9_55633924')) {function content_546cc0a3c248f9_55633924($_smarty_tpl) {?><?php if (!is_callable('smarty_function_jprass_config')) include 'D:\\PHProot\\jprass-blog\\Core\\smarty\\plugins\\function.jprass_config.php';
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title>基本设置-<?php echo smarty_function_jprass_config(array('name'=>"blog.title"),$_smarty_tpl);?>
-Powered by Joyphper</title>
        <link type="text/css" href="Css/admin.css" rel="stylesheet">
        <script type="text/javascript" src="../Script/jquery.min.js"></script>
    </head>
    <body>
        <?php echo $_smarty_tpl->getSubTemplate ("../include/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

        <?php echo $_smarty_tpl->getSubTemplate ("../include/nav.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

        <div class="breadcrumb wd">当前位置：<a href="index.php">首页</a>&gt;基本设置</div>
        <div class="main-panel wd">
			<div class="title_line">基本设置</div>
			<form class="form form-aligned" id="ajax-submit-form" action="index.php?c=options" method="post">
                <div class="control-group">
                    <label>博客标题</label>
                    <input type="text" name="title" id="title" value="<?php echo $_smarty_tpl->tpl_vars['options']->value['title'];?>
" class="large" />
					<span>站点的名称将显示在网页的标题处</span>
                </div>
				<div class="control-group">
                    <label>博客地址</label>
                    <input type="text" name="url" id="title" value="<?php echo $_smarty_tpl->tpl_vars['options']->value['url'];?>
" class="large" />
                </div>
                <div class="control-group">
                    <label>站点副标题</label>
                    <input type="text" name="subtitle" id="subtitle" value="<?php echo $_smarty_tpl->tpl_vars['options']->value['subtitle'];?>
" class="xxlarge" />
                </div>
				<div class="control-group">
                    <label>关键词</label>
                    <input type="text" name="keywords" id="keywords" value="<?php echo $_smarty_tpl->tpl_vars['options']->value['keywords'];?>
" class="xxlarge" />
					<span>请以半角逗号","分割多个关键字</span>
                </div>
                <div class="control-group">
                    <label>站点描述</label>
                    <textarea name="description" id="description" class="xxlarge"><?php echo $_smarty_tpl->tpl_vars['options']->value['description'];?>
</textarea>
                </div>
                <div class="control-group">
					<label>时区设置</label>
					<select name="default_timezone">
						<option value="0" <?php if ($_smarty_tpl->tpl_vars['options']->value['default_timezone']=='0'){?>selected<?php }?>>格林威治(子午线)标准时间 (GMT)</option>
						<option value="1" <?php if ($_smarty_tpl->tpl_vars['options']->value['default_timezone']=='1'){?>selected<?php }?>>中欧标准时间 阿姆斯特丹,荷兰,法国 (GMT +1)</option>
						<option value="2" <?php if ($_smarty_tpl->tpl_vars['options']->value['default_timezone']=='2'){?>selected<?php }?>>东欧标准时间 布加勒斯特,塞浦路斯,希腊 (GMT +2)</option>
						<option value="3" <?php if ($_smarty_tpl->tpl_vars['options']->value['default_timezone']=='3'){?>selected<?php }?>>莫斯科时间 伊拉克,埃塞俄比亚,马达加斯加 (GMT +3)</option>
						<option value="4" <?php if ($_smarty_tpl->tpl_vars['options']->value['default_timezone']=='4'){?>selected<?php }?>>第比利斯时间 阿曼,毛里塔尼亚,留尼汪岛 (GMT +4)</option>
						<option value="5" <?php if ($_smarty_tpl->tpl_vars['options']->value['default_timezone']=='5'){?>selected<?php }?>>新德里时间 巴基斯坦,马尔代夫 (GMT +5)</option>
						<option value="6" <?php if ($_smarty_tpl->tpl_vars['options']->value['default_timezone']=='6'){?>selected<?php }?>>科伦坡时间 孟加拉 (GMT +6)</option>
						<option value="7" <?php if ($_smarty_tpl->tpl_vars['options']->value['default_timezone']=='7'){?>selected<?php }?>>曼谷雅加达 柬埔寨,苏门答腊,老挝 (GMT +7)</option>
						<option value="8" <?php if ($_smarty_tpl->tpl_vars['options']->value['default_timezone']=='8'){?>selected<?php }?>>北京时间 香港,新加坡,越南 (GMT +8)</option>
						<option value="9" <?php if ($_smarty_tpl->tpl_vars['options']->value['default_timezone']=='9'){?>selected<?php }?>>东京平壤时间 西伊里安,摩鹿加群岛 (GMT +9)</option>
						<option value="10" <?php if ($_smarty_tpl->tpl_vars['options']->value['default_timezone']=='10'){?>selected<?php }?>>悉尼关岛时间 塔斯马尼亚岛,新几内亚 (GMT +10)</option>
						<option value="11" <?php if ($_smarty_tpl->tpl_vars['options']->value['default_timezone']=='11'){?>selected<?php }?>>所罗门群岛 库页岛 (GMT +11)</option>
						<option value="12" <?php if ($_smarty_tpl->tpl_vars['options']->value['default_timezone']=='12'){?>selected<?php }?>>惠灵顿时间 新西兰,斐济群岛 (GMT +12)</option>
						<option value="-1" <?php if ($_smarty_tpl->tpl_vars['options']->value['default_timezone']=='-1'){?>selected<?php }?>>佛德尔群岛 亚速尔群岛,葡属几内亚 (GMT -1)</option>
						<option value="-2" <?php if ($_smarty_tpl->tpl_vars['options']->value['default_timezone']=='-2'){?>selected<?php }?>>大西洋中部时间 格陵兰 (GMT -2)</option>
						<option value="-3" <?php if ($_smarty_tpl->tpl_vars['options']->value['default_timezone']=='-3'){?>selected<?php }?>>布宜诺斯艾利斯 乌拉圭,法属圭亚那 (GMT -3)</option>
						<option value="-4" <?php if ($_smarty_tpl->tpl_vars['options']->value['default_timezone']=='-4'){?>selected<?php }?>>智利巴西 委内瑞拉,玻利维亚 (GMT -4)</option>
						<option value="-5" <?php if ($_smarty_tpl->tpl_vars['options']->value['default_timezone']=='-5'){?>selected<?php }?>>纽约渥太华 古巴,哥伦比亚,牙买加 (GMT -5)</option>
						<option value="-6" <?php if ($_smarty_tpl->tpl_vars['options']->value['default_timezone']=='-6'){?>selected<?php }?>>墨西哥城时间 洪都拉斯,危地马拉,哥斯达黎加 (GMT -6)</option>
						<option value="-7" <?php if ($_smarty_tpl->tpl_vars['options']->value['default_timezone']=='-7'){?>selected<?php }?>>美国丹佛时间 (GMT -7)</option>
						<option value="-8" <?php if ($_smarty_tpl->tpl_vars['options']->value['default_timezone']=='-8'){?>selected<?php }?>>美国旧金山时间 (GMT -8)</option>
						<option value="-9" <?php if ($_smarty_tpl->tpl_vars['options']->value['default_timezone']=='-9'){?>selected<?php }?>>阿拉斯加时间 (GMT -9)</option>
						<option value="-10" <?php if ($_smarty_tpl->tpl_vars['options']->value['default_timezone']=='-10'){?>selected<?php }?>>夏威夷群岛 (GMT -10)</option>
						<option value="-11" <?php if ($_smarty_tpl->tpl_vars['options']->value['default_timezone']=='-11'){?>selected<?php }?>>东萨摩亚群岛 (GMT -11)</option>
						<option value="-12" <?php if ($_smarty_tpl->tpl_vars['options']->value['default_timezone']=='-12'){?>selected<?php }?>>艾尼威托克岛 (GMT -12)</option>
					</select>
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