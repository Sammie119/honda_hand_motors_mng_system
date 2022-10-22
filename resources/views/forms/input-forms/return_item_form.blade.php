<form action="store_return" method="POST" autocomplete="off">
    @csrf
    @isset($transaction)
        <input type="hidden" name="id" value="{{ $transaction->transaction_id }}" />
    @endisset

    <input type="hidden" name="customer_id" value="{{ (isset($transaction)) ? $transaction->customer_id : null }}" id="customer_id" />
    <div class="row mb-3">
        <div class="col-md-4">
            <div class="form-floating mb-3 mb-md-0">
                <input class="form-control" value="{{ (isset($transaction)) ? $transaction->car_no : null }}" name="car_no" id="car_no" type="text" required @if (isset($transaction)) readonly @endif placeholder=" " />
                <label>Car Registration No.</label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-floating">
                <input class="form-control" value="{{ (isset($transaction)) ? $transaction->invoice_no : null }}" name="invoice_no" type="number" required placeholder=" " />
                <label>Invoice No.</label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-floating">
                <input class="form-control" value="{{ (isset($transaction)) ? $transaction->transaction_date : date('Y-m-d') }}" name="trans_date" type="date" max="{{ date('Y-m-d') }}" required placeholder=" " />
                <label>Date.</label>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-12">
            <div class="form-floating mb-3 mb-md-0">
                <input class="form-control" value="{{ (isset($transaction)) ? $transaction->customer->customer_name : null }}" id="customer_name" type="text" readonly placeholder=" " />
                <label>Customer's Name</label>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <div class="form-floating mb-3 mb-md-0">
                <input class="form-control" value="{{ (isset($transaction)) ? $transaction->customer->car_model : null }}" id="car_model" type="text" readonly placeholder=" " />
                <label>Car Model</label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-floating">
                <input class="form-control" value="{{ (isset($transaction)) ? $transaction->customer->customer_contact : null }}" id="customer_contact" type="number" readonly placeholder=" " />
                <label>Contact</label>
            </div>
        </div>
    </div>

    <hr>

    <div class="form-group">
        <div class="row">
            <div class="col-6">
                <label for="recipient-name" class="control-label">Items</label>
                <input type="text" placeholder="Select items" list="items_list" class="form-control form-control-border bg-white" id="items">
                <datalist id="items_list">
                  @foreach ($items as $item)
                      <option value="{{ $item->item }}">
                  @endforeach
                </datalist>
            </div>
            <div class="col-3"> 
              <label for="recipient-name" class="control-label">Action:</label><br>
              <button type="button" class="btn btn-success add-all-input"> <i class="fa fa-plus"></i> Add New</button> 
            </div>
        </div>
    </div>
  
  <div class="row mt-2">
      <div class="col-md-6">Description</div>
      <div class="col-md-1">Stk</div>
      <div class="col-md-1">U/P</div>
      <div class="col-md-1">Qty</div>
      <div class="col-md-2" style="text-align: right">Amount</div>
      <div class="col-md-1">Action</div>
  </div>
  
  <div class="products getTotalAmount">  
    <div class="row mt-2 add-input">
        <div class="col-md-12">
            No data Found
        </div>
    </div>      
  </div>
    <div class="row mt-2 add-input">
        <div class="col-md-9" style="text-align: right">
            <strong>Total Amount:</strong>
        </div>
        <div class="col-md-2">
            <input type="text" class="form-control form-control-border bg-white total_amount" name="" id="" style="height: 35px; text-align: right; font-weight: bolder" readonly>
        </div>
    </div>
    
    <hr width="104%" style="margin-left: -15px; background: #bbb">

    <div class="mt-4 mb-0">
        <div class="d-grid"><button type="submit" class="btn btn-block btn-primary">Submit</button></div>
    </div>
</form>
