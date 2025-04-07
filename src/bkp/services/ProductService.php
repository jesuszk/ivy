<?php

namespace src\services;

use Exception;
use src\exceptions\products\ProductCreateFailedException;
use src\exceptions\products\ProductDeleteFailedException;
use src\exceptions\products\ProductGetAllFailedException;
use src\exceptions\products\ProductGetByUuidException;
use src\exceptions\products\ProductUpdateFailedException;
use src\repositories\ProductRepository;
use stdClass;

class ProductService
{
    public function __construct(private ProductRepository $ProductRepository) {}

    public function create(array $data): array
    {
        try {
            $data['value_min'] = $data['value_min'] ?? 0;
            $product = $this->ProductRepository->create($data);
            return $product;
        } catch (Exception $e) {
            throw new ProductCreateFailedException($data);
        }
    }

    public function getAll(): array
    {
        try {
            return $this->ProductRepository->getAll();
        } catch (Exception $e) {
            throw new ProductGetAllFailedException();
        }
    }

    public function delete(string $uuid): void
    {
        try {
            $this->ProductRepository->deleteByUuid($uuid);
        } catch (Exception $e) {
            throw new ProductDeleteFailedException(['uuid' => $uuid]);
        }
    }

    public function getByUuid(string $uuid): stdClass|bool
    {
        try {
            $product = $this->ProductRepository->getByUuid($uuid);
            return $product;
        } catch (Exception $e) {
            throw new ProductGetByUuidException(['uuid' => $uuid]);
        }
    }

    public function update(string $uuid, array $data): array
    {
        try {
            $data['value_min'] = $data['value_min'] ?? 0;
            $product = $this->ProductRepository->updateByUuid($uuid, $data);
            return $product;
        } catch (Exception $e) {
            throw new ProductUpdateFailedException(['uuid' => $uuid]);
        }
    }
}
