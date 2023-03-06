<?php

namespace App\Http\Repository;

use App\Models\User;
use Illuminate\Http\Request;

class UserRepository
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function all()
    {
        return $this->user::isNotAdmin()->orderBy('id', 'desc')->get();
    }

    public function find($id)
    {
        return $this->user->find($id);
    }

    public function store($request)
    {
        $user = new $this->user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->level = 2;
        $user->foto = '/img/user.jpg';
        $user->save();
    }

    public function update($request, $id)
    {

        $user = $this->user::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->has('password') && $request->password != "") {
            $user->password = bcrypt($request->password);
        }
        $user->update();

        return $user;
    }

    public function delete($id)
    {
        $user = $this->user->find($id);
        $user->delete();
    }
}