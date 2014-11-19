<?php /* Smarty version Smarty-3.1.14, created on 2014-11-20 00:09:09
         compiled from "D:\PHProot\jprass-blog\Admin\Tpl\options\upload.tpl" */ ?>
<?php /*%%SmartyHeaderCode:4870546cc0a5873a49-25706296%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4ab43b3aaf57f24079d396f1fbcdaf6f7d820003' => 
    array (
      0 => 'D:\\PHProot\\jprass-blog\\Admin\\Tpl\\options\\upload.tpl',
      1 => 1416408098,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '4870546cc0a5873a49-25706296',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'options' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_546cc0a5927564_95162812',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_546cc0a5927564_95162812')) {function content_546cc0a5927564_95162812($_smarty_tpl) {?><?php if (!is_callable('smarty_function_jprass_config')) include 'D:\\PHProot\\jprass-blog\\Core\\smarty\\plugins\\function.jprass_config.php';
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title>上传设置-<?php echo smarty_function_jprass_config(array('name'=>"blog.title"),$_smarty_tpl);?>
-Powered by Joyphper</title>
        <link type="text/css" href="Css/admin.css" rel="stylesheet">
        <script type="text/javascript" src="../Script/jquery.min.js"></script>
    </head>
    <body>
        <?php echo $_smarty_tpl->getSubTemplate ("../include/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

        <?php echo $_smarty_tpl->getSubTemplate ("../include/nav.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

        <div class="breadcrumb wd">当前位置：<a href="index.php">首页</a>&gt;上传设置</div>
        <div class="main-panel wd">
			<div class="title_line">上传设置</div>
			<form class="form form-aligned" id="ajax-submit-form" action="index.php?c=options&a=upload" method="post">
                <div class="control-group">
                    <label>最大文件大小</label>
                    <input type="text" name="max_size" id="max_size" value="<?php echo $_smarty_tpl->tpl_vars['options']->value['max_size'];?>
" class="large" />
					<span>KB，1MB = 1024 KB</span>
                </div>
                <div class="control-group">
                    <label>允许文件类型</label>
					<p>
						<span><input type="checkbox" value="true" name="file_ext_image" <?php if ($_smarty_tpl->tpl_vars['options']->value['file_ext_image']=='true'){?>checked<?php }?>>图片文件 <strong>gif jpg png tiff bmp</strong></span><br/>
						<span><input type="checkbox" value="true" name="file_ext_media" <?php if ($_smarty_tpl->tpl_vars['options']->value['file_ext_media']=='true'){?>checked<?php }?>>多媒体文件 <strong>mp3 wmv wma rmvb rm avi flv</strong></span><br/>
						<span><input type="checkbox" value="true" name="file_ext_doc" <?php if ($_smarty_tpl->tpl_vars['options']->value['file_ext_doc']=='true'){?>checked<?php }?>>常用档案文件 <strong>txt doc docx xls xlsx ppt pptx zip rar pdf</strong></span><br/>
						<span>其他文件格式<input type="text" name="file_ext_other" value="<?php echo $_smarty_tpl->tpl_vars['options']->value['file_ext_other'];?>
"></span> 用逗号 "," 将后缀名隔开, 例如: php,java,html,cpp<br/>
						
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