<?php 
namespace App\Repositories\Pharmacy;

use App\Product;
use App\Repositories\BaseRepository;

class ProductRepository extends BaseRepository{
    
    public function model() {
        return Product::class;
    }
}