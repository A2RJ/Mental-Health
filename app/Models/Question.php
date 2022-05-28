<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use Translatable;

    protected $table = "questions";
    protected $primaryKey = 'id';

    public $translatedAttributes = ['question', 'answer_options'];

    protected $fillable = ['score'];

    public $timestamps = true;
}
