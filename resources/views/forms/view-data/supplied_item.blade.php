<h3>Items Received</h3> 

<hr>

<div class="row mt-2">
    <div class="col-md-6">Description</div>
    <div class="col-md-2" style="text-align: center">Stock Qty</div>
    <div class="col-md-2" style="text-align: center">Restock Qty</div>
    <div class="col-md-2" style="text-align: center">Amount</div>
</div>
  
  <div class="products getTotalAmount">  
    @foreach ($supply->item_id as $key => $item)
    @php
        $getItem = App\Models\Item::select('stock', 'item')->where('item_id', $item)->first();
    @endphp
    <div class="row mt-2">
        <div class="col-md-6">
            <select class="form-control form-control-border bg-white" name="items_id[]" placeholder=" " style="height: 35px;"><option value="{{ $item }}">{{ $getItem->item }}</option></select>
        </div>
        <div class="col-md-2">
            <input value="{{ $supply->old_stock[$key] }}" class="form-control form-control-border bg-white stock" name="old_stock[]" type="number" placeholder=" " style="height: 35px; padding: 0px; text-align: right" readonly>
        </div>
        <div class="col-md-2">
            <input value="{{ $supply->new_stock[$key] }}" class="form-control form-control-border bg-white quantity" name="new_stock[]" type="number" step="1" min="1" readonly placeholder=" " style="height: 35px; padding: 0px; text-align: right" >
        </div>
        <div class="col-md-2">
            <input value="{{ $supply->amount[$key] }}" class="form-control form-control-border bg-white sub_total" name="amount[]" type="number" step="0.01" min="0" readonly placeholder=" " style="height: 35px; padding: 0px; text-align: right" >
        </div>
    </div> 
  @endforeach
      
  </div>
  <div class="row mt-2 add-input">
    <div class="col-md-10" style="text-align: right">
        <strong>Total Amount:</strong>
    </div>
    <div class="col-md-2">
        <input type="text" value="{{ (isset($supply)) ? number_format(array_sum($supply->amount), 2) : null }}" class="form-control form-control-border bg-white total_amount" name="" id="" style="height: 35px; text-align: right; font-weight: bolder" readonly>
    </div>
</div>

<hr>

<h3>Payments</h3>
<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Total Amount</th>
            <th scope="col">Amount Paid</th>
            <th scope="col">Date</th>
            <th scope="col">Staff</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    @foreach ($payments as $key => $payment)
        
        <tr>
            <td>{{ ++$key }}</td>
            <td>{{ formatCedisAmount($payment->total_amount) }}</td>
            <td>{{ formatCedisAmount($payment->paid) }}</td>
            <td>{{ formatDate($payment->sup_date) }}</td>
            <td>{{ getUsername($payment->updated_by) }}</td>
            <td><button class="btn btn-danger btn-sm delete_payment" value="{{ $payment->supply_id }}" data-bs-toggle="modal" data-bs-target="#comfirm-delete" role="button">Del</button></td>
        </tr>
        
    @endforeach
    <tfoot>
        <tr>
            <th></th>
            <th>Total Paid:</th>
            <th>{{ formatCedisAmount($payments->sum('paid')) }}</th>
            <th>Balance:</th>
            <th>{{ formatCedisAmount($payment->total_amount - $payments->sum('paid')) }}</th>
            <th></th>
        </tr>
    </tfoot> 
</table>
    
<hr width="104%" style="margin-left: -15px; background: #bbb">
<div class="float-end">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
</div>
