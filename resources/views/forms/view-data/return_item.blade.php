  
  <div class="row mt-2">
      <div class="col-md-7">Description</div>
      <div class="col-md-1">Stk</div>
      <div class="col-md-1">U/P</div>
      <div class="col-md-1">Qty</div>
      <div class="col-md-2" style="text-align: right">Amount</div>
  </div>
  
  <div class="products getTotalAmount">  
        @foreach ($transaction->items as $key => $item)
        @php
            $stock = App\Models\Item::select('stock')->where('item', $item)->first()->stock;
        @endphp
        <div class="row mt-2">
            <div class="col-md-7">
                <select class="form-control form-control-border bg-white" name="items_list[]" placeholder=" " style="height: 35px;"><option>{{ $item }}</option></select>
            </div>
            <div class="col-md-1">
                <select class="form-control form-control-border bg-white stock" name="stock[]" placeholder=" " style="height: 35px; padding: 0px; text-align: center"><option>{{ $stock }}</option></select>
            </div>
            <div class="col-md-1">
                <select class="form-control form-control-border bg-white price" name="unit_price[]" placeholder=" " style="height: 35px; padding: 0px; text-align: center"><option>{{ $transaction->unit_price[$key] }}</option></select>
            </div>
            <div class="col-md-1">
                <input type="text" value="{{ number_format($transaction->quantity[$key], 2) }}" class="form-control form-control-border bg-white quantity" name="quantity[]" readonly placeholder=" " style="height: 35px; padding: 0px; text-align: center" >
            </div>
            <div class="col-md-2">
                <input type="text" value="{{ number_format($transaction->quantity[$key] * $transaction->unit_price[$key], 2) }}" class="form-control form-control-border bg-white sub_total" name="amount[]" readonly placeholder=" " style="height: 35px; text-align: right" >
            </div>
        </div> 
        @endforeach
      
  </div>
<div class="row mt-2 add-input">
    <div class="col-md-10" style="text-align: right">
        <strong>Total Amount:</strong>
    </div>
    <div class="col-md-2">
        <input type="text" class="form-control form-control-border bg-white total_amount" value="{{ number_format($transaction->total_amount, 2) }}" style="height: 35px; text-align: right; font-weight: bolder" readonly>
    </div>
</div>
    
<hr width="104%" style="margin-left: -15px; background: #bbb">
