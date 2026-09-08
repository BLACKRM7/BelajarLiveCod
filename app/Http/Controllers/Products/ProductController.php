<?php
namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\Products\StoreProductRequest;
use App\Http\Requests\Products\UpdateProductRequest;
use App\Http\Resources\Products\ProductResource;
use App\Services\Products\ProductService;
use App\Traits\ApiResponseTrait;

class ProductController extends Controller
{
    use ApiResponseTrait;

    protected ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        $products = $this->productService->getAllProducts();
        return $this->successResponse(ProductResource::collection($products), 'Daftar produk');
    }

    public function store(StoreProductRequest $request)
    {
        $product = $this->productService->createProduct($request->validated());
        return $this->successResponse(new ProductResource($product), 'Produk berhasil');
    }

    public function show(int $id)
    {
        $product = $this->productService->getProductById($id);
        if (!$product) {
            return $this->errorResponse('Produk tidak ditemukan', 404);
        }
        return $this->successResponse(new ProductResource($product), 'Detail produk');
    }

    public function update(UpdateProductRequest $request, int $id)
    {
        $product = $this->productService->getProductById($id);
        if (!$product) {
            return $this->errorResponse('Produk tidak ditemukan', 404);
        }
        return $this->successResponse(new ProductResource($product), 'Produk berhasil ditambah');
    }

    public function destroy(int $id)
    {
        $deleted = $this->productService->getProductById($id);
        if (!$deleted) {
            return $this->errorResponse('Produk tidak ditemukan', 404);
        }
        return $this->successResponse(null, 'Produk berhasil dihapus');
    }
}