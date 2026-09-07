<?php
namespace App\Repositories\Product;

use App\Contracts\Products\ProductRepositoryInterface;
use App\Models\Product;
use App\Repositories\BaseRepository;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    public function __construct(Product $model) 
    {
        parent::__construct($model);    
    }
}