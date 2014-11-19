<?php

/*
 * 读取文章归档
 * FileName block.jprass_archives.php 
 * Date     2013-9-21  10:37:00
 * Author   Sjime
 * Mail     me@joyphper.net
 * QQ       97142822
 * Copyright (C) 2013 joyphper.net
 */

function smarty_block_jprass_archives($params, $content, &$smarty, &$repeat) {
	if (!isset($params['id']) || empty($params['id'])) {
		//输出时，需要定义一个变量进行存储
		//当检测参数中没有定义此名称时，可以使用 throw 来抛出一个 SmartyException 对象来停止程序执行
		//throw new SmartyException("Param 'name' is not defined");
		//也可以给它默认一个名字
		$params['id'] = "vo";
		//本示例使用默认设置名称为 item 的方法
	}
	//index
	$keyindex = "k";
	if (isset($params["key"]) && !empty($params["key"])) {
		$keyindex = $params["key"];
	}

	$dataindex = md5(__FUNCTION__ . md5(serialize($params)));
	if (!isset($smarty->block_data)) {
		$smarty->block_data = array();
	}
	if (!isset($smarty->block_data[$dataindex])) {
		
		$sql = "select a.years,a.id,count(1) arcnum,months from (select FROM_UNIXTIME(dateline,'%M') as months,FROM_UNIXTIME(dateline,'%Y' ) as years,FROM_UNIXTIME(dateline,'%Y%m') as id from ##_article where type='post') a group by a.years,a.id order by a.id desc";

		$res = JPrassApi::getQuery()->findSqlAll($sql);
		
		if ($res) {
			// $res 要输出的结果；
			// 示例程序是直接定义了要输出的结果，通常是通过读取数据库来创建二维或多数组来实现
			$smarty->block_data[$dataindex] = $res;
			$smarty->block_data[$dataindex . $keyindex] = 1;
		}
	}
	if (isset($smarty->block_data[$dataindex]) && is_array($smarty->block_data[$dataindex])) {
		$item = array_shift($smarty->block_data[$dataindex]);
		$item[$keyindex] = $smarty->block_data[$dataindex . $keyindex]++;

		$item['url'] = BlogRouter::buildUrl("archives", $item['id']);

		$smarty->assign($params['id'], $item);

		if (count($smarty->block_data[$dataindex]) == 0) {
			$smarty->block_data[$dataindex] = false;
			$smarty->block_data[$dataindex . $keyindex] = 1;
		}
		$repeat = true;
	} else {
		$repeat = false;
	}
	echo $content;
}

?>
