<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use App\Models\Product;

class BerandaController extends Controller
{
    public function beranda()
    {
        Log::info('=== BERANDA PAGE ACCESSED ===', [
            'ip' => request()->ip(),
            'timestamp' => now()
        ]);

        // Fetch products, map to match frontend structure
        $products = Product::latest()->take(12)->get()->map(function($product) {
            return [
                'id' => $product->id,
                'nama' => $product->nama,
                'harga' => $product->harga,
                'hargaStr' => 'Rp ' . number_format($product->harga, 0, ',', '.'),
                'hargaStr' => 'Rp ' . number_format($product->harga, 0, ',', '.'),
                // Robust image handling with file check
                'image' => (function($img) {
                    if (!$img) return asset('images/placeholder.jpg');
                    if (str_starts_with($img, 'http')) return $img;
                    
                    $cleanPath = ltrim($img, '/');
                    
                    // Check if file exists in public/images
                    if (file_exists(public_path('images/' . $cleanPath))) {
                        return asset('images/' . $cleanPath);
                    }
                    
                    // Check if path is relative to public
                    if (file_exists(public_path($cleanPath))) {
                        return asset($cleanPath);
                    }
                    
                    return asset('storage/' . $cleanPath);
                })($product->image),
                'category' => $product->category ?? 'new',
                'label' => $product->label ?? 'New'
            ];
        });

        return view('beranda', compact('products'));
    }
}
