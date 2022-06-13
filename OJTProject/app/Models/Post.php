<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Post extends Model
{
    use HasFactory;
    use softDeletes;
    protected $table = 'posts';
    protected $fillable = [
        'title',
        'description',
        'status',
        'created_user_id',
        'updated_user_id',
        'deleted_user_id'
    ];

    /**
     * the attribute that should be mutated dates
     * @var array
     */
    protected $date = ['deleted_at'];

    public function user(){
        return $this->belongsTo(User::class , 'created_user_id');
    }
}
