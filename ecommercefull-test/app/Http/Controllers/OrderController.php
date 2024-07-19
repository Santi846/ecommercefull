<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\CustomerToken;
use App\Models\Shopping;


class OrderController extends Controller
{
   

    public function orderListItem($id)
    {
        $product = Product::find($id);

        if (!$product) {
            
            return redirect()->url('/')->with('error', 'Producto no encontrado.');
        }

        // Depuración
        // dd($product);

        return view('order.addition', ['productItems' => [$product]]);
    }

    public function addToOrder($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return redirect()->url('/')->with('error', 'Producto no encontrado.');
        }

        Order::create([
            'product_id' => $product->id,
            'title' => $product->title,
            'currency' => $product->currency,
            'prize' => $product->prize,
            'stock' => $product->stock
        ]);

        $customers = CustomerToken::all();
        $products = Product::all();

        return view('customer', ['customers' => $customers], ['products' => $products]
    );

       
    }

    public function showOrderItems(){
        // $orderItems = Order::all();
        
    }
    public function showOrder()
    {   
         $orders = Order::all();
         $customers = CustomerToken::all();

        return view('order.view', ['orders' => $orders], ['customers' => $customers]);
    }

    public function showOrderReserved()
    {   
         $orders = Order::all();

        return view('order.viewSeller', ['orders' => $orders]);
    }

    public function purchase(Request $request, $customerId)
    {
        $customer = CustomerToken::find($customerId);

        if ($customer) {

            $orders = Order::all();
            $customers = CustomerToken::all();
            $total = $orders->sum('prize');

            // Depuración: Mostrar los valores de $customer->money y $total
            // dd($customer->money, $total);

            if ($customer->money >= $total) {
                // Crear una nueva compra
                Shopping::create([
                    'customer_id' => $customer->id, 
                    'total' => $total
                ]);

                // Descontar el dinero del cliente
                $customer->money -= $total;
                $customer->save();

                // Eliminar las órdenes (opcional)
                Order::truncate();

                return redirect('/customer');
            } elseif($customer->money < $total) {
                $customers = CustomerToken::all();
                $products = Product::all();
                return view('customer', ['customers' => $customers] , ['products' => $products])
                ;
            } else{
                return redirect('/')->with('error', 'Cliente no encontrado.');
            }
            
        } else {
            return redirect('/')->with('error', 'Cliente no encontrado.');
        }
    
    }

    public function destroyOrder(string $id)//: RedirectResponse
    {
        Order::destroy($id);
        $orders = Order::all();
        $customers = CustomerToken::all();
        return view('order.view', ['orders' => $orders], ['customers' => $customers]);
    }

    public function showShopping()
    {   
         $shoppings = Shopping::all();

        return view('order.viewShopping', ['shoppings' => $shoppings]);
    }

    public function addMoneyToCustomer($customerId, Request $request){
    
    $customer = CustomerToken::find($customerId);
    $numero = $request->input('numero');
    
    if ($customer) {
        $customer->money += $numero;
        $customer->save();
        
        return redirect('/customer');
    } else {
        return redirect()->back()->with('error', 'Cliente no encontrado.');
    }
    }

}