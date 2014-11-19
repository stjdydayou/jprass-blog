<?php

/*
 * 读取文章分类
 * FileName block.jprass_category.php 
 * Date     2013-9-21  08:54:50
 * Author   Sjime
 * Mail     me@joyphper.net
 * QQ       97142822
 * Copyright (C) 2013 joyphper.net
 */

function smarty_block_jprass_category($params, $content, &$smarty, &$repeat) {
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

	$order = isset($params['order']) && !empty($params['order']) ? $params['order'] : "t.orderid asc";
	$where = isset($params['where']) && !empty($params['where']) ? $params['where'] : null;
	$field = isset($params['field']) && !empty($params['field']) ? $params['field'] : "t.*,a.arcnum";
	$limit = isset($params['limit']) && !empty($params['limit']) ? $params['limit'] : null;

	$dataindex = md5(__FUNCTION__ . md5(serialize($params)));
	if (!isset($smarty->block_data)) {
		$smarty->block_data = array();
	}
	if (!isset($smarty->block_data[$dataindex])) {
		$db = JPrassApi::getQuery("##_category");
		if (!empty($order))
			$db->order($order);
		if (!empty($where))
			$db->where($where);
		if (!empty($field))
			$db->field($field);
		if (!empty($limit))
			$db->limit($limit);

		$db->join("(select count(1) arcnum,cate_id from ##_article_cate group by cate_id) a on a.cate_id = t.id");

		$res = $db->findAll();
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

		if (empty($item['arcnum']))
			$item['arcnum'] = '0';
		$item['url'] = BlogRouter::buildUrl("category", $item['id']);
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
