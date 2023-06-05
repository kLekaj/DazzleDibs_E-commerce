<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Category;
use App\Models\Gallery;
use SimpleXMLElement;

class XmlParserController extends Controller
{
    public function parseXml(Request $request)
    {
        ini_set('memory_limit', '256M');
        ini_set('max_execution_time', 10800);
        // Get the XML file from the storage directory
        $xmlDataString = file_get_contents(public_path('dentsu-feed.xml'));
        $phpDataArray = json_decode(json_encode(simplexml_load_string($xmlDataString, 'SimpleXMLElement', LIBXML_NOCDATA),true), true);
        
        // Loop through each product
        foreach ($phpDataArray['item'] as $item) {
            // Create a new product
            $product = new Product();
            // dd($item, true);

            if( empty($item['mpn']) ) {
                $mpn = '';
            }
            else{
                $mpn = $item['mpn'];
            }
            if( empty($item['price']) ) {
                $price = '';
            }
            else{
                $price = $item['price'];
            }
            if( empty($item['sale_price']) ) {
                $sale_price = '';
            }
            else{
                $sale_price = $item['sale_price'];
            }
            if( empty($item['vip_price']) ) {
                $vip_price = '';
            }
            else{
                $vip_price = $item['vip_price'];
            }
            if( empty($item['stock']) ) {
                $stock = '';
            }
            else{
                $stock = $item['stock'];
            }
            if( empty($item['taglia']) ) {
                $taglia = '';
            }
            else{
                $taglia = $item['taglia'];
            }
            if( empty($item['description']) ) {
                $description = '';
            }
            else{
                $description = $item['description'];
            }
            if( empty($item['product_type']) ) {
                $product_type = '';
            }
            else{
                $product_type = $item['product_type'];
            }
            if( empty($item['eta']) ) {
                $eta = '';
            }
            else{
                $eta = $item['eta'];
            }
            if( empty($item['marche']) ) {
                $marche = '';
            }
            else{
                $marche = $item['marche'];
            }
            if( empty($item['genere']) ) {
                $genere = '';
            }
            else{
                $genere = $item['genere'];
            }
            if( empty($item['personaggi']) ) {
                $personaggi = '';
            }
            else{
                $personaggi = $item['personaggi'];
            }
            if( empty($item['colore']) ) {
                $colore = '';
            }
            else{
                $colore = $item['colore'];
            }
            if (array_key_exists('image_link', $item)){
                $image_link = $item['image_link'];
            }
            else{
                $image_link = '';
            }
            // Set the product attributes
            $product->id = (int) $item['id'];
            $product->mpn = (string) $mpn;
            $product->price = (float) $price;
            $product->sale_price = (float) $sale_price;
            $product->vip_price = (float) $vip_price;
            $product->stock = (int) $stock;
            $product->size = (string) $taglia;
            $product->parent_id = (int) $item['parent_id'];
            $product->title = (string) $item['title'];
            $product->description = (string) $description;
            $product->image_link = (string) $image_link;
            $product->eta = (string) $eta;
            $product->brand = (string) $marche;
            $product->gender = (string) $genere;
            $product->color = (string) $colore;
            $product->created_at = now();
            $product->updated_at = now();
    
            // Save the product
            $product->save();
    
            // Add the product to its categories
            if (isset($item['categories']) && isset($item['categories']['list'])) {
                foreach ($item['categories']['list'] as $category) {
                    $category = $this->createCategory($category);
                    $product->categories()->attach($category);
                }
            }
            
            // Add the product's gallery images
            if (isset($item['gallery']) && !empty($item['gallery'])) {
                $images = $item['gallery']['image'];
                if (!is_array($images)) {
                    // Convert $images to an array containing one element
                    $images = array($images);
                }
                foreach ($images as $image) {
                    $gallery = new Gallery();
                    $gallery->product_id = $product['id'];
                    $gallery->image_path = (string) $image;
                    $gallery->created_at = now();
                    $gallery->updated_at = now();
                    $gallery->save();
                }
            }
            
        }
    }
    
    private function createCategory($category, $parentId = null)
    {
        ini_set('max_execution_time', 10800);
        // Check if the category already exists
        $slug = Str::slug((string) $category['name']);
        $existingCategory = Category::where('slug', $slug)->first();
        if ($existingCategory) {
            return $existingCategory;
        }
    
        // Create a new category
        $newCategory = new Category();
        $newCategory->id = (string) $category['id'];
        $newCategory->name = (string) $category['name'];
        $newCategory->slug = $slug;
        $newCategory->parent_id = $parentId;
        $newCategory->created_at = now();
        $newCategory->save();
    }
}
