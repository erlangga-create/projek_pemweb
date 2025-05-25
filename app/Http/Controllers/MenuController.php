<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lokasi;
class MenuController extends Controller
{
    // Kumpulan data produk statis
    private function allProducts()
    {
        return collect([
            (object)['id' => 1, 'name' => 'Nasi Goreng', 'price' => 15000, 'category' => 'makanan', 'description' => 'Nasi goreng enak'],
            (object)['id' => 4, 'name' => 'Soto Ayam', 'price' => 18000, 'category' => 'makanan', 'description' => 'Soto ayam gurih'],
            (object)['id' => 5, 'name' => 'Ayam Goreng', 'price' => 20000, 'category' => 'makanan', 'description' => 'Ayam goreng crispy'],
            (object)['id' => 2, 'name' => 'Es Teh Manis', 'price' => 5000, 'category' => 'minuman', 'description' => 'Segar dingin'],
            (object)['id' => 6, 'name' => 'Jus Jeruk', 'price' => 12000, 'category' => 'minuman', 'description' => 'Jus jeruk segar'],
            (object)['id' => 7, 'name' => 'Kopi Hitam', 'price' => 15000, 'category' => 'minuman', 'description' => 'Kopi hitam panas'],
            (object)['id' => 3, 'name' => 'Keripik Kentang', 'price' => 8000, 'category' => 'snack', 'description' => 'Gurih renyah'],
            (object)['id' => 8, 'name' => 'Pisang Goreng', 'price' => 10000, 'category' => 'snack', 'description' => 'Pisang goreng hangat'],
        ]);
    }

    // Halaman menu utama
    public function index(Request $request)
    {
        $cat = $request->query('cat', 'all');
        $search = trim($request->query('cari', ''));
        $validCategories = ['all', 'makanan', 'minuman', 'snack'];

        if (!in_array($cat, $validCategories)) {
            $cat = 'all';
        }

        $products = $this->allProducts();

        if ($cat !== 'all') {
            $products = $products->where('category', $cat);
        }

        if ($search !== '') {
            $products = $products->filter(function ($product) use ($search) {
                return stripos($product->name, $search) !== false;
            });
        }

        return view('menu', ['products' => $products->values()->all()]);
    }

    // Tambah produk ke keranjang
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

    // Update jumlah produk di keranjang
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

    // Tampilkan halaman keranjang
    public function showCart()
    {
        $cart = session('cart', []);
        return view('cart', compact('cart'));
    }

    // Kosongkan isi keranjang
    public function clearCart()
    {
        session()->forget('cart');
        return redirect()->route('menu')->with('success', 'Keranjang berhasil dikosongkan.');
    }

    // Halaman konfirmasi pesanan
    public function confirmCart()
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('warning', 'Keranjang kosong! Tambahkan produk terlebih dahulu.');
        }
        
        $defaultAlamat = Lokasi::where('user_id', auth()->id())
                       ->where('is_default', true)
                       ->first();

            if (!$defaultAlamat) {
        return redirect()->route('lokasi')->with('warning', 'Silakan tambahkan dan set alamat default terlebih dahulu sebelum melanjutkan pemesanan.');
    }

        return view('confirm', compact('cart', 'defaultAlamat'));
    }

    // Simpan pesanan
    public function storeOrder(Request $request)
    {
        $request->validate([
            'alamat' => 'required|string',
            'metode_pembayaran' => 'required|in:Tunai,QRIS,Transfer Bank',
        ]);

        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('warning', 'Keranjang kosong! Tidak ada pesanan yang disimpan.');
        }

        // Simpan logika pemesanan di sini (jika ada database)

        session()->forget('cart');

        return redirect()->route('menu')->with('success', 'Pesanan berhasil dibuat!');
    }
}
