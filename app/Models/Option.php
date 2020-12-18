<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;
        protected string $option_body;

        protected $fillable = [
                "option_body"
        ];


        public function question() {
                return $this->belongsTo(\App\Models\Question::class);
        } 
        
}
