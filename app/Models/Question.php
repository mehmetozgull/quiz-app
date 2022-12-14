<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = ['question', 'image', 'answer1', 'answer2', 'answer3', 'answer4', 'correct_answer'];

    protected $appends = ['true_percent'];

    public function my_answer(){
        return $this->hasOne('App\Models\Answer')->where('user_id', auth()->user()->id);
    }

    public function getTruePercentAttribute(){
        $answerCount = $this->answers()->count();
        $correctCount = $this->answers()->where('answer', $this->correct_answer)->count();
        return round((100/$answerCount) * $correctCount);
    }

    public function answers(){
        return $this->hasMany('App\Models\Answer');;
    }


}
