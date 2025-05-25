<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenuController extends Controller
{
    // Data produk statis sebagai method agar mudah dipanggil dan tidak bergantung instance
    private function allProducts()
    {
        return collect([
            (object)['id'=>1, 'name'=>'Nasi Goreng', 'price'=>15000, 'category'=>'makanan', 'description'=>'Nasi goreng enak'],
            (object)['id'=>4, 'name'=>'Soto Ayam', 'price'=>18000, 'category'=>'makanan', 'description'=>'Soto ayam gurih'],
            (object)['id'=>5, 'name'=>'Ayam Goreng', 'price'=>20000, 'category'=>'makanan', 'description'=>'Ayam goreng crispy'],
            (object)['id'=>2, 'name'=>'Es Teh Manis', 'price'=>5000,  'category'=>'minuman', 'description'=>'Segar dingin'],
            (object)['id'=>6, 'name'=>'Jus Jeruk',    'price'=>12000, 'category'=>'minuman', 'description'=>'Jus jeruk segar'],
            (object)['id'=>7, 'name'=>'Kopi Hitam',   'price'=>15000, 'category'=>'minuman', 'description'=>'Kopi hitam panas'],
            (object)['id'=>3, 'name'=>'Keripik Kentang','price'=>8000,  'category'=>'snack', 'description'=>'Gurih renyah'],
            (object)['id'=>8, 'name'=>'Pisang Goreng',  'price'=>10000, 'category'=>'snack', 'description'=>'Pisang goreng hangat'],
        ]);
    }

    // HALAMAN MENU DENGAN FILTER KATEGORI & PENCARIAN
    public function index(Request $request)
    {
        $validCategories = ['all', 'makanan', 'minuman', 'snack'];
        $cat = $request->query('cat', 'all');
        $search = trim($request->query('cari', ''));

        // Validasi kategori
        if (!in_array($cat, $validCategories)) {
            $cat = 'all';
        }

        $products = $this->allProducts();

        // Filter berdasarkan kategori jika bukan all
        if ($cat !== 'all') {
            $products = $products->where('category', $cat);
        }

        // Filter berdasarkan pencarian nama produk
        if ($search !== '') {
            $products = $products->filter(function($product) use ($search) {
                return stripos($product->name, $search) !== false;
            });
        }

        // Ubah collection ke array supaya sesuai dengan view
        return view('menu', ['products' => $products->values()->all()]);
    }

    // TAMBAH PRODUK KE KERANJANG (POST /cart/add/{id})
    public function addToCart($id)
    {
        $product = $this->allProducts()->firstWhere('id', (int)$id);
        if (!$product) {
            return back()->with('error', 'Produk tidak ditemukan.');
        }

        $cart = session('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['qty']++;
        } else {
            $cart[$id] = ['product' => $product, 'qty' => 1];
        }

        session(['cart' => $cart]);

        return back()->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    // UPDATE QTY PRODUK DI KERANJANG (POST /cart/qty/{id}/{action})
    public function updateQty($id, $action)
    {
        $cart = session('cart', []);
        if (!isset($cart[$id])) {
            return back()->with('error', 'Produk tidak ditemukan di keranjang.');
        }

        if ($action === 'plus') {
            $cart[$id]['qty']++;
        } elseif ($action === 'minus') {
            $cart[$id]['qty']--;
            if ($cart[$id]['qty'] <= 0) {
                unset($cart[$id]);
            }
        }
        session(['cart' => $cart]);

        return back();
    }

    // TAMPILKAN HALAMAN KERANJANG (GET /cart)
    public function showCart()
    {
        $cart = session('cart', []);
        return view('cart', compact('cart'));
    }

    // KOSONGKAN KERANJANG (POST /cart/clear)
    public function clearCart()
    {
        session()->forget('cart');
        return redirect()->route('menu')->with('success', 'Keranjang berhasil dikosongkan.');
    }

    // TAMPILKAN HALAMAN KONFIRMASI PESANAN (GET /cart/confirm)
    public function confirmCart()
    {
        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('warning', 'Keranjang kosong! Tambahkan produk terlebih dahulu.');
        }

        return view('confirm', compact('cart'));
    }

    // SIMPAN PESANAN (POST /order/save)
    public function storeOrder(Request $request)
    {
        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('warning', 'Keranjang kosong! Tidak ada pesanan yang disimpan.');
        }

        // Simpan ke database atau proses lainnya di sini
        // Contoh: Order::create([...]);

        session()->forget('cart');

        return redirect()->route('menu')->with('success', 'Pesanan berhasil dibuat!');
    }
}
