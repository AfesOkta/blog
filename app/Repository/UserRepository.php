<?php

namespace App\Repository;

use App\Models\User;

class UserRepository
{
    protected $user;

    public function __construct(User $user) {
        $this->user = $user;
    }

    public function findById($id)
    {
        return $this->user->findOrFail($id);
    }

    public function findByName($name)
    {
        return $this->user->where('name',$name)->first();
    }

    public function findByEmail($email)
    {
        return $this->user->where('email',$email)->first();
    }

    public function findAll()
    {
        return $this->user->all();
    }

    public function save($data)
    {
        return $this->user->create($data);
    }

    public function update($data, $id)
    {
        return $this->user->find($id)->update($data);
    }

    public function delete($id)
    {
        return $this->user->find($id)->delete();
    }
}
