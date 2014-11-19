<?php

/**
 * JPrass Blog
 * 
 * @copyright  Copyright (c) 2013 www.jprass.com
 * @filename	Blog.class.php
 * @author		jprass.com
 * @mail		i@jprass.com
 * @QQ			97142822
 * @version    1.0
 */
class BlogCtrl extends BaseCtrl {

	//当前主题
	protected $theme = "";
	//文章列表页面文章数量
	protected $pageSize = 12;

	public function __before() {
		//读取博客主题样式
		$this->theme = JPrassApi::C("theme");

		//读取博客所有文章记录数
		$this->assign("article_count", $this->db("##_article")->count());
		//读取博客所有评论数
		$this->assign("comment_count", $this->db("##_comment")->count());
		//读取博客所有分类数
		$this->assign("category_count", $this->db("##_category")->count());

		//设置博客的根URL
		$this->assign("blog_url", JPrassApi::C("blog.url"));
		//主题路径
		$this->assign("theme_url", JPrassApi::C("blog.url")."/".JPrassApi::C("smarty.template_dir")."/".$this->theme);
		//设置页面默认关键词
		$this->assign("keywords", JPrassApi::C("blog.keywords"));
		//设置页面默认描述
		$this->assign("description", JPrassApi::C("blog.description")); 
	}

	/**
	 * 获取文章的分页列表
	 * @param String $where 查询条件
	 * @param String $p 当前页码
	 */
	protected function listArticle($where, $p) {

		$field = "t.id,t.title,t.views,t.dateline,a.comments,t.description";
		$join = "(select count(1) comments,aid from ##_comment where `ischeck`=1 group by aid) a on a.aid = t.id";
		if(!empty($where))
			$where .=" and";
		$where.=" t.status = 1 and t.type='post'";
		$pager = $this->db("##_article")->field($field)->where($where)->order("dateline desc")->join($join)->findPage($p, $this->pageSize);

		$this->assign("list", $pager['records']);

		return $pager;
	}
	
	//对分页数据进行组织分页
	protected function buildPager($data, $module, $id) {

		$string = "<div class='div-pager'>";

		if ($data['current'] <= 1) {
			$string.="<span>首页</span>";
			$string.="<span>上一页</span>";
		} else {
			$string.="<a href='" . BlogRouter::buildUrl($module, $id) . "'>首页</a>";
			
			if ($data['prev'] == 1) {
				$string.="<a href='" . BlogRouter::buildUrl($module, $id) . "'>上一页</a> ";
			}
			else
				$string.="<a href='" . BlogRouter::buildUrl($module, $id . "/" . $data['prev']) . "'>上一页</a> ";
		}
		if (count($data['numbers'])) {
			foreach ($data['numbers'] as $_v) {
				if ($data['current'] == $_v) {
					$string.="<span class='current_page'>$_v</span>";
				} else {
					if ($_v > 1)
						$string.="<a class='pnum' href='" . BlogRouter::buildUrl($module, $id . "/" . $_v) . "'>$_v</a>";
					else
						$string.="<a class='pnum' href='" . BlogRouter::buildUrl($module, $id) . "'>$_v</a>";
				}
			}
		}
		if ($data['current'] >= $data['total']) {
			$string.="<span>下一页</span>";
			$string.="<span>末页</span>";
		} else {
			$string.="<a href='" . BlogRouter::buildUrl($module, $id . "/" . $data['next']) . "'>下一页</a>";
			$string.="<a href='" . BlogRouter::buildUrl($module, $id . "/" . $data['last']) . "'>末页</a> ";
		}
		$string.="<cite>共{$data['total']}页{$data['count']}条记录</cite>";
		$string.="</div>";
		return $string;
	}

}

?>
