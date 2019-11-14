<?php
namespace App\Category\Service;
use App\Entity\Category;

interface CategoryPresentationInterface
{
    public function findBySlug(string $slug): Category;
}
