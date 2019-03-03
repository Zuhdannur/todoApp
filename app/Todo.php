<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model {

    public $table = "t_todo";

    protected $fillable = ['title','desscription','start','end'];

    protected $dates = ['start','end'];

    public $timestamps = false;

    public $rules = [
            'title' => 'required',
            'desscription' => 'required'
    ];

    // Relationships

}
