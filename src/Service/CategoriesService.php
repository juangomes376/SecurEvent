<?php

namespace App\Service;

use App\Entity\Categories;
use App\Repository\CategoriesRepository;


class CategoriesService
{
    private CategoriesRepository $categoriesRepository;

    public function __construct(CategoriesRepository $categoriesRepository)
    {
        $this->categoriesRepository = $categoriesRepository;
    }

    public function getAllCategories()
    {
        return $this->categoriesRepository->findAll();
    }
}