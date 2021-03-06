<?php
require_once __JPRASS_CORE_DIR__.'/exception/QueryException.class.php';
class Query {

	//数据库连接标识
	protected $link = null;
	//当前操作的表
	public $table = '';
	//查询参数
	protected $options = array();
	//当前执行的SQL语句
	protected $sql = '';
	//数据库查询次数
	protected $queryCount = 0;
	//数据返回类型, 1代表数组, 2代表对象
	protected $returnType = 1;

	function __construct($link) {
		if (!empty($link)) {
			$this->link = $link;
		} else {
			$db = C("db");
			if (C("Debug")) {
				dump(array("数据库配置" => $db));
			}
		}
	}

	/**
	 * 组织查询SQL语句
	 * @param String $where 查询条件
	 * @param String $field 查询字段
	 * @param String $table 表
	 */
	private function builderSql($where = NULL, $field = '*', $table = '') {
		$this->options['where'] = is_null($where) ? (isset($this->options['where'])?$this->options['where']:null) : $where;
		$this->options['field'] = isset($this->options['field']) ? $this->options['field'] : $field;
		$this->options['table'] = $table == '' ? $this->table : $table;
		$sql = "SELECT {$this->options['field']} FROM `{$this->options['table']}` t";
		$sql .= isset($this->options['join']) ? ' LEFT JOIN ' . $this->options['join'] : '';
		$sql .= isset($this->options['where']) ? ' WHERE ' . $this->options['where'] : '';
		$sql .= isset($this->options['group']) ? ' GROUP BY ' . $this->options['group'] : '';
		$sql .= isset($this->options['having']) ? ' HAVING ' . $this->options['having'] : '';
		$sql .= isset($this->options['order']) ? ' ORDER BY ' . $this->options['order'] : '';
		$sql .= isset($this->options['limit']) ? ' LIMIT ' . $this->options['limit'] : '';
		$this->sql = $sql;
	}

	/**
	 * 查询符合条件的一条记录
	 *
	 * @access      public
	 * @param       string    $where  查询条件
	 * @param       string    $field  查询字段
	 * @param       string    $table  表
	 * @return      mixed             符合条件的记录
	 */
	public function find($where = NULL, $field = '*', $table = '') {
		return $this->findAll($where, $field, $table, FALSE);
	}

	//---------------------- 华丽分割线 ------------------------

	/**
	 * 查询符合条件的所有记录
	 *
	 * @access      public
	 * @param       string    $where  查询条件
	 * @param       string    $field  查询字段
	 * @param       string    $table  表
	 * @return      mixed             符合条件的记录
	 */
	public function findAll($where = NULL, $field = '*', $table = '', $all = TRUE) {
		$this->builderSql($where, $field, $table);
		$result = $this->query();
		$row = $all === TRUE ? $this->fetchAll($result) : $this->fetch($result);
		return $row;
	}

	public function findPage($currentPage, $pageSize, $where = NULL, $field = '*', $table = '') {
		$this->builderSql($where, $field, $table);

		//总的记录数
		$totalCount = $this->count();
		//总的分页数
		$totalPage = ceil($totalCount / $pageSize);
		//取有效的总页数
		if ($totalPage <= 0)
			$totalPage = 1;

		//取有效的当前页
		if (!is_numeric($currentPage) || $currentPage < 1)
			$currentPage = 1;
		if ($currentPage > $totalPage)
			$currentPage = $totalPage;

		$this->limit((($currentPage - 1) * $pageSize), $pageSize);

		$row = $this->findAll();
		if (!$row)
			$row = array();
		$pager = array(
			"count" => $totalCount, // 总记录数
			"size" => $pageSize, // 分页大小
			"total" => $totalPage, // 总页数
			"first" => 1, // 第一页
			"prev" => ( ( $currentPage <= 1 ) ? 1 : ($currentPage - 1) ), // 上一页
			"next" => ( ( $currentPage >= $totalPage ) ? $totalPage : ($currentPage + 1)), // 下一页
			"last" => $totalPage, // 最后一页
			"current" => $currentPage, // 当前页
			"numbers" => array(), // 页码数字
			"records" => $row
		);
		if ($totalPage > 11) {
			if ($currentPage <= 6) {
				$forStart = 1;
				$forEnd = 11;
			} elseif ($currentPage + 5 > $totalPage) {
				$forStart = $totalPage - 10;
				$forEnd = $totalPage;
			} else {
				$forStart = $currentPage - 5;
				$forEnd = $currentPage + 5;
			}
		} else {
			$forStart = 1;
			$forEnd = $totalPage;
		}
		for ($i = $forStart; $i <= $forEnd; $i++)
			$pager['numbers'][] = $i;
		return $pager;
	}

	//---------------------- 华丽分割线 ------------------------

	/**
	 * 读取结果集中的所有记录到数组中
	 *
	 * @access public
	 * @param  resource  $sql  查询语句
	 * @return array
	 */
	public function findSqlAll($sql) {
		$result = $this->query($sql);
		$this->options = array();
		return $this->fetchAll($result);
	}

	//---------------------- 华丽分割线 ------------------------

	/**
	 * 读取结果集中的所有记录到数组中
	 *
	 * @access public
	 * @param  resource  $sql  查询语句
	 * @return array
	 */
	public function findSqlOne($sql) {
		$result = $this->query($sql);
		$this->options = array();
		return $this->fetch($result, 2);
	}

	//---------------------- 华丽分割线 ------------------------

	/**
	 * 读取结果集中的所有记录到数组中
	 *
	 * @access public
	 * @param  resource  $where  查询语句
	 * @return array
	 */
	public function count($where = null) {
		$this->builderSql($where);

		$sql = $this->sql;
		$sql = "SELECT count(*) as count FROM (" . $sql . ") a";
		$result = $this->query($sql);
		$row = $this->fetch($result);
		$count = intval($row["count"]);

		return $count;
	}

	//---------------------- 华丽分割线 ------------------------

	/**
	 * 读取结果集中的所有记录到数组中
	 *
	 * @access public
	 * @param  resource  $result  结果集
	 * @return array
	 */
	public function fetchAll($result = NULL) {
		$rows = array();
		while ($row = $this->fetch($result)) {
			$rows[] = $row;
		}
		return $rows;
	}

	//---------------------- 华丽分割线 ------------------------

	/**
	 * 读取结果集中的一行记录到数组中
	 *
	 * @access public
	 * @param  resource  $result  结果集
	 * @param  int       $type    返回类型, 1为数组, 2为对象
	 * @return mixed              根据返回类型返回
	 */
	public function fetch($result = NULL, $type = NULL) {
		$result = is_null($result) ? $this->result : $result;
		$type = is_null($type) ? $this->returnType : $type;
		$func = $type === 1 ? 'mysql_fetch_assoc' : 'mysql_fetch_object';
		return @$func($result);
	}

	//---------------------- 华丽分割线 ------------------------

	/**
	 * 执行SQL命令
	 *
	 * @access      public
	 * @param       string    $sql    SQL命令
	 * @param       resource  $link   数据库连接标识
	 * @return      mixed             数据库结果集
	 */
	public function query($sql = '', $link = NULL) {
		$this->queryCount++;
		$sql = empty($sql) ? $this->sql : $sql;
		$link = is_null($link) ? $this->link : $link;
		
		$this->result = mysql_query(str_replace("##_", JPrassApi::C("db.prefix"), $sql), $link);
		
		if (JPrassApi::C("dumpSql")) {
			JPrassApi::dump(array("SQL语句" => $sql));
		}
		if (mysql_errno()) {
			throw new QueryException(mysql_error() . ':' . mysql_errno().$this->sql);
		}
		if (is_resource($this->result)) {
			return $this->result;
		}
	}

	//---------------------- 华丽分割线 ------------------------

	/**
	 * 执行SQL命令
	 *
	 * @access      public
	 * @param       string    $sql    SQL命令
	 * @param       resource  $link   数据库连接标识
	 * @return      bool              是否执行成功
	 */
	public function execute($sql = '', $link = NULL) {
		$this->queryCount++;
		$sql = empty($sql) ? $this->sql : $sql;
		$link = is_null($link) ? $this->link : $link;
		
		$result = mysql_query(str_replace("##_", JPrassApi::C("db.prefix"), $sql), $link);

		if (JPrassApi::C("dumpSql")) {
			JPrassApi::dump(array("SQL语句" => $sql));
		}
		if (mysql_errno()) {
			throw new QueryException(mysql_error() . ':' . mysql_errno());
		}

		return $result;
	}

	//---------------------- 华丽分割线 ------------------------

	/**
	 * 插入记录
	 *
	 * @access public
	 * @param  array  $data  插入的记录, 格式:array('字段名'=>'值', '字段名'=>'值');
	 * @param  string $table 表名
	 * @return bool          当前记录id
	 */
	public function add($data, $table = NULL) {
		$table = is_null($table) ? $this->table : $table;
		$sql = "INSERT INTO `{$table}`";
		$fields = $values = array();
		$field = $value = '';
		//遍历记录, 格式化字段名称与值
		foreach ($data as $key => $val) {
			$fields[] = "`{$table}`.`{$key}`";
//			$values[] = "'{$val}'";
			$values[] = '"'.$val.'"';
		}
		$field = join(',', $fields);
		$value = join(',', $values);
		unset($fields, $values);
		$sql .= "({$field}) VALUES({$value})";
		//print_r($sql);
		$this->sql = $sql;
		return $this->execute();
	}

	//---------------------- 华丽分割线 ------------------------

	/**
	 * 批量插入记录 最多一次可以插入5000条记录
	 *
	 * @access public
	 * @param  array  $datas  插入的记录, 格式:array(array('字段名'=>'值', '字段名'=>'值'));
	 * @param  string $table 表名
	 * @return bool
	 */
	public function adds($datas, $table = NULL) {
		$table = is_null($table) ? $this->table : $table;
		$sql = "INSERT INTO `{$table}`";
		$fields = $values = array();
		$field = $value = '';
		$vals = array();
		foreach ($datas as $dk => $data) {
			//遍历记录, 格式化字段名称与值
			foreach ($data as $key => $val) {
				$fields[] = "`{$table}`.`{$key}`";
				$values[] = "'{$val}'";
			}
			$field = join(',', $fields);
			$value = join(',', $values);
			unset($fields, $values);
			$vals[] = '(' . $value . ')';
		}

		$sql .= "({$field}) VALUES " . implode(",", $vals);
		$this->sql = $sql;
		$this->execute();
		$this->options = array();
		return true;
	}

	//---------------------- 华丽分割线 ------------------------

	/**
	 * 删除记录
	 *
	 * @access public
	 * @param  string  $where  条件
	 * @param  string  $table  表名
	 * @return bool            影响行数
	 */
	public function delete($where = NULL, $table = NULL) {
		$table = is_null($table) ? $this->table : $table;
		$where = is_null($where) ? $this->options['where'] : $where;
		$sql = "DELETE FROM `{$table}` WHERE {$where}";
		$this->sql = $sql;
		return $this->execute();
	}

	//---------------------- 华丽分割线 ------------------------

	/**
	 * 更新记录
	 *
	 * @access public
	 * @param  array   $data   更新的数据 格式:array('字段名' => 值);
	 * @param  string  $where  更新条件
	 * @param  string  $table  表名
	 * @return bool            影响多少条信息
	 */
	public function update($data, $where = NULL, $table = NULL) {
		$table = is_null($table) ? $this->table : $table;
		$where = is_null($where) ? $this->options['where'] : $where;
		$sql = "UPDATE `{$table}` t SET ";
		$values = array();
		foreach ($data as $key => $val) {
			$val = is_numeric($val) ? $val : "{$val}";
			$values[] = 't.`'.$key.'` = "'.$val.'"';
		}
		$value = join(',', $values);
		$this->sql = $sql . $value . " WHERE {$where}";
		return $this->execute();
	}

	//---------------------- 华丽分割线 ------------------------
	//自动加载函数, 实现特殊操作
	public function __call($func, $args) {
		if (in_array($func, array('field', 'where', 'order', 'group', 'having'))) {
			$this->options[$func] = array_shift($args);
			return $this;
		} elseif ($func === 'join') {
			if (count($args) == 1) {
				$this->options['join'] = array_shift($args);
			} else {
				$this->options['join'] = "`" . array_shift($args) . "` " . array_shift($args);
			}
			return $this;
		} elseif ($func === 'limit') {
			if (count($args) == 1) {
				$this->options["limit"] = array_shift($args);
			} else {
				$this->options["limit"] = array_shift($args) . "," . array_shift($args);
			}
			return $this;
		} elseif ($func === 'table') {
			$this->options['table'] = array_shift($args);
			$this->table = $this->options['table'];
			return $this;
		}
	}

	//返回上一次操作所影响的行数
	public function affectedRows($link = null) {
		$link = is_null($link) ? $this->link : $link;
		return mysql_affected_rows($link);
	}

	//返回上一次操作记录的id
	public function insertId($link = null) {
		$link = is_null($link) ? $this->link : $link;
		return mysql_insert_id($link);
	}

	//清空结果集
	public function free($result = null) {
		$result = is_null($result) ? $this->result : $result;
		return mysql_free_result($result);
	}

	//返回错误信息
	public function getError($link = NULL) {
		$link = is_null($link) ? $this->link : $link;
		return mysql_error($link);
	}

	//返回错误编号
	public function getErrno($link = NULL) {
		$link = is_null($link) ? $this->link : $link;
		return mysql_errno($link);
	}

	/**
	 * 事物处理标志
	 */
	public function transaction($link = NULL) {
		$this->execute("START TRANSACTION;", $link);
		$this->execute("SET AUTOCOMMIT=0;", $link);
	}

	/**
	 * 事务提交
	 */
	public function commit($link = NULL) {
		$this->execute("COMMIT;", $link);
	}

	/**
	 * 事务回滚
	 */
	public function rollback($link = NULL) {
		$this->execute("ROLLBACK;", $link);
	}

}