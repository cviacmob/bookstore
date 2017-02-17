<?php
class ModelCatalogUploaded extends Model {

public function getTotalUploadedImage()
    {

        $query = $this->db->query("SELECT * FROM uploaded_image ");

        return $query;

    }

public function getUploadedImage($upload_id)
    {
        $query = $this->db->query("SELECT * FROM uploaded_image WHERE upload_id = '".$upload_id."'");

        if($query->rows){

            return array(

                'upload_id'     => $query->row['upload_id'],
                'customer_id'   => $query->row['customer_id'],
                'front_image'   => $query->row['front_image'],
                'back_image'    => $query->row['back_image'],
                'isbn' 			=> $query->row['isbn'],
				'title' 		=> $query->row['title'],
				'author' 		=> $query->row['author'],
				'publisher' 	=> $query->row['publisher'],
				'no_of_pages' 	=> $query->row['no_of_pages'],
				'cover_type' 	=> $query->row['cover_type'],
				'description' 	=> $query->row['description']

            );
        }else{
                return false;
        }
    }

 public function updateDetails($upload_id)
    {
        $query = $this->db->query("UPDATE uploaded_image SET isbn ='".$this->request->post['isbn']."', title='".$this->request->post['title']."' ,author='".$this->request->post['author']."' ,publisher='".$this->request->post['publisher']."' ,no_of_pages='".$this->request->post['no_of_pages']."' ,cover_type='".$this->request->post['cover_type']."', status = 'verified', description='".$this->request->post['description']."' WHERE upload_id = '".$upload_id."'");
    
        $status = $this->db->query("SELECT status FROM uploaded_image WHERE upload_id = '".$upload_id."'");

        return $status; 
    
    }   

}