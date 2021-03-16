<?php
namespace App\Repository;

use App\Models\Category;

class CategoryRepository
{
    protected $category;
    public function __construct(Category $category) {
        $this->category = $category;
    }

    public function findById($id)
    {
        return $this->category->findOrFail($id);
    }
    public function findByName($name)
    {
        return $this->category->where('name',$name)->first();
    }

    public function getBySlugs($slug)
    {
        return $this->category->where('slug',$slug)->get();
    }

    public function findAll()
    {
        return $this->category->all();
    }

    public function save($data)
    {
        return $this->category->create($data);
    }

    public function update($data, $id)
    {
        return $this->category->find($id)->update($data);
    }

    public function delete($id)
    {
        return $this->category->find($id)->delete();
    }
}
