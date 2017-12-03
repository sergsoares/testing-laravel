<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Team extends Model
{

    protected $fillable = ['name', 'size'];

    public function addMember($user)
    {
        
        $this->guardAgainstTooManyMembers($user);

        $method = $user instanceof User ? 'save' : 'saveMany';
        
        $this->members()->$method($user);
    }

    public function members()
    {
        return $this->hasMany(User::class);
    }

    public function count()
    {
        return $this->members()->count();
    }

    public function maximumSize()
    {
        return $this->size;
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

    protected function guardAgainstTooManyMembers($users)
    {
        $userQuantity = $this->count() + count($users);

        if($userQuantity > $this->maximumSize()) {
            throw new \Exception;
        }
    }

}
