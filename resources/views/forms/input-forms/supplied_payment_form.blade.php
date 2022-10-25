<form action="supplies_payment" method="POST" autocomplete="off">
    @csrf
    <input type="hidden" name="id" value="{{ $supply->supply_no }}" />
    <div class="row mb-3">
        <div class="col-12">
            <div class="form-floating mb-3 mb-md-0">
                <input class="form-control" value="{{ $supply->first()->supplier->supplier_name }}" id="customer_name" type="text" readonly placeholder=" " />
                <label>Supplier Name</label>
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-6">
            <div class="form-floating mb-3 mb-md-0">
                <input class="form-control" value="{{ $supply->first()->receipt_no }}" id="car_no" type="text" required @if (isset($transaction)) readonly @endif placeholder=" " />
                <label>Receipt No.</label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-floating">
                <input class="form-control" value="{{ date('Y-m-d') }}" name="sup_date" type="date" max="{{ date('Y-m-d') }}" required placeholder=" " />
                <label>Date</label>
            </div>
        </div>
    </div>

    <hr>
  
    <div class="row mt-2">
        <div class="col-md-6">Description</div>
        <div class="col-md-2" style="text-align: center">Stock Qty</div>
        <div class="col-md-2" style="text-align: center">Restock Qty</div>
        <div class="col-md-2" style="text-align: center">Amount</div>
    </div>
      
      <div class="products getTotalAmount">  
        @foreach ($supply->first()->item_id as $key => $item)
        @php
            $getItem = App\Models\Item::select('stock', 'item')->where('item_id', $item)->first();
        @endphp
        <div class="row mt-2">
            <div class="col-md-6">
                <select class="form-control form-control-border bg-white" placeholder=" " style="height: 35px;"><option value="{{ $item }}">{{ $getItem->item }}</option></select>
            </div>
            <div class="col-md-2">
                <input value="{{ $supply->first()->old_stock[$key] }}" class="form-control form-control-border bg-white stock" type="number" placeholder=" " style="height: 35px; padding: 0px; text-align: right" readonly>
            </div>
            <div class="col-md-2">
                <input value="{{ $supply->first()->new_stock[$key] }}" class="form-control form-control-border bg-white quantity" type="number" step="1" min="1" readonly placeholder=" " style="height: 35px; padding: 0px; text-align: right" >
            </div>
            <div class="col-md-2">
                <input value="{{ $supply->first()->amount[$key] }}" class="form-control form-control-border bg-white sub_total" type="number" step="0.01" min="0" readonly placeholder=" " style="height: 35px; padding: 0px; text-align: right" >
            </div>
        </div> 
      @endforeach
          
      </div>
      <div class="row mt-2 add-input">
        <div class="col-md-10" style="text-align: right">
            <strong>Total Amount:</strong>
        </div>
        <div class="col-md-2">
            <input type="text" value="{{ (isset($supply)) ? number_format(array_sum($supply->first()->amount), 2) : null }}" class="form-control form-control-border bg-white total_amount" name="" id="" style="height: 35px; text-align: right; font-weight: bolder" readonly>
        </div>
    </div>

    <div class="row mt-2 add-input">
        <div class="col-md-10" style="text-align: right">
            <strong>Amount Paid:</strong>
        </div>
        <div class="col-md-2">
            <input type="text" value="{{ number_format($supply->sum('paid'), 2) }}" class="form-control form-control-border bg-white total_amount" name="" id="" style="height: 35px; text-align: right; font-weight: bolder" readonly>
        </div>
    </div>

    <div class="row mt-2 add-input">
        <div class="col-md-10" style="text-align: right">
            <strong>Amount Balance:</strong>
        </div>
        @php
            $balance = $supply->first()->total_amount - $supply->sum('paid');
        @endphp
        <div class="col-md-2">
            <input type="text" value="{{ number_format($balance, 2) }}" class="form-control form-control-border bg-white total_amount" name="" id="" style="height: 35px; text-align: right; font-weight: bolder" readonly>
        </div>
    </div>

    <div class="row mt-2 add-input">
        <div class="col-md-10" style="text-align: right">
            <strong>Amount:</strong>
        </div>
        <div class="col-md-2">
            <input type="text" class="form-control form-control-border bg-white total_amount" name="amount" id="amount" style="height: 35px; text-align: right; font-weight: bolder" required>
        </div>
    </div>
    
    <hr width="104%" style="margin-left: -15px; background: #bbb">

    <div class="mt-4 mb-0">
        <div class="d-grid"><button type="submit" class="btn btn-block btn-primary">Submit</button></div>
    </div>
</form>
