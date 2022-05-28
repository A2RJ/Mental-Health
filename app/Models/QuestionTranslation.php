<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * https://levelup.gitconnected.com/a-tutorial-on-how-to-store-arrays-to-sql-databases-using-json-and-casts-in-laravel-9b97e28af05a
 * https://laravel-news.com/how-to-add-multilingual-support-to-eloquent
 * https://docs.astrotomic.info/laravel-translatable/
 */
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
