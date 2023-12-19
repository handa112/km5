<?php namespace App\Models; // กำหนด namespace
use CodeIgniter\Model; // เรียกใช้งาน Model class
class NewsModel extends Model // สร้าง Model class โดยสืบทอดจาก Model
{
    protected $table = 'news'; // ใช้ข้อมูลตาราง news
    protected $primaryKey = 'id'; // กำหนด primary key
     
    protected $allowedFields = ['title', 'slug', 'body']; // กำหนดฟิลด์ที่อนุญาตแก้ไขได้
     
    public function getNews($slug = false)
    {
        if ($slug === false) 
        {
             return $this->findAll();
        }
        return $this->asArray()
                    ->where(['slug' => $slug])
                    ->first();
    }
     
}