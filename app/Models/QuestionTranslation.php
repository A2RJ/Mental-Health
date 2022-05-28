<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionTranslation extends Model
{
	protected $table = "question_translation";
	protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = ['question', 'answer_options'];

    protected $cast = [
        'answer_options' => 'array',
    ];
}
