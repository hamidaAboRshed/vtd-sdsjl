<?php

class Article_model extends CI_Model {



	public  function get_data_article($article_id=null)
	{
		if($article_id)
		{
			$q = $this->db->select('* , article.ID as Artic_id');
			$q = $this->db->from('article');
			$q = $this->db->join('article_language','article.ID=article_language.Article_id');
			$q = $this->db->where('article.ID',$article_id);
			$q = $this->db->get();
			return $q->result();
		}
		else
		{
			$q = $this->db->select('* , article.ID as Artic_id');
			$q = $this->db->from('article');
			$q = $this->db->join('article_language','article.ID=article_language.Article_id');
			$q = $this->db->where('Status','1');
			$q = $this->db->order_by('CreatedDate','desc');
			$q = $this->db->get();
			return $q->result();
		}

	}


	public  function get_paragraph_article($id)
	{
		$q = $this->db->select('* , article.ID as Artic_id');
		$q = $this->db->from('article');
		$q = $this->db->join('paragraph','paragraph.Article_id=article.ID');
		$q = $this->db->where('paragraph.Article_id',$id);
		$q = $this->db->order_by('paragraph.OrderNumber','asc');
		$q = $this->db->get();
		return $q->result_array();
	}

	public  function get_sub_paragraph($id)
	{
		$q = $this->db->select('*');
		$q = $this->db->from('paragraph');
		$q = $this->db->where('parent_id',$id);
		$q = $this->db->order_by('paragraph.OrderNumber','asc');
		$q = $this->db->get();
		return $q->result_array();
	}

	public  function get_article_key($id)
	{
		$q = $this->db->select('*');
		$q = $this->db->from('article_keyword');
		$q = $this->db->where('Article_id',$id);
		$q = $this->db->get();
		return $q->result_array();
	}
}