<form action="store_service" method="POST" autocomplete="off">
    @csrf
    @isset($service)
        <input type="hidden" name="id" value="{{ $service->service_id }}" />
    @endisset
    <div class="row mb-3">
        <div class="col-md-3">
            <div class="form-floating mb-3 mb-md-0">
                <input class="form-control" value="{{ (isset($service)) ? $service->car_no : null }}" name="car_no" id="car_no" type="text" {{ (isset($service)) ? 'readonly' : 'required' }} placeholder=" " />
                <label>Car Number</label>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-floating mb-3 mb-md-0">
                <input class="form-control" value="{{ (isset($service)) ? $customer->car_model : null }}" type="text" id="car_model" readonly placeholder=" " />
                <label>Car Model</label>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-floating mb-3 mb-md-0">
                <input class="form-control" value="{{ (isset($service)) ? $customer->fuel : null }}" type="text" id="fuel" readonly placeholder=" " />
                <label>Fuel</label>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-floating mb-3 mb-md-0">
                <input class="form-control" value="{{ (isset($service)) ? $service->service_date : date('Y-m-d') }}" max="{{ date('Y-m-d') }}" type="date" name="service_date" required placeholder=" " />
                <label>Date</label>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <div class="form-floating mb-3 mb-md-0">
                <input class="form-control" value="{{ (isset($service)) ? $customer->customer_name : null }}" id="customer_name" type="text" readonly placeholder=" " />
                <label>Customer's Name</label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-floating">
                <div class="form-floating mb-3 mb-md-0">
                    <input class="form-control" value="{{ (isset($service)) ? $customer->driver_name : null }}" id="driver_name" type="text" readonly placeholder=" " />
                    <label>Driver's Name</label>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-12">
            <div class="form-floating mb-3 mb-md-0">
                <textarea class="form-control" cols="5" name="fault" required placeholder=" " >{{ (isset($service)) ? $service->fault : null }}</textarea>
                <label>Fault Discription</label>
            </div>
        </div>
    </div>

    <hr>
    <h6>Select Items In Car</h6>
    <div class="row mb-3">
        @foreach (\App\Models\CustomSetup::orderBy('id')->where('custom_type', 'Item In Car')->get('custom_name') as $value)
            <div class="col-md-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="item_in_car[]" value="{{ $value->custom_name }}" @if (isset($service) && in_array($value->custom_name, $service->item_in_car)) checked @endif>
                    <label class="form-check-label">
                        {{ $value->custom_name }}
                    </label>
                </div>
            </div>
        @endforeach
    </div>

    <div class="row mb-3">
        <div class="col-12">
            <div class="form-floating mb-3 mb-md-0">
                <textarea class="form-control" cols="5" name="other_item_car" placeholder=" " >{{ (isset($service)) ? $service->other_item_car : null }}</textarea>
                <label>Other Items In Car</label>
            </div>
        </div>
    </div>
    
    <hr>

    <div class="row mb-3">
        <div class="col-6">
            <div class="form-floating mb-3 mb-md-0">
                <select class="form-control" name="engineer" required placeholder=" ">
                    <option value="" selected disabled>Engineer in Charge</option>
                    @foreach (\App\Models\Staff::orderBy('name')->where('position', 'Master')->get('name') as $value)
                        <option @if ((isset($service)) && $service->engineer === $value->name) selected @endif>{{ $value->name }}</option>                        
                    @endforeach
                </select>
                <label>Engineer in Charge</label>
            </div>
        </div>
        <div class="col-3">
            <div class="form-floating mb-3 mb-md-0">
                <input class="form-control" value="{{ (isset($service)) ? $service->ser_charge : null }}" name="ser_charge" type="number" step="0.01" min="0" required placeholder=" " />
                <label>Service Charge</label>
            </div>
        </div>
        <div class="col-3">
            <div class="form-floating mb-3 mb-md-0">
                <input class="form-control" value="{{ (isset($service)) ? $service->amount_paid : null }}" name="amount_paid" type="number" step="0.01" min="0" required placeholder=" " />
                <label>Deposit Amount</label>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-12">
            <div class="form-floating mb-3 mb-md-0">
                {{-- <input class="form-control" value="{{ (isset($service)) ?  : null }}" name="" type="text" required placeholder=" " /> --}}
                <select class="form-control" name="received_by" required placeholder=" ">
                    <option value="" selected disabled>Amount Received by</option>
                    @foreach (\App\Models\Staff::orderBy('name')->where('position', 'Master')->orWhere('position', '=', 'Staff')->get('name') as $value)
                        <option @if ((isset($service)) && $service->received_by === $value->name) selected @endif>{{ $value->name }}</option>                        
                    @endforeach
                </select>
                <label>Amount Received by</label>
            </div>
        </div>
    </div>

    <input type="hidden" name="customer_id" value="{{ (isset($service)) ? $service->customer_id : null }}" id="customer_id">
    
    <hr width="104%" style="margin-left: -15px; background: #bbb">

    <div class="mt-4 mb-0">
        <div class="d-grid"><button type="submit" class="btn btn-block btn-primary">Submit</button></div>
    </div>
</form>