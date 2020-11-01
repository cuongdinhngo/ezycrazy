<?php

namespace App\Controllers\Product;

use Atom\Controllers\Controller as BaseController;
use App\Entities\Product;
use Atom\Http\Request;

class ProductController extends BaseController
{
    /**
     * Construct class
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * List all products
     *
     * @return array
     */
    public function list()
    {
        try {
            $entityManager = $this->getDoctrineEntityManager();
            $productRepository = $entityManager->getRepository(Product::class);
            $products = $productRepository->findAll();
            return $products;
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Create new product
     *
     * @param mixed $request Request
     *
     * @return void
     */
    public function create(Request $request)
    {
        $product = new Product();
        $product->setName($request['name']);
        $entityManager = $this->getDoctrineEntityManager();
        $entityManager->persist($product);
        $entityManager->flush();

        echo "Created Product with ID " . $product->getId() . "\n";
    }

    /**
     * Update product
     *
     * @param mixed $request Request
     *
     * @return void
     */
    public function update(Request $request)
    {
        try {
            $entityManager = $this->getDoctrineEntityManager();
            $product = $entityManager->find(Product::class, $request['id']);
            if ($product === null) {
                echo "Product {$request['id']} does not exist.\n";
                exit(1);
            }
            $product->setName($request['name']);
            $entityManager->flush();
            var_dump($product);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Delete product
     *
     * @param mixed $request Request
     *
     * @return void
     */
    public function delete(Request $request)
    {
        try {
            $entityManager = $this->getDoctrineEntityManager();
            $product = $entityManager->find(Product::class, $request['id']);
            if ($product === null) {
                echo "Product {$request['id']} does not exist.\n";
                exit(1);
            }
            $entityManager->remove($product);
            $entityManager->flush();
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}
