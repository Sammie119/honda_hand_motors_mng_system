<form action="store_payment" method="POST" autocomplete="off">
    @csrf
    <input type="hidden" name="customer_id" value="{{ $transaction->first()->customer_id }}" id="customer_id" />
    <div class="row mb-3">
        <div class="col-md-4">
            <div class="form-floating mb-3 mb-md-0">
                <input class="form-control" value="{{ $transaction->first()->car_no }}" name="car_no" id="car_no" type="text" required @if (isset($transaction)) readonly @endif placeholder=" " />
                <label>Car Registration No.</label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-floating">
                <input class="form-control" value="{{ sprintf("%010d", $transaction->first()->invoice_no) }}" name="invoice_no" type="number" readonly placeholder=" " />
                <label>Invoice No.</label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-floating">
                <input class="form-control" value="{{ date('Y-m-d') }}" name="trans_date" type="date" max="{{ date('Y-m-d') }}" required placeholder=" " />
                <label>Date</label>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-12">
            <div class="form-floating mb-3 mb-md-0">
                <input class="form-control" value="{{ $transaction->first()->customer->customer_name }}" id="customer_name" type="text" readonly placeholder=" " />
                <label>Customer's Name</label>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <div class="form-floating mb-3 mb-md-0">
                <input class="form-control" value="{{ $transaction->first()->customer->car_model }}" id="car_model" type="text" readonly placeholder=" " />
                <label>Car Model</label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-floating">
                <input class="form-control" value="{{ $transaction->first()->customer->customer_contact }}" id="customer_contact" type="number" readonly placeholder=" " />
                <label>Contact</label>
            </div>
        </div>
    </div>

    <hr>
  
  <div class="row mt-2">
      <div class="col-md-7">Description</div>
      <div class="col-md-2">U/P</div>
      <div class="col-md-1">Qty</div>
      <div class="col-md-2" style="text-align: right">Amount</div>
  </div>
  
  <div class="products getTotalAmount">  
        @foreach ($transaction->first()->items as $key => $item)
            <div class="row mt-2">
                <div class="col-md-7">
                    <select class="form-control form-control-border bg-white" placeholder=" " style="height: 35px;"><option>{{ $item }}</option></select>
                </div>
                <div class="col-md-2">
                    <select class="form-control form-control-border bg-white price" placeholder=" " style="height: 35px; padding: 0px; text-align: center"><option>{{ number_format($transaction->first()->unit_price[$key], 2) }}</option></select>
                </div>
                <div class="col-md-1">
                    <input type="text" value="{{ $transaction->first()->quantity[$key] }}" class="form-control form-control-border bg-white quantity" readonly placeholder=" " style="height: 35px; padding: 0px; text-align: center" >
                </div>
                <div class="col-md-2">
                    <input type="text" value="{{ number_format($transaction->first()->quantity[$key] * $transaction->first()->unit_price[$key], 2) }}" class="form-control form-control-border bg-white sub_total" readonly placeholder=" " style="height: 35px; text-align: right" >
                </div>
            </div> 
        @endforeach
  </div>
    <div class="row mt-2 add-input">
        <div class="col-md-9" style="text-align: right">
            <strong>Total Amount:</strong>
        </div>
        <div class="col-md-3">
            <input type="text" value="{{ number_format($transaction->first()->total_amount, 2) }}" class="form-control form-control-border bg-white total_amount" name="" id="" style="height: 35px; text-align: right; font-weight: bolder" readonly>
        </div>
    </div>

    <div class="row mt-2 add-input">
        <div class="col-md-9" style="text-align: right">
            <strong>Amount Paid:</strong>
        </div>
        <div class="col-md-3">
            <input type="text" value="{{ number_format($transaction->sum('amount_paid'), 2) }}" class="form-control form-control-border bg-white total_amount" name="" id="" style="height: 35px; text-align: right; font-weight: bolder" readonly>
        </div>
    </div>

    <div class="row mt-2 add-input">
        <div class="col-md-9" style="text-align: right">
            <strong>Amount Balance:</strong>
        </div>
        @php
            $balance = $transaction->first()->total_amount - $transaction->sum('amount_paid');
        @endphp
        <div class="col-md-3">
            <input type="text" value="{{ number_format($balance, 2) }}" class="form-control form-control-border bg-white total_amount" name="" id="" style="height: 35px; text-align: right; font-weight: bolder" readonly>
        </div>
    </div>

    <div class="row mt-2 add-input">
        <div class="col-md-9" style="text-align: right">
            <strong>Amount:</strong>
        </div>
        <div class="col-md-3">
            <input type="text" class="form-control form-control-border bg-white total_amount" name="amount" id="amount" style="height: 35px; text-align: right; font-weight: bolder" required>
        </div>
    </div>
    
    <hr width="104%" style="margin-left: -15px; background: #bbb">

    <div class="mt-4 mb-0">
        <div class="d-grid"><button type="submit" class="btn btn-block btn-primary">Submit</button></div>
    </div>
</form>

{{-- <script>
    function remove(input) {
        input.parentNode.parentElement.remove()
    }
</script> --}}