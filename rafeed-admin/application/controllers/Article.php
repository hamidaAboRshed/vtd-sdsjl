<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Article extends CI_Controller {

//protected $personal_data=null;

	function __construct()
	{
        parent::__construct();
		 
		$this->load->database();
		$this->load->helper('url');
		/* ------------------ */ 
		$this->load->model('Article_model');
		$this->load->model('Global_model');
		$this->load->model('Employee_model');
		$this->load->model('Index_model');
		$this->load->model('User_model');
		$this->load->helper('form');
		$this->load->helper('text');
	}
 
	public function index()
	{
		
		if($this->user_validate->check_login())
		{
			$array = array();

			$array['grid_header'] = array('Title' ,'Abstract','Employee' ,'Created','Updated','Options');

			$array['read_action'] = '../Article/fetchMemberData/';
			$data['grid_body_data']= $array;
			$data['custom_modal_file'] = 'article_grid.php';
			$data['custom_modal_data'] = ''; 

			$data['output'] = '';
			$data['subview'] = 'grid_view.php';
			$data['pageTitle']='Article Table';
			$this->load->view('layouts/layout',$data);
		}

	}
  
	 public function fetchMemberData() 
	{
		$result = array('data' => array());

		$data = $this->Article_model->fetchArticleData();

		foreach ($data as $key => $value) {

			// button
			$buttons = '
			<div class="btn-group">
			  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			    Action <span class="caret"></span>
			  </button>
			  <ul class="dropdown-menu">
			  	<li ><a href="'.base_url().'../index.php/article/article_page/'.$value["Artic_id"].'" target="_blank" ><i class="fa fa-eye"></i> Preview </a></li>

			    <li><a type="button" href="edit_article/'.$value["Artic_id"].'"><i class="fa fa-edit"></i> Edit</a></li>

			    <li><a type="button" class="" onclick="DeleteArticle('.$value['Artic_id'].')" data-toggle="modal" data-target="#delete_articleModal"><i class="fa fa-trash"></i></i> Delete</a></li> ';

				 if($value["Status"]==0)
				 {
				   $buttons .= '<li><a type="button" onclick="publish('.$value['Artic_id'].')" ><i class="fa fa-globe" style="color:#1976d2"></i> Publish</a></li> ';
				  }
				  else
				  {
				  	$buttons .= ' <li><a type="button" onclick="unpublish('.$value['Artic_id'].')" ><i class="fa fa-globe"></i> UnPublish</a></li>';

				  }

		  	 $buttons .= '	</ul>
			</div>
			';
			$abstract=character_limiter($value['Abstract'],155);
      		$employee=$this->Employee_model->get_employee_by_id($value['CreatedBy']);
			$result['data'][$key] = array(
				$value['Title'],
				$abstract,
				$value['CreatedBy'],
				$value['CreatedDate'],
				$value['EditeDate'],
				$buttons
			);

		} // /foreach

		echo json_encode($result);
	}

	public function add_article() 
	{
		if($this->user_validate->check_login())
		{			
			$data['output'] = '';
			$data['subview'] = 'add_article.php';
			$data['pageTitle']='Add';
			$data['msg']='';
			$data['Keyword']=$this->Article_model->get_article_key();
			$data['Language']=$this->Index_model->get_index('language');
			$this->load->view('layouts/layout',$data);
		}
	}

	public function edit_article($id) 
	{
		$data['output'] = '';
		$data['subview'] = 'edit_article.php';
		$data['pageTitle']='Edit Article';
		$data['msg']='';
		$data['keyword'] = $this->Article_model->get_article_key($id);
		$data['details_article'] = $this->Article_model->get_detail_article($id);
		$data['paragraph'] = $this->Article_model->get_paragraph_article($id);
		foreach ($data['paragraph'] as $key => $value) {
			$data['paragraph'][$key]['sub_paragraph'] = $this->Article_model->get_sub_paragraph($value['ID']);
		}

		$this->load->view('layouts/layout',$data);
	}

	public function create_article() 
	{
		$data['output'] = '';
		$data['subview'] = 'addarticle.php';
		$data['pageTitle']='Article Table';

		//foreach loop to display the returned array
		if($this->session->userdata('Full_name'))
			$username=$this->session->userdata('Full_name');
		else 
			$username=$this->User_model->get_default_username();

			//add article info 
			$data_article = array(
				'CreatedBy'=>$username,
				'EditeDate'=>date("Y-m-d H:i:s"),
				'Status'=>'0',
			    'CreatedDate'=>date("Y-m-d H:i:s"),
	        );

		 	$article_id=$this->Global_model->insertDataReturnLastId('article',$data_article);
			$file2 = $this->upload_image('MainImage',$article_id,'MainImage');
			$file1 = $this->upload_image('SubImage',$article_id,'SubImage');

		 	$data_upload_img = array(
			    'Sub_Image'=>$file1,
			    'Main_Image'=>$file2
	        );
				
		 	$update_to_upload_img=$this->Global_model->updateData('article',$data_upload_img,$article_id);

				$data_article_lang = array(
				'Language_id'=>'1',
				'Article_id'=>$article_id,
		        'Title'=>$this->input->post('ArticleTitle'),
		        'Abstract'=>$this->input->post('ArticleAbsrtact')
	          );

		 	$last_id_article_language=$this->Global_model->insertDataReturnLastId('article_language',$data_article_lang);

		 	//add Keyword for article
		 	$Keyword_from_select2=$this->input->post('Keyword_from_select2');//get all value from select2
			$Key_value = explode(",",$Keyword_from_select2);//explode value from select2 

			foreach($Key_value as $Key_value)
			{ 

				$data_article_Keyword = array(
					'Language_id'=>'1',
					'Article_id'=>$article_id,
			        'Value'=>$Key_value
	            );

				$last_id_article_language=$this->Global_model->insertDataReturnLastId('article_keyword',$data_article_Keyword);

			} //end add keyword

		 	//add paragraph 
		 	$rowcount=$this->input->post('rowcount');
		 	for ($i=1; $i <=$rowcount ; $i++) 
		 	 { 
		 	 	$par_title=$this->input->post("titlePar_".$i);
				if($par_title!=""){
				 $file_par = $this->upload_image("ImagePar_".$i,$article_id,'paragraph_image'.$i);
	
					$par_img=$this->upload->data();
					$data = array(
					'Language_id'=>'1',
					'Article_id'=>$article_id,
			        'Title'=>$par_title,
			        'Body'=>$this->input->post("textPar_".$i),
			        'Photo'=>$file_par,
			        'Them'=>$this->input->post("themPar_".$i),
			        'Parent_id'=>'0',
			        'OrderNumber'=>$this->input->post("OrderNumber_".$i)
		          );
			 	$paragraph_id=$this->Global_model->insertDataReturnLastId('paragraph',$data);
		 		

		
		 	 if ($paragraph_id) {
		 	 	// add sub Paragraph
			 		$rowcount_sub=$this->input->post('rowcount_sub'.$i); 
				 	for ($sub=1; $sub <= $rowcount_sub ; $sub++)
				 	 { 

				 	 	$Subpar_title=$this->input->post("titleSubPar_".$i.$sub);
						$Subpar_text=$this->input->post("textSubPar_".$i.$sub);
						if($Subpar_title!="" && $Subpar_text!=""){
						$file_subpar = $this->upload_image('ImageSubPar_'.$i.$sub,$article_id,
							'image_par'.$sub.$paragraph_id);

						
								$par_img=$this->upload->data();
								$data = array(
								'Language_id'=>'1',
								'Article_id'=>$article_id,
						        'Title'=>$Subpar_title,
						        'Body'=>$Subpar_text,
						        'Photo'=>$file_subpar,
						        'Them'=>$this->input->post("themSubPar_".$i.$sub),
						        'parent_id'=>$paragraph_id,
						        'OrderNumber'=>$this->input->post("SubOrderNumber_".$i.$sub)
					          );
						 	$sub_paragraph=$this->Global_model->insertData('paragraph',$data);

						 }//end it title sub paragraph not empty
				 		
				 	 }//end add for loop sub paragraph 

				 } //end if title paragraph not empty 

		 	 }
			 
		 } //end add for loop  paragraph 

		redirect('Article/index');
			
	}

	//update article 
	public function update() 
	{
		$title=$this->input->post('ArticleTitle');
		$abstract=$this->input->post('ArticleAbsrtact');
		$article_id=$this->input->post('article_id');

		if ($_FILES['MainImage']['name']!='')
		{ 	
			$file2 = $this->upload_image('MainImage',$article_id,'MainImage');
		}
		elseif ($_FILES['MainImage']['name']=='' ) 
		{
			$file2=$this->input->post('old_Main_img');			
		}
		if ( $_FILES['SubImage']['name']=='') 
		{
			$file1=$this->input->post('old_sub_img');
			
		}
		elseif ( $_FILES['SubImage']['name']!='') 
		{
			$file1 = $this->upload_image('SubImage',$article_id,'SubImage');
		}
		//add article info 
		$data_article = array(
			'EditeDate'=>date("Y-m-d H:i:s"),
	        'Sub_Image'=>$file1,
	        'Main_Image'=>$file2
	    );
		$update_article=$this->Global_model->updateData('article',$data_article,$article_id);

		$data_article_language = array(
        'Title'=>$title,
        'Abstract'=>$abstract,
      	);

		$update_article_language=$this->Article_model->update_data_article_lang('article_language',$data_article_language,$article_id);

			//add Keyword for article
		$data['old_keyword'] = $this->Article_model->get_article_key($article_id);
		$old_value = array_column($data['old_keyword'], 'Value');
	 	$Keyword_from_select2=$this->input->post('Keyword_from_select2');//get all value from select2
	 	if($Keyword_from_select2!='')
	 	{

		 	$Key_value = explode(",",$Keyword_from_select2);//explode value from select2 

			foreach($Key_value as $Key_value)
			{ 
				if (in_array ( $Key_value ,$old_value ))
				{

				}
				else
				{
					$data_article_Keyword = array(
						'Language_id'=>'1',
						'Article_id'=>$article_id,
				        'Value'=>$Key_value
		            );

					$last_id_article_language=$this->Global_model->insertDataReturnLastId('article_keyword',$data_article_Keyword);

				}

			} //end add keyword

	 	}

		//edite paragraph 
		$edit_count_par_row=$this->input->post('edit_count_par_row');
		for ($i=0; $i <= $edit_count_par_row ; $i++) 
		    { 
				$edit_id_par=$this->input->post('edit_id_par'.$i);

				if ($_FILES['edit_new_ImagePar_'.$i]['name']!='' )
				{
				 	$file_par = $this->upload_image('edit_new_ImagePar_'.$i,$article_id,'ParImage'.$i);
				}
				else
				{
					$file_par =$this->input->post('edit_old_par_img'.$i);
				}
					
				$data = array(
					'Language_id'=>'1',
			        'Title'=>$this->input->post("edit_titlePar_".$i),
			        'Body'=>$this->input->post("edit_textPar_".$i),
			        'Photo'=>$file_par,
			        'Article_id'=>$article_id,
			        'Them'=>$this->input->post("edit_OrderNumber_".$i),
			        'Parent_id'=>'0',
			        'OrderNumber'=>$this->input->post("edit_OrderNumber_".$i)
		        );

			 	$paragraph_id=$this->Global_model->updateData('paragraph',$data,$edit_id_par);
			 	// edit sub Paragraph
		 		$edit_count_sub_row=$this->input->post('edit_count_sub_row'.$i);

			 	for ($edit_sub=0; $edit_sub < $edit_count_sub_row ; $edit_sub++) 
			 	{ 
			 	 	$edit_id_sub_par=$this->input->post('edit_id_sub_par'.$i.$edit_sub);
					$file_sub_par = $this->upload_image('edit_new_ImageSubPar_'.$i.$edit_sub,$article_id,'ParImage'.$edit_sub);

					if ($_FILES['edit_new_ImageSubPar_'.$i.$edit_sub]['name']!='' )
					{
					 $file_par = $this->upload_image('edit_new_ImageSubPar_'.$i.$edit_sub,$article_id,'SubParImage'.$i);
					}
					
					else
					{
						$file_par =$this->input->post('edit_old_subpar_img'.$i.$edit_sub);

					}
					$par_img=$this->upload->data();
					$data = array(
						'Language_id'=>'1',
						'Article_id'=>$article_id,
				        'Title'=>$this->input->post("edit_titleSubPar_".$i.$edit_sub),
				        'Body'=>$this->input->post("edit_textSubPar_".$i.$edit_sub),
				        'Photo'=>$file_par,
				        'Them'=>$this->input->post("edit_themsubPar_".$i.$edit_sub),
				        'Parent_id'=>$edit_id_par,
				        'OrderNumber'=>$this->input->post("SubOrderNumber_".$i.$edit_sub)
			         );
					$sub_paragraph=$this->Global_model->updateData('paragraph',$data,$edit_id_sub_par);
					
			 		
			 	} //end edit of subparagraph


		    } //end edit  for paragraph 

		    // add new paragraph and sub paragraph 
		 	//add paragraph 
		 	$rowcount=$this->input->post('rowcount');
		 	for ($i=1; $i <=$rowcount ; $i++) 
		 	{ 
		 	 	$par_title=$this->input->post("titlePar_".$i);
				if($par_title!="")
				{
					$file_par = $this->upload_image("ImagePar_".$i,$id_atr,'paragraph_image'.$i);
	
					$par_img=$this->upload->data();
					$data = array(
						'Language_id'=>'1',
						'Article_id'=>$id_atr,
				        'Title'=>$par_title,
				        'Body'=>$this->input->post("textPar_".$i),
				        'Photo'=>$file_par,
				        'Them'=>$this->input->post("themPar_".$i),
				        'Parent_id'=>'0',
				        'OrderNumber'=>$this->input->post("OrderNumber_".$i)
		          	);
			 		$paragraph_id=$this->Global_model->insertDataReturnLastId('paragraph',$data);
		 				
		 			if ($paragraph_id)
		 			{
			 	 		// add sub Paragraph
				 		$rowcount_sub=$this->input->post('rowcount_sub'.$i); 
					 	for ($sub=1; $sub <= $rowcount_sub ; $sub++)
					 	{ 

					 	 	$Subpar_title=$this->input->post("titleSubPar_".$i.$sub);
							$Subpar_text=$this->input->post("textSubPar_".$i.$sub);
							if($Subpar_title!="" && $Subpar_text!="")
							{
								$file_subpar = $this->upload_image('ImageSubPar_'.$i.$sub,$id_atr,
									'image_par'.$sub.$paragraph_id);
								$par_img=$this->upload->data();
								$data = array(
									'Language_id'=>'1',
									'Article_id'=>$id_atr,
							        'Title'=>$Subpar_title,
							        'Body'=>$Subpar_text,
							        'Photo'=>$file_subpar,
							        'Them'=>$this->input->post("themSubPar_".$i.$sub),
							        'parent_id'=>$paragraph_id,
							        'OrderNumber'=>$this->input->post("SubOrderNumber_".$i.$sub)
							    );
								$sub_paragraph=$this->Global_model->insertData('paragraph',$data);

							}//end it title sub paragraph not empty
					 		
					 	}//end add for loop sub paragraph 

				 	} //end if 

		 	 	} //end if title paragraph not empty 
			 
		 	} //end add for loop  paragraph 

		redirect('Article/');
		
	}




	function upload_image($filename,$article_id,$new_name)
	{
		$name='';
		$name=$new_name;
	
		if (!is_dir("./../rafeed-includes/upload_files/Blog/".$article_id)) { 
		$folder=mkdir("./../rafeed-includes/upload_files/Blog/".$article_id);
		}
		$folder="./../rafeed-includes/upload_files/Blog/".$article_id;
		$config['upload_path'] = $folder;
		$config['allowed_types'] = 'jpg|jpeg|png|gif|';
		/*$config['max_size'] = '100';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';*/
		$config['file_name'] = $name;

		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload($filename)) {
		    $error = array('error' => $this->upload->display_errors());
			
			//print_r($error)  ;
			return false ;

		// $this->load->view('upload_form', $error);
		} else {
			$imageData = $this->upload->data();
            $file = $imageData['file_name'];
			//print_r($file)  ;
			return $file ;
        
		//$this->load->view('upload_success', $data);
		}
	}


	function delete_article($id)
	{
		 
		$rsponse= $this->Article_model->delete_article($id);
		 if($rsponse === true) 
		 {
			$validator['success'] = true;
			$validator['messages'] = "Successfully removed";
		}
		else 
		{
			$validator['success'] = true;
			$validator['messages'] = "Error when remove Article .";
		}
		echo json_encode($validator);
	}


	function publish_article($id)
	{

		$data = array(
			'Status'=>'1',
			
          );
	 
		$rsponse= $this->Global_model->updateData('article',$data,$id);
		 if($rsponse === true) {
				$validator['success'] = true;
				$validator['messages'] = "Successfully publish";
			}
			else {
				$validator['success'] = true;
				$validator['messages'] = "Error when publish article .";
			}

			echo json_encode($validator);

	}

	function unpublish_article($id)
	{

		$data = array(
			'Status'=>'0',
			
          );
	 
		$rsponse= $this->Global_model->updateData('article',$data,$id);
		 if($rsponse === true) {
				$validator['success'] = true;
				$validator['messages'] = "Successfully unpublish";
			}
			else {
				$validator['success'] = true;
				$validator['messages'] = "Error when unpublish article .";
			}

			echo json_encode($validator);
	}

	function delete_paragraph($id)
	{
		$rsponse= $this->Global_model->deleteData('paragraph',$id);
		 if($rsponse === true) {
				$validator['success'] = true;
				$validator['messages'] = "Successfully unpublish";
			}
			else {
				$validator['success'] = true;
				$validator['messages'] = "Error when unpublish article .";
			}

			echo json_encode($validator);
	}
 

}
 

