<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use App\Jobs\GenerateReceiptPdf;
use \Sentry\Tracing\TransactionContext;

class CartController extends Controller
{
    public function index()
    {
        $cart = Session::get('cart', []);
        return view('cart', ['cart' => $cart]);
    }

    public function add(Request $request)
    {
        $cart = Session::get('cart', []);
        $cart[$request->book_id] = [
            'id' => $request->book_id,
            'title' => $request->title,
            'author' => $request->author,
        ];
        Session::put('cart', $cart);
        if ($request->expectsJson()) {
            return response()->json(['status' => 'ok']);
        }
        return redirect()->back();
    }

    public function remove(Request $request, $id)
    {
        $cart = Session::get('cart', []);
        unset($cart[$id]);
        Session::put('cart', $cart);
        return redirect()->route('cart.index');
    }

    public function checkout()
    {
        $cart = Session::get('cart', []);
        // Sentry performance tracing for checkout
        $context = new TransactionContext();
        $context->setName('Checkout');
        $context->setOp('checkout');
        $transaction = \Sentry\startTransaction($context);

        try {
            if (count($cart) === 0) {
                throw new \Exception('Cart is empty!');
            }
            // Simulate slow job (sleep)
            sleep(2);
            // Simulate random error for Sentry
            if (rand(0, 4) === 0) {
                throw new \Exception('Random checkout error!');
            }
            Session::forget('cart');
            $success = true;
            // Dispatch slow job for Sentry queue tracing
            GenerateReceiptPdf::dispatch();
        } catch (\Exception $e) {
            \Sentry\captureException($e);
            $success = false;
            $error = $e->getMessage();
        }
        $transaction->finish();
        return view('checkout', [
            'success' => $success ?? false,
            'error' => $error ?? null,
        ]);
    }
} 

