<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model {

    protected $fillable = ['name', 'description', 'user_id'];

    public function members()
    {
    return $this->belongsToMany('User');
    }

    public function categories()
    {
    return $this->belongsToMany('Category');
    }

    public function owner()
    {
    return $this->belongsTo('User', 'user_id');
    }

    public function sections()
    {
    return $this->hasMany('Section', 'project_id');
    }

}