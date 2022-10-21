<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\StoresTransaction;
use Illuminate\Support\Facades\Session;

class StoresTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trans = StoresTransaction::where('amount_paid', 0)->orderByDesc('transaction_id')->limit(1000)->get();
        $items = Item::all();
        $item_array = [];
        foreach ($items as $item) {
            $item_array[] = $item->item;
        }
        return view('users.stores.transactions', ['transactions' => $trans, 'items' => $item_array]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        request()->validate([
            'car_no' => 'required|max:10',
            'customer_id' => 'required',
            'items_list' => 'required',
            'quantity' => 'required',
        ]);

        if($request->has('id')){
            $trans = StoresTransaction::find($request->id);
            $count = StoresTransaction::where('invoice_no', $trans->invoice_no)->count();
            if($count >= 2){
                return back()->with('error', 'Cant Edit this Transaction, Customer has made some payments!!'); 
            }

            foreach ($trans->items as $key => $item) {
                $item_name = Item::where('item', $item)->first();
                $item_name->stock = $item_name->stock + $trans->quantity[$key];

                $item_name->update();
            }

        } else {
            $trans = new StoresTransaction;
        }

        $trans->customer_id = $request->customer_id;
        $trans->car_no = $request->car_no;
        $trans->items = $request->items_list;
        $trans->quantity = $request->quantity;
        $trans->unit_price = $request->unit_price;
        $trans->total_amount = array_sum($request->amount);
        $trans->balance = array_sum($request->amount);
        $trans->invoice_no = $request->invoice_no;
        $trans->transaction_date = $request->trans_date;

        if($request->has('id')){
            $trans->updated_by = Auth()->user()->user_id;

            $trans->update();

            // return back()->with('success', 'Transaction Updated Successfully!!!');
            Session::flash('success', 'Transaction Updated Successfully!!!');
        } else {
            $trans->created_by = Auth()->user()->user_id;
            $trans->updated_by = Auth()->user()->user_id;

            $trans->save();

            // return back()->with('success', 'Transaction Saved Successfully!!!');
            Session::flash('success', 'Transaction Saved Successfully!!!');
        }

        foreach ($request->items_list as $key => $item) {
            $item_name = Item::where('item', $item)->first();
            $item_name->stock = $request->stock[$key] - $request->quantity[$key];

            // dd($request->stock[$key], $request->quantity[$key], $item_name->stock);
            $item_name->update();
        }

        $data = json_encode([
            'customer' => Customer::find($trans->customer_id),
            'stores_items' => $trans,
            'total_amount' => $trans->total_amount,
            'invoice_no' => $trans->invoice_no
        ]);

        echo "<script type='text/javascript'>
                window.open('receipt/stores/$data','','left=0,top=0,width=900,height=600,toolbar=0,scrollbars=0,status =0');
                window.location = 'stores_transactions';
            </script>";
    }

    public function printInvoice($id)
    {
        $trans = StoresTransaction::find($id);

        $data = json_encode([
            'customer' => Customer::find($trans->customer_id),
            'stores_items' => $trans,
            'total_amount' => $trans->total_amount,
            'invoice_no' => $trans->invoice_no
        ]);

        echo "<script type='text/javascript'>
                window.open('../receipt/stores/$data','','left=0,top=0,width=900,height=600,toolbar=0,scrollbars=0,status =0');
                window.location = '../stores_transactions';
            </script>";
    }

    public function transactionsPayments()
    {
        $trans = StoresTransaction::where('amount_paid', '>', 0)->orderByDesc('transaction_id')->limit(1000)->get();
    
        return view('users.stores.transactions_payment', ['transactions' => $trans]);
    }

    public function storePayment(Request $request)
    {
        $trans = new StoresTransaction;

        $trans_old = StoresTransaction::where('invoice_no', $request->invoice_no)->orderByDesc('transaction_id')->first();

        $receipt_no = StoresTransaction::select('receipt_no')->where('receipt_no', '!=', null)->count() + 1;

        $trans->customer_id = $trans_old->customer_id;
        $trans->car_no = $trans_old->car_no;
        $trans->items = $trans_old->items;
        $trans->quantity = $trans_old->quantity;
        $trans->unit_price = $trans_old->unit_price;
        $trans->total_amount = $trans_old->total_amount;
        $trans->invoice_no = $trans_old->invoice_no;
        $trans->transaction_date = $request->trans_date;
        $trans->amount_paid = $request->amount;
        $trans->receipt_no = $receipt_no;
        $trans->balance = $trans_old->balance - $request->amount;
        $trans->created_by = Auth()->user()->user_id;
        $trans->updated_by = Auth()->user()->user_id;

        // dd($trans);

        $trans->save();

        Session::flash('success', 'Payment Saved Successfully!!!');

        $data = json_encode([
            'customer' => Customer::find($trans->customer_id),
            'stores_items' => $trans,
            'total_amount' => $trans->total_amount,
            'amount_paid' => $trans->amount_paid,
            'previous_payment' => StoresTransaction::selectRaw('sum(amount_paid) as amount_paid')->where('invoice_no', $trans->invoice_no)->first()->amount_paid - $trans->amount_paid,
            'receipt_no' => $trans->receipt_no
        ]);

        echo "<script type='text/javascript'>
                window.open('receipt/stores/$data','','left=0,top=0,width=900,height=600,toolbar=0,scrollbars=0,status =0');
                window.location = 'transactions_payments';
            </script>";

    }

    public function printReceipt($id)
    {
        $trans = StoresTransaction::find($id);

        $data = json_encode([
            'customer' => Customer::find($trans->customer_id),
            'stores_items' => $trans,
            'total_amount' => $trans->total_amount,
            'amount_paid' => $trans->amount_paid,
            'previous_payment' => StoresTransaction::selectRaw('sum(amount_paid) as amount_paid')->where('invoice_no', $trans->invoice_no)->first()->amount_paid - $trans->amount_paid,
            'receipt_no' => $trans->receipt_no
        ]);

        echo "<script type='text/javascript'>
                window.open('../receipt/stores/$data','','left=0,top=0,width=900,height=600,toolbar=0,scrollbars=0,status =0');
                window.location = '../transactions_payments';
            </script>";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StoresTransaction  $storesTransaction
     * @return \Illuminate\Http\Response
     */
    public function destroy($storesTransaction)
    {
        $trans = StoresTransaction::where('invoice_no', $storesTransaction)->count();

        if($trans === 1){
            $trans = StoresTransaction::where('invoice_no', $storesTransaction)->first();

            $trans->delete();

            foreach ($trans->items as $key => $item) {
                $item_name = Item::where('item', $item)->first();
                $item_name->stock = $item_name->stock + $trans->quantity[$key];

                $item_name->update();
            }

            return back()->with('success', 'Transaction deleted Successfully!!');
        }

        return back()->with('error', 'Cant delete this Transaction, Customer has made some payments!!');
    }

    public function destroyTransactionReceipt($id)
    {
        $trans = StoresTransaction::find($id);

        $trans->delete();

        return back()->with('success', 'Transaction deleted Successfully!!');
    }
}
