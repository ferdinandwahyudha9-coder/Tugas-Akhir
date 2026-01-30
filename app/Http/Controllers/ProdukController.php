<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProdukController extends Controller
{
    public function produk()
    {
        Log::info('=== PRODUK PAGE ACCESSED ===', [
            'ip' => request()->ip(),
            'timestamp' => now()
        ]);

        // Fetch all products for the product page
        $products = \App\Models\Product::latest()->get()->map(function($product) {
            return [
                'id' => $product->id,
                'nama' => $product->nama,
                'harga' => $product->harga,
                'hargaStr' => 'Rp ' . number_format($product->harga, 0, ',', '.'),
                'image' => (function($img) {
                    if (!$img) return asset('images/placeholder.jpg');
                    if (str_starts_with($img, 'http')) return $img;
                    
                    $cleanPath = ltrim($img, '/');
                    
                    // Check if file exists in public/images (e.g. for "tb1.jpeg")
                    if (file_exists(public_path('images/' . $cleanPath))) {
                        return asset('images/' . $cleanPath);
                    }
                    
                    // Check if path is relative to public (e.g. "images/tb1.jpeg")
                    if (file_exists(public_path($cleanPath))) {
                        return asset($cleanPath);
                    }
                    
                    return asset('storage/' . $cleanPath);
                })($product->image),
                'category' => 'new',
                'label' => $product->label ?? 'New',
                'deskripsi' => $product->deskripsi
            ];
        });

        return view('produk', compact('products'));
    }
    // Ganti method detailproduk() menjadi detail_produk()
    public function detail_produk(Request $request)
    {
        $id = $request->query('id');

        // Fetch from DB
        $productModel = \App\Models\Product::find($id);

        if (!$productModel) {
            abort(404, 'Produk tidak ditemukan');
        }

        // Map to array format expected by the view
        $produk = [
            'id' => $productModel->id,
            'nama' => $productModel->nama,
            'harga' => $productModel->harga,
            'hargaStr' => 'Rp ' . number_format($productModel->harga, 0, ',', '.'),
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
            })($productModel->image),
            'deskripsi' => $productModel->deskripsi ?? 'Tidak ada deskripsi',
            'stok' => $productModel->stok
        ];

        return view('detail_produk', compact('produk'));
    }
}
