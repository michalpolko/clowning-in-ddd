<?php

namespace App\BlogAdmin\Domain\Author\Model;

final class Author
{
    private AuthorId $id;
    private AuthorName $name;

    private function __construct(
        AuthorId $id,
        AuthorName $name,
    ) {
        $this->id = $id;
        $this->name = $name;
    }

    public function getId(): AuthorId
    {
        return $this->id;
    }

    public function getName(): AuthorName
    {
        return $this->name;
    }
}
