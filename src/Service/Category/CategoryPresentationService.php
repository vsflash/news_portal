<?php
namespace App\Servic\Category;

use App\Category\Service\CategoryPresentationInterface;
use App\Entity\Category;
use App\Exception\EntityNotFoundException;
use App\Repository\CategoryRepository;

final class CategoryPresentationService implements CategoryPresentationInterface
{
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function findBySlug(string $slug): Category
    {
        $category = $this->categoryRepository->findBySlug($slug);
        if (null === $category) {
            throw new EntityNotFoundException(\sprintf('Category with slug "%s" not found', $slug));
        }
        return $category;
    }
}
