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

    protected $fillable = ['category_id'];

    public $timestamps = false;

    public static function getQuestions($locale = 'en', $id = null)
    {
        app()->setLocale($locale);
        $id ? $questions = self::where('category_id', $id)->get() : $questions = self::all();

        return $questions->map(function ($question) {
            return [
                'id' => $question->id,
                'category_id' => $question->category_id,
                'question' => $question->question,
                'answer_options' => json_decode($question->answer_options),
            ];
        });
    }
}
