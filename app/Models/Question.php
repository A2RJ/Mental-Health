<?php

namespace App\Models;

use App\Http\Controllers\Controller;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use Translatable;

    protected $table = "questions";
    protected $primaryKey = 'id';

    public $translatedAttributes = ['code', 'question', 'answer_options'];

    protected $fillable = ['category_id'];

    public $timestamps = false;

    public static function getQuestions($locale = 'en', $id = null)
    {
        app()->setLocale($locale);
        $id ? $questions = self::where('category_id', $id)->get() : $questions = self::all();

        return $questions->map(function ($question) {
            return [
                'id' => $question->id,
                // 'code' => $question->category_id,
                'locale' => $question->code,
                'question' => $question->question,
                'answer_options' => json_decode($question->answer_options),
            ];
        });
    }

    public function category()
    {
        return $this->belongsTo(QuestionCategory::class, 'category_id');
    }

    public function getAnswerOptions()
    {
        return $this->answer_options ? json_decode($this->answer_options) : [];
    }

    public function getLocale()
    {
        return $this->code;
    }
}
