<?php namespace App\Controllers;
 
use App\Models\NewsModel; // เรียกใช้งาน NewsModel class
use CodeIgniter\Controller;
 
class News extends Controller
{
    // default method สำหรับแสดง ข่าวทั้้งหมด
    public function index()
    {
        // สร้าง instance model จาก model object เพื่อใช้งาน
        $model = new NewsModel();
 
        // ตัวแปรที่ส่งเข้าไปใน views
        $data = [
            'news'  => $model->getNews(), // ตัวแปร $news จะเป็นข่าวทั้งหมด ที่จะสุ่งเข้าไปใน views 
            'title' => 'News archive',
        ];
 
        // ส่วนของการแสดงผล และส่งค่าไปยัง views
        echo view('templates/top', $data);
        echo view('templates/header', $data);
        echo view('templates/heroCarousel', $data);
        echo view('news/overview', $data);
        echo view('templates/footer', $data);
        echo view('templates/bottom', $data);
    }
 
    // method สำหรับแสดงข้อมูลข่าว เฉพาะรายการ
    public function view($slug = NULL)
    {
        // สร้าง instance model จาก model object เพื่อใช้งาน
        $model = new NewsModel();
 
        // กำหนดตัวแปร $news ที่จะส่งเข้าไปใน views ผ่านตัวแปร $data
        // ให้ทำการดึงข้อมูล ที่มีรวยการที่ค่า slug ตรงกับที่ส่งเข้าไป
        $data['news'] = $model->getNews($slug);
 
        if (empty($data['news'])) // ถ้าไม่ตรง หรือไม่มีในฐานข้อมูล
        {
            // ถ้าเข้าเงื่อนไขนี้แล้ว คำสั่งแสดงผลด้านล่างจะไม่ทำงาน
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Cannot find the news item: '. $slug);
        }
         
        // ถ้ามีข้อมูลกำหนดตัวแปร $title ส่งเข้าไปใน views ผ่านตัวแปร $data
        $data['title'] = $data['news']['title'];
 
        // ส่วนของการแสดงผล และส่งค่าไปยัง views
        echo view('templates/top', $data);
        echo view('templates/header', $data);
        echo view('templates/heroCarousel', $data);
        echo view('news/view', $data);
        echo view('templates/footer', $data);
        echo view('templates/bottom', $data);
    }

     // create method สำหรับเพิ่มข้อมูลใหม่
     public function create()
     {
         $model = new NewsModel();
                  
         if ($this->request->getMethod() === 'post' && $this->validate([
                 'title' => 'required|min_length[3]|max_length[255]',
                 'body'  => 'required'
             ]))
         {
             // กรณีไม่ได้กำหนดค่า id ซึ่งเป็น primary key คำสั่ง save() จะเป็นการเพิ่มข้อมูลใหม่
             $model->save([
                 'title' => $this->request->getPost('title'),
                 'slug'  => url_title($this->request->getPost('title'), '-', TRUE),
                 'body'  => $this->request->getPost('body'),
             ]);
            
             $data['info_msg'] = 'News item created successfully.';
             echo view('templates/top', ['title' => 'Information']);
             echo view('news/success',$data);
             echo view('templates/bottom');
         }
         else
         {
             echo view('templates/top', ['title' => 'Create a news item']);
             echo view('news/create');
             echo view('templates/bottom');
         }
     }
      
     // edit method สำหรับแก้ไขข้อมูล
     public function edit($id)
     {
         $model = new NewsModel();
          
         if(!empty($id)){
             $data = [
                 'news'  => $model->find($id), // ดึงข้อมูลจาก id ที่เป็น primary key
                 'title' => 'Edit News',
             ];      
         }
          
         if ($this->request->getMethod() === 'post' && $this->validate([
                 'title' => 'required|min_length[3]|max_length[255]',
                 'body'  => 'required'
             ]))
         {
             // กรณีกำหนดค่า id ซึ่งเป็น primary key คำสั่ง save() จะเป็นการอัพเดทข้อมูล
             $model->save([
                 'id' => $id,
                 'title' => $this->request->getPost('title'),
                 'slug'  => url_title($this->request->getPost('title'), '-', TRUE),
                 'body'  => $this->request->getPost('body'),
             ]);
              
             $data['info_msg'] = 'News item updated successfully.';
             echo view('templates/top', ['title' => 'Information']);
             echo view('news/success',$data);
             echo view('templates/bottom');
  
         }
         else
         {
             echo view('templates/top', $data);
             echo view('news/edit',$data);
             echo view('templates/bottom');
         }
     }   
      
     // delete method สำหรับลบข้อมูล
     public function delete($id){
         $model = new NewsModel();
          
         if(!empty($id)){
             $model->delete($id); // ลบข้อมูลจากค่า id ที่เป็น primary key
         }   
         return redirect()->to('/news');      
     }
      
 
}