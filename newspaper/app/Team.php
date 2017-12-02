<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Team extends Model
{

    protected $fillable = ['name', 'size'];

    public function addMember($user)
    {
        
        $this->guardAgainstTooManyMembers();

        $this->members()->save($user);
    }

    public function members()
    {
        return $this->hasMany(User::class);
    }

    public function count()
    {
        return $this->members()->count();
    }

    public function discharge($user)
    {
        $user->team()->dissociate()->save();
    }

    public function dismissAllMembers()
    {
        $this->members()->get()->each( function($user) {
            $this->discharge($user);
        });
    }

    protected function guardAgainstTooManyMembers()
    {
        if($this->count() >= $this->size) {
            throw new \Exception;
        }
    }

}
