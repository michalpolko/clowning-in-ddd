<?php

namespace App\BlogAdmin\Domain\Blog\Model\Entity;

use App\BlogAdmin\Domain\Blog\Model\ValueObject\CategoryId;
use App\BlogAdmin\Domain\Blog\Model\ValueObject\CategoryName;

final class Category
{
    private CategoryId $id;
    private CategoryName $name;
    private ?Category $parent;

    private function __construct(
        CategoryId $id,
        CategoryName $name,
        ?Category $parent,
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->parent = $parent;
    }

    public static function createMainCategory(
        CategoryId $id,
        CategoryName $name,
    ): self {
        $category = new self($id, $name, parent: null);

        return $category;
    }

    public static function createSubcategory(
        CategoryId $id,
        CategoryName $name,
        Category $parent,
    ): self {
        $subcategory = new self($id, $name, $parent);

        return $subcategory;
    }

    public function getId(): CategoryId
    {
        return $this->id;
    }
}
