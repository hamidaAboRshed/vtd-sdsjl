<?php

class Article_model extends CI_Model {

	function fetchArticleData($id = null) 
	{
		if($id)
		{
			$sql = "SELECT * ,article.ID as Artic_id FROM article join article_language on article_language.Article_id=article.ID WHERE ID = ?  ";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * ,article.ID as Artic_id FROM article join article_language on 	article_language.Article_id=article.ID order by article.ID desc";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public  function get_data($table)
	{
		// here we select every column of the table
		$q = $this->db->get($table);
		return $q->result();
	}

	public  function get_detail_article($id)
	{
		// here we select every column of the table
		$q = $this->db->select('* , article.ID as Article_id' );
		$q = $this->db->from('article');
		$q = $this->db->join('article_language','article.ID=article_language.Article_id');
		$q = $this->db->where('article.ID',$id);
		$q = $this->db->get();
		return $q->result();
	}

	public  function get_paragraph_article($id)
	{
		// here we select every column of the table
		$q = $this->db->select('*');
		$q = $this->db->from('article');
		$q = $this->db->join('paragraph','paragraph.Article_id=article.ID');
		$q = $this->db->where('paragraph.Article_id',$id);
		$q = $this->db->get();
		return $q->result_array();
	}

	public  function get_sub_paragraph($id)
	{
		// here we select every column of the table
		$q = $this->db->select('*');
		$q = $this->db->from('paragraph');
		$q = $this->db->where('parent_id',$id);
		$q = $this->db->get();
		return $q->result_array();
	}

	public  function get_article_key($article_id = null)
	{
		if ($article_id)
		{
			$q = $this->db->select('*');
			$q = $this->db->from('article_keyword');
			$q = $this->db->where('Article_id',$article_id);
			$q = $this->db->get();
			return $q->result_array();
		}
		else
		{
			$q = $this->db->distinct();
			$q = $this->db->select('Value');
			$q = $this->db->from('article_keyword');
			$q = $this->db->get();
			return $q->result_array();
		}

	}


	function update_data_article_lang($table,$data,$id) {
	
		$this->db->where('Article_id', $id);
		$this->db->update($table, $data);
	
	}

	function delete_article($id)
	{

        $article_language_Query=$this->db->where('id', $id);
        $article_language_Query=$this->db->delete('article_language'); 

 		$article_query=$this->db->where('id', $id);
  		$article_query=$this->db->delete('article');

	    $par_query= $this->db->where('article_id', $id);
	    $par_query=$this->db->delete('paragraph');
	    return $par_query;
	   
	}

}