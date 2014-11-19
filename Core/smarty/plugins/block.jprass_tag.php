<?php

/**
 * JPrass Blog
 * 读取文章标签
 * @copyright  Copyright (c) 2013 www.jprass.com
 * @filename	block.jprass_tag.php
 * @author		jprass.com
 * @mail		i@jprass.com
 * @QQ			97142822
 * @version    1.0
 */
function smarty_block_jprass_tag($params, $content, &$smarty, &$repeat) {
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
	
	$limit = isset($params['limit']) && !empty($params['limit']) ? $params['limit'] : null;
	
	if (!isset($smarty->block_data[$dataindex])) {
		$db = JPrassApi::getQuery("##_tag");
		if (!empty($limit)) $db->limit($limit);
		
		$db->field("t.*,a.arcnum");
		$db->join("(select count(1) arcnum,tagid from ##_article_tag group by tagid) a on a.tagid = t.id");
		$res=$db->order("a.arcnum desc")->findAll();
		
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

		$item['url'] = BlogRouter::buildUrl("tag", $item['id']);

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
