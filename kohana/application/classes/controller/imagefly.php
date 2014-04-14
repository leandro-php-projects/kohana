<?php defined('SYSPATH') or die('No direct script access.');
/**
 * @package   Modules
 * @category  Imagefly
 * @author    Fady Khalife
 * @uses      Image Module
 * 
 * Concept based on the smart-lencioni-image-resizer by Joe Lencioni
 * http://code.google.com/p/smart-lencioni-image-resizer/
 */
   
class Controller_Imagefly extends Controller
{
    public function action_index()
    {    	
         $this->auto_render = FALSE;		 	
 		 $params   = Request::current()->param('params');
         $filepath = Request::current()->param('imagepath');
		 
		 $data = explode('/',$filepath);
		 $file = explode('.',$data[1]);	
		 
		 if(!file_exists(DOCROOT.$data[0]))
		 {
		 	mkdir(DOCROOT.$data[0]);
		 }	
		 
		 $id_image = $file[0];
		 $this->filename = DOCROOT.$data[0]."/".$id_image.".".$file[1];
		 
		 if(!file_exists($this->filename))
		 {
			$this->action_save_image($id_image);
		 }
		
         new ImageFly();
    }
	
			
	public function action_save_image($id_image)
	{		
		$this->auto_render = FALSE;
		$sql   = sprintf("SELECT * FROM   media	WHERE `m_id` = '%s' ",$id_image);
		$query = DB::query(Database::SELECT, $sql);
		
		$result = $query->execute();
		if (count($result))
		{
			$image = $result[0]['m_img'];
		}	
		
		if(isset($image) && strlen($image)>10)
		{
			$image_content= $image;
		}
		else
		{			
			die('Imagem não encontrada');
		}				
		
    	$handle = fopen($this->filename, 'w+');
    	if (!fwrite($handle, $image_content ))
    	{
        	print "Erro escrevendo no arquivo ($handle)";
        	exit;
    	}
	    fclose($handle);
	}
		
}