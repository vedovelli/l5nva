<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model {

    protected $fillable = ['name', 'description', 'user_id'];

    public function members()
    {
        return $this->belongsToMany('App\User');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }

    public function owner()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function sections()
    {
        return $this->hasMany('App\Section', 'project_id');
    }

}