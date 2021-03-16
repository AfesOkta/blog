<?php
namespace App\Repository;

use App\Models\Tags;

class TagRepository
{
    protected $tag;
    public function __construct(Tags $tag) {
        $this->tag = $tag;
    }

    public function findById($id)
    {
        return $this->tag->findOrFail($id);
    }
    public function findByName($name)
    {
        return $this->tag->where('name',$name)->first();
    }

    public function getBySlugs($slug)
    {
        return $this->tag->where('slug',$slug)->get();
    }

    public function findAll()
    {
        return $this->tag->all();
    }

    public function save($data)
    {
        return $this->tag->create($data);
    }

    public function update($data, $id)
    {
        return $this->tag->find($id)->update($data);
    }

    public function delete($id)
    {
        return $this->tag->find($id)->delete();
    }
}
