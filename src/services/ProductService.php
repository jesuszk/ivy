<?php

namespace src\Services;

use Exception;
use src\exceptions\products\ProductCreateFailedException;
use src\exceptions\products\ProductDeleteFailedException;
use src\exceptions\products\ProductGetAllFailedException;
use src\exceptions\products\ProductGetByUuidException;
use src\exceptions\products\ProductUpdateFailedException;
use src\Repositories\ProductRepository;
use stdClass;

class ProductService
{
    public function __construct(private ProductRepository $productRepository) {}

    /**
     * Create a new product
     *
     * @param array $data The data to create the product
     * @return array The created product
     * @throws ProductCreateFailedException If the creation fails
     */
    public function create(array $data): array
    {
        try {
            $product = $this->productRepository->create($data);
            return $product;
        } catch (Exception $e) {
            throw new ProductCreateFailedException($data);
        }
    }

    /**
     * Get all products
     *
     * @return array The list of products
     * @throws ProductGetAllFailedException If the retrieval fails
     */
    public function getAll(): array
    {
        try {
            return $this->productRepository->getAllWithCategories();
        } catch (Exception $e) {
            throw new ProductGetAllFailedException();
        }
    }

    /**
     * Delete a product by UUID
     *
     * @param string $uuid The UUID of the product to delete
     * @throws ProductDeleteFailedException If the deletion fails
     */
    public function delete(string $uuid): void
    {
        try {
            $this->productRepository->deleteByUuid($uuid);
        } catch (Exception $e) {
            throw new ProductDeleteFailedException(['uuid' => $uuid]);
        }
    }

    /**
     * Get a product by UUID
     *
     * @param string $uuid The UUID of the product to retrieve
     * @return stdClass|bool The product or false if not found
     * @throws ProductGetByUuidException If the retrieval fails
     */
    public function getByUuid(string $uuid): stdClass|bool
    {
        try {
            $product = $this->productRepository->getByUuid($uuid);
            return $product;
        } catch (Exception $e) {
            throw new ProductGetByUuidException(['uuid' => $uuid]);
        }
    }

    /**
     * Update a product by UUID
     *
     * @param string $uuid The UUID of the product to update
     * @param array $data The data to update the product
     * @return array The updated product
     * @throws ProductUpdateFailedException If the update fails
     */
    public function update(string $uuid, array $data): array
    {
        try {
            $product = $this->productRepository->updateByUuid($uuid, $data);
            return $product;
        } catch (Exception $e) {
            throw new ProductUpdateFailedException(['uuid' => $uuid]);
        }
    }
}
