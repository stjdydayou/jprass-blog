<?php /* Smarty version Smarty-3.1.14, created on 2014-11-20 00:08:54
         compiled from "D:\PHProot\jprass-blog\Admin\Tpl\index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:24924546cc096eae092-29946115%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3a516c4988fc4826c5ac024f3c0a200e25d6fbc7' => 
    array (
      0 => 'D:\\PHProot\\jprass-blog\\Admin\\Tpl\\index.tpl',
      1 => 1416408099,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '24924546cc096eae092-29946115',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'loginUser' => 0,
    'articleCount' => 0,
    'commentCount' => 0,
    'categoryCount' => 0,
    'uploadCount' => 0,
    'flinkCount' => 0,
    'sysinfo' => 0,
    'listArticle' => 0,
    'article' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.14',
  'unifunc' => 'content_546cc09705a140_53604689',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_546cc09705a140_53604689')) {function content_546cc09705a140_53604689($_smarty_tpl) {?><?php if (!is_callable('smarty_function_jprass_config')) include 'D:\\PHProot\\jprass-blog\\Core\\smarty\\plugins\\function.jprass_config.php';
if (!is_callable('smarty_function_jprass_gravatar')) include 'D:\\PHProot\\jprass-blog\\Core\\smarty\\plugins\\function.jprass_gravatar.php';
if (!is_callable('smarty_modifier_date_format')) include 'D:\\PHProot\\jprass-blog\\Core\\smarty\\plugins\\modifier.date_format.php';
if (!is_callable('smarty_function_jprass_url')) include 'D:\\PHProot\\jprass-blog\\Core\\smarty\\plugins\\function.jprass_url.php';
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title>管理首页-<?php echo smarty_function_jprass_config(array('name'=>"blog.title"),$_smarty_tpl);?>
-Powered by Joyphper</title>
        <link type="text/css" href="Css/admin.css" rel="stylesheet">
		<script type="text/javascript" src="../Script/jquery.min.js"></script>
        <style type="text/css">
			.main-panel{position: relative;overflow: hidden}
            .user-info{height:130px;width:60%; position: absolute}
            .user-info dt img{margin:10px;float:left;height:100px;width:100px;border: 1px solid #DEE4C5;padding:2px;}
            .user-info dd{float:left}
            .user-info dd h2{margin-top:10px;font-weight: 600;}
			.sysinfo{width: 60%;position: absolute; top: 130px;}
			.sysinfo dt{border-bottom: 2px solid #D9E3EC;padding: 10px;margin: 0 10px;font-size: 14px;font-weight: bold;}
			.sysinfo dd{line-height: 25px;text-indent: 2em;}

			.latest-article dt{border-bottom: 2px solid #D9E3EC;padding: 10px;margin: 0 10px;font-size: 14px;font-weight: bold;}
			.latest-article{width: 37%;position: absolute; left:63%;}
			.latest-article dd{line-height: 25px;margin-left: 1em; margin-top: 5px;}
			.latest-article dd p{margin: 0}

        </style>
    </head>
    <body>
        <?php echo $_smarty_tpl->getSubTemplate ("./include/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

        <?php echo $_smarty_tpl->getSubTemplate ("./include/nav.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

        <div class="main-panel wd" style="margin-top:12px;">
            <dl class="user-info">
                <dt><?php echo smarty_function_jprass_gravatar(array('email'=>$_smarty_tpl->tpl_vars['loginUser']->value['email']),$_smarty_tpl);?>
</dt>
                <dd>
                    <h2><?php echo $_smarty_tpl->tpl_vars['loginUser']->value['login_name'];?>
<cite>(<?php echo $_smarty_tpl->tpl_vars['loginUser']->value['screen_name'];?>
)</cite></h2>
                    <p>目前共有<?php echo $_smarty_tpl->tpl_vars['articleCount']->value;?>
 篇文章,<?php echo $_smarty_tpl->tpl_vars['commentCount']->value;?>
条评论，<?php echo $_smarty_tpl->tpl_vars['categoryCount']->value;?>
个分类，<?php echo $_smarty_tpl->tpl_vars['uploadCount']->value;?>
个附件,<?php echo $_smarty_tpl->tpl_vars['flinkCount']->value;?>
个链接</p>
                    <p>上次登录时间: <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['loginUser']->value['last_login_time'],'%Y-%m-%d %H:%M:%S');?>
</p>
                    <p>上次登录IP: <?php echo $_smarty_tpl->tpl_vars['loginUser']->value['last_login_ip'];?>
</p>
                </dd>
            </dl>

			<dl class="sysinfo">
				<dt>服务器信息</dt>
				<dd>
					PHP环境：<?php echo $_smarty_tpl->tpl_vars['sysinfo']->value['environment'];?>

				</dd>
				<dd>
					MySQL客户端版本：<?php echo $_smarty_tpl->tpl_vars['sysinfo']->value['mysql_version'];?>

				</dd>
				<dd>
					GD库版本：<?php echo $_smarty_tpl->tpl_vars['sysinfo']->value['gd'];?>

				</dd>
				<dd>
					Register_Globals：<?php echo $_smarty_tpl->tpl_vars['sysinfo']->value['register_globals'];?>

				</dd>
				<dd>
					safe_mode：<?php echo $_smarty_tpl->tpl_vars['sysinfo']->value['safe_mode'];?>

				</dd>
				<dd>
					最大上传：<?php echo $_smarty_tpl->tpl_vars['sysinfo']->value['allow_upload_size'];?>

				</dd>
				<dd>
					内存占用率：<?php echo $_smarty_tpl->tpl_vars['sysinfo']->value['memory'];?>

				</dd>
			</dl>
			<dl class="latest-article">
				<dt>最新文章</dt>
				<?php  $_smarty_tpl->tpl_vars['article'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['article']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['listArticle']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['article']->key => $_smarty_tpl->tpl_vars['article']->value){
$_smarty_tpl->tpl_vars['article']->_loop = true;
?>
				<dd>
					<?php if ($_smarty_tpl->tpl_vars['article']->value['status']==2){?><font color='red'>[草稿]</font><?php }?>
					[<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['article']->value['dateline'],'Y-m-d');?>
]
					<a href="<?php echo smarty_function_jprass_url(array('module'=>'article','id'=>$_smarty_tpl->tpl_vars['article']->value['id'],'dateline'=>$_smarty_tpl->tpl_vars['article']->value['dateline']),$_smarty_tpl);?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['article']->value['title'];?>
</a>
				</dd>
				<?php } ?>
			</dl>
        </div>
        <?php echo $_smarty_tpl->getSubTemplate ("./include/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

    </body>
</html><?php }} ?>