<?php /* Smarty version Smarty-3.1.14, created on 2014-11-22 20:09:10
         compiled from "D:\PHProot\jprass-blog\Admin\Tpl\article\add.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2374154707ce64ed826-28593021%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '923ac587991f60e265c8e2cc7a8aab8cd2f4c1e3' => 
    array (
      0 => 'D:\\PHProot\\jprass-blog\\Admin\\Tpl\\article\\add.tpl',
      1 => 1416408051,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2374154707ce64ed826-28593021',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'maxSize' => 0,
    'extArr' => 0,
    'handle_ctrl' => 0,
    'listCate' => 0,
    'cate' => 0,
    'i' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_54707ce65b4bd5_61014876',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54707ce65b4bd5_61014876')) {function content_54707ce65b4bd5_61014876($_smarty_tpl) {?><?php if (!is_callable('smarty_function_jprass_config')) include 'D:\\PHProot\\jprass-blog\\Core\\smarty\\plugins\\function.jprass_config.php';
if (!is_callable('smarty_modifier_date_format')) include 'D:\\PHProot\\jprass-blog\\Core\\smarty\\plugins\\modifier.date_format.php';
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title>添加文章-<?php echo smarty_function_jprass_config(array('name'=>"blog.title"),$_smarty_tpl);?>
-Powered by Joyphper</title>
        <link type="text/css" href="Css/admin.css" rel="stylesheet">
        <script type="text/javascript" src="../Script/jquery.min.js"></script>
		<script type="text/javascript" src="../Script/xheditor/xheditor-1.1.14-zh_cn.min.js" charset="utf-8" ></script>
		<script type="text/javascript" src="../Script/jquery.sdialog.js"></script>
		<script type="text/javascript" src="Script/swfupload/swfupload.js"></script>
		<script type="text/javascript" src="Script/swfupload/swfupload.queue.js"></script>
		<script type="text/javascript" src="Script/swfupload/handler.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				editor = $('textarea[name="content"]').xheditor();
				$("#btn-save").click(function() {
					$("#status").val(2);
					$("#article-form").submit();
				});
				$("#btn-submit").click(function() {
					$("#status").val(1);
					$("#article-form").submit();
				});

				var settings = {
					flash_url: "Script/swfupload/swfupload.swf",
					upload_url: "index.php",
					post_params: {"c": "upload", "a": "handler", 'PHPSESSID': '<?php echo $_COOKIE['PHPSESSID'];?>
'},
					file_size_limit: "<?php echo $_smarty_tpl->tpl_vars['maxSize']->value;?>
",
					file_types: "<?php echo $_smarty_tpl->tpl_vars['extArr']->value;?>
",
					file_types_description: "所有文件",
					file_upload_limit: 0,
					file_queue_limit: 0,
					// Button Settings
					button_placeholder_id: "swfu-placeholder",
					button_text: '上传文件',
					button_image_url: "Css/swfupload_btn.png",
					button_width: 61,
					button_height: 22,
					button_window_mode: SWFUpload.WINDOW_MODE.TRANSPARENT,
					button_cursor: SWFUpload.CURSOR.HAND,
					//Handle Settings
					file_dialog_complete_handler: fileDialogComplete,
					upload_start_handler: uploadStart,
					upload_progress_handler: uploadProgress,
					upload_success_handler: uploadSuccess,
					queue_complete_handler: uploadComplete,
					upload_error_handler: uploadError
				};
				new SWFUpload(settings);
			});
		</script>
    </head>
    <body>
        <?php echo $_smarty_tpl->getSubTemplate ("../include/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

        <?php echo $_smarty_tpl->getSubTemplate ("../include/nav.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

        <div class="breadcrumb wd">当前位置：
			<a href="index.php">首页</a>&gt;
			<a href="index.php?c=<?php echo $_smarty_tpl->tpl_vars['handle_ctrl']->value;?>
">文章管理</a>&gt;
			添加文章</div>
        <div class="main-panel wd">
            <div class="title_line">添加文章</div>
            <form class="form form-stacked" id="article-form" action="index.php?c=article&a=add" method="post">
				<input type="hidden" name="status" id="status" value="1" />
				<table cellspacing="0" align="center" width="960">
					<tr>
						<td>
							<label><strong>文章标题</strong></label>
							<input type="text" name="title" id="title" class="xfull" />
							<!--<label><strong>关键字</strong></label>
							<input type="text" name="keywords" id="keywords" class="xfull" />-->
							<label><strong>描述</strong></label>
							<textarea name="description" id="description" class="xfull" style="height:40px;"></textarea>
							<label><strong>内容</strong><span href="javascript:;" id="attach-btn"><a id="swfu-placeholder"></a></span></label>
							<ul class="upload-progress xfull" id="swfu-progress"></ul>
							<textarea name="content" id="content" class="xfull" style="height: 382px;"></textarea>
							<label><strong>标签</strong></label>
							<input type="text" name="tags" id="tags" class="xxlarge" />
							<span>多个标签用英文","分开</span>
							<div style="text-align: right">
								<button class="btn" id="btn-save" type="button">保存草稿</button>
								<button class="btn" id="btn-submit" type="button">发布文章</button>
							</div>

						</td>
						<td width="230" valign="top">
							<label><strong>时间</strong></label>
							<input type="text" name="_year" id="year" maxlength="4" style="width:35px" value="<?php echo smarty_modifier_date_format(time(),'%Y');?>
" />
							<span>-</span>
							<input type="text" name="_month" id="month" maxlength="2" style="width:20px" value="<?php echo smarty_modifier_date_format(time(),'%m');?>
" />
							<span>-</span>
							<input type="text" name="_day" id="day" maxlength="2" style="width:20px" value="<?php echo smarty_modifier_date_format(time(),'%d');?>
" />
							<span>@</span>
							<input type="text" name="_hour" id="hour" maxlength="2" style="width:20px" value="<?php echo smarty_modifier_date_format(time(),'%H');?>
" />
							<span>:</span>
							<input type="text" name="_min" id="min" maxlength="2" style="width:20px" value="<?php echo smarty_modifier_date_format(time(),'%M');?>
" />

							<label><strong>文章来源</strong></label>
							<input type="text" name="from" id="from" class="xfull" />
							<label><strong>文章来源地址</strong></label>
							<input type="text" name="fromurl" id="fromurl" class="xfull" />
							<label><strong>分类</strong></label>
							<div class="select-cate">
								<?php  $_smarty_tpl->tpl_vars['cate'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['cate']->_loop = false;
 $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['listCate']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['cate']->key => $_smarty_tpl->tpl_vars['cate']->value){
$_smarty_tpl->tpl_vars['cate']->_loop = true;
 $_smarty_tpl->tpl_vars['i']->value = $_smarty_tpl->tpl_vars['cate']->key;
?>
								<label><input type="checkbox" name="cid[]" value="<?php echo $_smarty_tpl->tpl_vars['cate']->value['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['i']->value==0){?>checked<?php }?> /><?php echo $_smarty_tpl->tpl_vars['cate']->value['catename'];?>
</label>
								<?php } ?>
							</div>
						</td>
					</tr>
				</table>
            </form>
        </div>
        <?php echo $_smarty_tpl->getSubTemplate ("../include/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

    </body>
</html><?php }} ?>