<?php
namespace App\Repository;

use phpDocumentor\Reflection\DocBlock\Tag;

class TagRepository
{
    protected $tag;
    public function __construct(Tag $tag) {
        $this->tag = $tag;
    }
}
