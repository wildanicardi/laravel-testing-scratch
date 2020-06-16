<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $guarded = [];

    public function add($user)
    {
        $this->guardAgaintsToManyMembers();
        $method = $user instanceof User ? 'save' : 'saveMany';

        return $this->members()->$method($user);
    }
    public function members()
    {
        return $this->hasMany(User::class);
    }
    public function guardAgaintsToManyMembers()
    {
        if ($this->count() >= $this->size) {
            throw new \Exception;
        }
    }
    public function count()
    {
        return $this->members()->count();
    }
    public function remove($user = null)
    {
        if ($user instanceof User) {
            return $user->leaveTeam();
        }
        return $this->removeMany($user);
    }
    public function removeMany($user)
    {
        return $this->members()
            ->whereIn('id', $user->pluck('id'))
            ->update(['team_id' => null]);
    }
    public function restart()
    {

        return $this->members()->update(['team_id' => null]);
    }
}
