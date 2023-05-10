<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    const ROLE_ADMINISTRATOR = 1;
    const ROLE_MANAGER = 2;
    const ROLE_EDITOR = 3;
    const ROLE_CUSTOMER = 4;

    //
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'roles';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The users that belong to the role.
     */
    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public static function findByName($name)
    {
        $role = static::where('name', $name)->first();

        if (! $role) {
            throw new RoleDoesNotExist1();
        }

        return $role;
    }

    public static function findById($id)
    {
        $role = static::where('id', $id)->first();

        if (!$role) {
            throw new RoleDoesNotExist();
        }

        return $role;
    }
}
