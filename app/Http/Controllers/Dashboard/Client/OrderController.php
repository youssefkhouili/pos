<?php

namespace App\Http\Controllers\Dashboard\Client;

use App\Order;
use App\Client;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    protected $guards = [];

    public function index()
    {

    }


    public function create(Client $client, Order $order)
    {
        $categories = Category::with('product')->get();
        return view('admin.clients.orders.create', compact('client', 'order', 'categories'));
    }

    public function store(Request $request, Client $client)
    {

    }

    public function edit(Order $order, Client $client)
    {

    }

    public function update(Request $request, Client $client, Order $order)
    {

    }

    public function destroy(Client $client, Order $order)
    {

    }


}
