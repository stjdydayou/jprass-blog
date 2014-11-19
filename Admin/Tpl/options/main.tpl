<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title>基本设置-<{jprass_config name="blog.title"}>-Powered by Joyphper</title>
        <link type="text/css" href="Css/admin.css" rel="stylesheet">
        <script type="text/javascript" src="../Script/jquery.min.js"></script>
    </head>
    <body>
        <{include file="../include/header.tpl"}>
        <{include file="../include/nav.tpl"}>
        <div class="breadcrumb wd">当前位置：<a href="index.php">首页</a>&gt;基本设置</div>
        <div class="main-panel wd">
			<div class="title_line">基本设置</div>
			<form class="form form-aligned" id="ajax-submit-form" action="index.php?c=options" method="post">
                <div class="control-group">
                    <label>博客标题</label>
                    <input type="text" name="title" id="title" value="<{$options.title}>" class="large" />
					<span>站点的名称将显示在网页的标题处</span>
                </div>
				<div class="control-group">
                    <label>博客地址</label>
                    <input type="text" name="url" id="title" value="<{$options.url}>" class="large" />
                </div>
                <div class="control-group">
                    <label>站点副标题</label>
                    <input type="text" name="subtitle" id="subtitle" value="<{$options.subtitle}>" class="xxlarge" />
                </div>
				<div class="control-group">
                    <label>关键词</label>
                    <input type="text" name="keywords" id="keywords" value="<{$options.keywords}>" class="xxlarge" />
					<span>请以半角逗号","分割多个关键字</span>
                </div>
                <div class="control-group">
                    <label>站点描述</label>
                    <textarea name="description" id="description" class="xxlarge"><{$options.description}></textarea>
                </div>
                <div class="control-group">
					<label>时区设置</label>
					<select name="default_timezone">
						<option value="0" <{if $options.default_timezone eq '0'}>selected<{/if}>>格林威治(子午线)标准时间 (GMT)</option>
						<option value="1" <{if $options.default_timezone eq '1'}>selected<{/if}>>中欧标准时间 阿姆斯特丹,荷兰,法国 (GMT +1)</option>
						<option value="2" <{if $options.default_timezone eq '2'}>selected<{/if}>>东欧标准时间 布加勒斯特,塞浦路斯,希腊 (GMT +2)</option>
						<option value="3" <{if $options.default_timezone eq '3'}>selected<{/if}>>莫斯科时间 伊拉克,埃塞俄比亚,马达加斯加 (GMT +3)</option>
						<option value="4" <{if $options.default_timezone eq '4'}>selected<{/if}>>第比利斯时间 阿曼,毛里塔尼亚,留尼汪岛 (GMT +4)</option>
						<option value="5" <{if $options.default_timezone eq '5'}>selected<{/if}>>新德里时间 巴基斯坦,马尔代夫 (GMT +5)</option>
						<option value="6" <{if $options.default_timezone eq '6'}>selected<{/if}>>科伦坡时间 孟加拉 (GMT +6)</option>
						<option value="7" <{if $options.default_timezone eq '7'}>selected<{/if}>>曼谷雅加达 柬埔寨,苏门答腊,老挝 (GMT +7)</option>
						<option value="8" <{if $options.default_timezone eq '8'}>selected<{/if}>>北京时间 香港,新加坡,越南 (GMT +8)</option>
						<option value="9" <{if $options.default_timezone eq '9'}>selected<{/if}>>东京平壤时间 西伊里安,摩鹿加群岛 (GMT +9)</option>
						<option value="10" <{if $options.default_timezone eq '10'}>selected<{/if}>>悉尼关岛时间 塔斯马尼亚岛,新几内亚 (GMT +10)</option>
						<option value="11" <{if $options.default_timezone eq '11'}>selected<{/if}>>所罗门群岛 库页岛 (GMT +11)</option>
						<option value="12" <{if $options.default_timezone eq '12'}>selected<{/if}>>惠灵顿时间 新西兰,斐济群岛 (GMT +12)</option>
						<option value="-1" <{if $options.default_timezone eq '-1'}>selected<{/if}>>佛德尔群岛 亚速尔群岛,葡属几内亚 (GMT -1)</option>
						<option value="-2" <{if $options.default_timezone eq '-2'}>selected<{/if}>>大西洋中部时间 格陵兰 (GMT -2)</option>
						<option value="-3" <{if $options.default_timezone eq '-3'}>selected<{/if}>>布宜诺斯艾利斯 乌拉圭,法属圭亚那 (GMT -3)</option>
						<option value="-4" <{if $options.default_timezone eq '-4'}>selected<{/if}>>智利巴西 委内瑞拉,玻利维亚 (GMT -4)</option>
						<option value="-5" <{if $options.default_timezone eq '-5'}>selected<{/if}>>纽约渥太华 古巴,哥伦比亚,牙买加 (GMT -5)</option>
						<option value="-6" <{if $options.default_timezone eq '-6'}>selected<{/if}>>墨西哥城时间 洪都拉斯,危地马拉,哥斯达黎加 (GMT -6)</option>
						<option value="-7" <{if $options.default_timezone eq '-7'}>selected<{/if}>>美国丹佛时间 (GMT -7)</option>
						<option value="-8" <{if $options.default_timezone eq '-8'}>selected<{/if}>>美国旧金山时间 (GMT -8)</option>
						<option value="-9" <{if $options.default_timezone eq '-9'}>selected<{/if}>>阿拉斯加时间 (GMT -9)</option>
						<option value="-10" <{if $options.default_timezone eq '-10'}>selected<{/if}>>夏威夷群岛 (GMT -10)</option>
						<option value="-11" <{if $options.default_timezone eq '-11'}>selected<{/if}>>东萨摩亚群岛 (GMT -11)</option>
						<option value="-12" <{if $options.default_timezone eq '-12'}>selected<{/if}>>艾尼威托克岛 (GMT -12)</option>
					</select>
                </div>
                <div class="control-group">
                    <label>&nbsp;</label>
                    <button class="btn" id="submit-btn" type="submit">提交保存</button>
                    <span id="validator-msg"></span>
                </div>
            </form>
        </div>
        <{include file="../include/footer.tpl"}>
    </body>
</html>