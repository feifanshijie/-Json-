<?php
/**
 * Created by PhpStorm.
 * User: ming
 * Date: 2017/8/24
 * Time: 下午3:19
 */
namespace App\Model;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'book';

    public $timestamps = false;
}

