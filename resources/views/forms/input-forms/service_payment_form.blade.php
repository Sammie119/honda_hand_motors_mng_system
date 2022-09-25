<form action="service_payment" method="POST" autocomplete="off">
    @csrf
    
    @isset($amount)
        <input type="hidden" name="id" value="{{ $amount->service_id }}" />
    @endisset
    <input type="hidden" name="service_no" value="{{ $service->service_no }}" />

    <div class="row mb-3">
        <div class="col-md-3">
            <div class="form-floating mb-3 mb-md-0">
                <input class="form-control" value="{{ $service->car_no }}" id="car_no" type="text" readonly placeholder=" " />
                <label>Car Number</label>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-floating mb-3 mb-md-0">
                <input class="form-control" value="{{ $customer->car_model }}" type="text" id="car_model" readonly placeholder=" " />
                <label>Car Model</label>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-floating mb-3 mb-md-0">
                <input class="form-control" value="{{ $customer->fuel }}" type="text" id="fuel" readonly placeholder=" " />
                <label>Fuel</label>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-floating mb-3 mb-md-0">
                <input class="form-control" value="{{ (isset($amount)) ? $amount->updated_at->format('Y-m-d') : date('Y-m-d') }}" type="date" readonly placeholder=" " />
                <label>Date</label>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <div class="form-floating mb-3 mb-md-0">
                <input class="form-control" value="{{ $customer->customer_name }}" id="customer_name" type="text" readonly placeholder=" " />
                <label>Customer's Name</label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-floating">
                <div class="form-floating mb-3 mb-md-0">
                    <input class="form-control" value="{{ $customer->driver_name }}" id="driver_name" type="text" readonly placeholder=" " />
                    <label>Driver's Name</label>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-12">
            <div class="form-floating mb-3 mb-md-0">
                <textarea class="form-control" cols="5" readonly placeholder=" " >{{ $service->fault }}</textarea>
                <label>Fault Discription</label>
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-6">
            <div class="form-floating mb-3 mb-md-0">
                <select class="form-control" placeholder=" ">
                    <option value="" selected>{{ $service->engineer }}</option>
                </select>
                <label>Engineer in Charge</label>
            </div>
        </div>
        <div class="col-6">
            <div class="form-floating mb-3 mb-md-0">
                <input class="form-control" value="{{ number_format($service->ser_charge, 2) }}" type="text" readonly placeholder=" " />
                <label>Service Charge</label>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-4">
            <div class="form-floating mb-3 mb-md-0">
                <input value="{{ (isset($amount)) ? $paid = $service->amount_paid - $amount->amount_paid : $service->amount_paid }}" type="hidden" name="amount_paid">
                <input class="form-control" value="{{ (isset($amount)) ? number_format($service->amount_paid - $amount->amount_paid, 2) : number_format($service->amount_paid, 2) }}" type="text" readonly placeholder=" " />
                <label>Amount Paid</label>
            </div>
        </div>
        <div class="col-4">
            <div class="form-floating mb-3 mb-md-0">
                <input type="hidden" name="balance" id="balance" value="{{ (isset($amount)) ? $balance = ((float)$service->ser_charge - (float)$paid) : $balance = ((float)$service->ser_charge - (float)$service->amount_paid) }}">
                <input class="form-control" value="{{ number_format($balance, 2) }}" type="text" readonly placeholder=" " />
                <label>Balance</label>
            </div>
        </div>
        <div class="col-4">
            <div class="form-floating mb-3 mb-md-0">
                <input class="form-control" id="amount" value="{{ (isset($amount)) ? $amount->amount_paid : null }}" name="amount" type="number" step="0.01" min="0" required placeholder=" " />
                <label>Amount</label>
            </div>
        </div>
    </div>
    
    <hr width="104%" style="margin-left: -15px; background: #bbb">

    <div class="mt-4 mb-0">
        <div class="d-grid"><button type="submit" class="btn btn-block btn-primary">Submit</button></div>
    </div>
</form>