<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    protected $fillable=[
        'location','type','body'
    ];
    public function users(){
        return $this->belongsTo(User::class);
    }
}
