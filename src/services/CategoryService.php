<?php

namespace src\Services;

use Exception;
use src\exceptions\categories\CategoryCreateFailedException;
use src\exceptions\categories\CategoryDeleteFailedException;
use src\exceptions\categories\CategoryGetAllFailedException;
use src\exceptions\categories\CategoryGetByUuidException;
use src\exceptions\categories\CategoryUpdateFailedException;
use src\Repositories\CategoryRepository;
use stdClass;

class CategoryService
{
    public function __construct(private CategoryRepository $categoryRepository) {}

    /**
     * Create a new category
     *
     * @param array $data The data to create the category
     * @return array The created category
     * @throws CategoryCreateFailedException If the creation fails
     */
    public function create(array $data): array
    {
        try {
            $category = $this->categoryRepository->create($data);
            return $category;
        } catch (Exception $e) {
            throw new CategoryCreateFailedException($data);
        }
    }

    /**
     * Get all categories
     *
     * @return array The list of categories
     * @throws CategoryGetAllFailedException If the retrieval fails
     */
    public function getAll(): array
    {
        try {
            return $this->categoryRepository->getAll();
        } catch (Exception $e) {
            throw new CategoryGetAllFailedException();
        }
    }



    public function getOnlyActives()
    {
        try {
            return $this->categoryRepository->getOnlyActives();
        } catch (Exception $e) {
            throw new CategoryGetAllFailedException();
        }
    }

    /**
     * Delete a category by UUID
     *
     * @param string $uuid The UUID of the category to delete
     * @throws CategoryDeleteFailedException If the deletion fails
     */
    public function delete(string $uuid): void
    {
        try {
            $this->categoryRepository->deleteByUuid($uuid);
        } catch (Exception $e) {
            throw new CategoryDeleteFailedException(['uuid' => $uuid]);
        }
    }

    /**
     * Get a category by UUID
     *
     * @param string $uuid The UUID of the category to retrieve
     * @return stdClass|bool The category or false if not found
     * @throws CategoryGetByUuidException If the retrieval fails
     */
    public function getByUuid(string $uuid): stdClass|bool
    {
        try {
            $category = $this->categoryRepository->getByUuid($uuid);
            return $category;
        } catch (Exception $e) {
            throw new CategoryGetByUuidException(['uuid' => $uuid]);
        }
    }

    /**
     * Update a category by UUID
     *
     * @param string $uuid The UUID of the category to update
     * @param array $data The data to update the category
     * @return array The updated category
     * @throws CategoryUpdateFailedException If the update fails
     */
    public function update(string $uuid, array $data): array
    {
        try {
            $category = $this->categoryRepository->updateByUuid($uuid, $data);
            return $category;
        } catch (Exception $e) {
            throw new CategoryUpdateFailedException(['uuid' => $uuid]);
        }
    }
}
