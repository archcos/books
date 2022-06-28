<?php
 namespace App\Models;

 use Illuminate\Database\Eloquent\Model;

 class Book extends Model{
    protected $table = 'tblbooks';
    
 // columns of the table
    protected $fillable = [
     'bookname', 'yearpublish', 'authorid'
     ];

    public $timestamps = false;
    protected $primaryKey = 'id';

 }