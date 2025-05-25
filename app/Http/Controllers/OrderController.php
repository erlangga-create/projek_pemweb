<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
        public function index()
    {
        $orders = Order::where('user_id', Auth::id())->latest()->get();
        return view('history', compact('orders'));
    }

    // Menghapus pesanan tertentu
    public function destroy($id)
    {
        $order = Order::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil dihapus.');
    }
    public function save(Request $request)
{
$request->validate([
        // Hapus 'alamat' dari sini
        'metode_pembayaran' => 'required',
    ]);

    $cart = session('cart', []);
    if (empty($cart)) {
        return redirect()->back()->with('error', 'Keranjang kosong');
    }

    $total = 0;
    foreach ($cart as $item) {
        $total += $item['product']->price * $item['qty'];
    }

    $order = Order::create([
        'user_id' => auth()->id(),
        'metode_pembayaran' => $request->metode_pembayaran,
        'total' => $total,
    ]);

    session()->forget('cart');

    return redirect()->route('menu')->with('success', 'Pesanan berhasil disimpan!');
}
}
