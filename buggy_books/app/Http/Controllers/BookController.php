<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Sentry\Laravel\Tracing\Middleware;

class BookController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('q');
        $books = [];
        if ($query) {
            // Sentry performance tracing for external API call
            $context = new \Sentry\Tracing\TransactionContext();
            $context->setName('Book Search');
            $context->setOp('search');
            $transaction = \Sentry\startTransaction($context);

            $response = Http::get('https://www.googleapis.com/books/v1/volumes', [
                'q' => $query,
                'maxResults' => 10,
            ]);
            if ($response->ok()) {
                $books = $response->json('items') ?? [];
            }
            $transaction->finish();
        }
        return view('search', ['books' => $books, 'query' => $query]);
    }
} 