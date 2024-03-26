<?php

namespace App\Http\Resources;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $brand = Brand::find($this->brand_id);
        $category = Category::find($this->category_id);
        return [
            'id' => (string)$this->id,
            'type' => 'Product',
            'attributes' => [
            'name' => $this->name,   
            'brand_id' =>  $this->brand->name,
            'category_id' =>  $this->category->name,
             'is_trendy' => $this->is_trendy,
             'is_available' => $this->is_available,
             'price' => $this->price,
             'amount' => $this->amount,
             'discount' => $this->discount,
             'created_at' => $this->created_at->format('Y-m-d'),
            ],

            // 'brand' => [
            //     'name' => $brand->name,      
            // ],

            
            // 'category' => [
            //     'name' => $category->name,      
            // ],
             
        ];
    }
}
