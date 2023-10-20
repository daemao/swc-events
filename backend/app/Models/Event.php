<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Event extends Model
{
    use HasFactory;
    protected $fillable=[
        'author_id',
        'body',
        'name',
        'date'
    ];
    public function users(){
        return $this->belongsToMany(User::class);
    }
    public function author(){
        return $this->belongsTo(User::class);
    }
    public function getAuthorNameAttribute(){
        return $this->author->name;
    }
    public function getUserPermissionsAttribute(){
        $user = request()->user();
        $isSubscribed = !!$this->users->where('id',$user->id)->first();
        return [
            'can_subscribe'=>!$isSubscribed,
            'can_unsubscribe'=>$isSubscribed,
            'can_delete'=>$this->author_id ===$user->id || $user->can('can_delete_events'),
            'can_update'=>$this->author_id ===$user->id || $user->can('can_update_events'),
            "can_view_participants"=>$this->author_id === $user->id || $user->can('can_read_users')
        ];
    }
}
