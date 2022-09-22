<form action="store_customer" method="POST" autocomplete="off">
    @csrf
    @isset($customer)
        <input type="hidden" name="id" value="{{ $customer->customer_id }}" />
    @endisset
    <div class="row mb-3">
        <div class="col-12">
            <div class="form-floating mb-3 mb-md-0">
                <input class="form-control" value="{{ (isset($customer)) ? $customer->customer_name : null }}" name="customer_name" type="text" required placeholder=" " />
                <label>Owner Name</label>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-12">
            <div class="form-floating mb-3 mb-md-0">
                <input class="form-control" value="{{ (isset($customer)) ? $customer->driver_name : null }}" name="driver_name" type="text" required placeholder=" " />
                <label>Driver's Name</label>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-4">
            <div class="form-floating mb-3 mb-md-0">
                <input class="form-control" value="{{ (isset($customer)) ? $customer->car_no : null }}" name="car_no" type="text" required placeholder=" " />
                <label>Car Number</label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-floating">
                <select class="form-control" name="fuel" required >
                    <option value="" disabled selected>Fuel</option>
                    <option value="Deisel" @if(isset($customer) && ($customer->fuel === 'Deisel')) selected @endif >Deisel</option>
                    <option value="Super" @if(isset($customer) && ($customer->fuel === 'Super')) selected @endif >Super</option>
                </select>
                <label>Fuel</label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-floating">
                <input class="form-control" value="{{ (isset($customer)) ? $customer->car_model : null }}" name="car_model" type="text" required placeholder=" " />
                <label>Car Model</label>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <div class="form-floating mb-3 mb-md-0">
                <input class="form-control" value="{{ (isset($customer)) ? $customer->customer_contact : null }}" name="customer_contact" type="number" required placeholder=" " />
                <label>Owner's Contact</label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-floating">
                <input class="form-control" value="{{ (isset($customer)) ? $customer->driver_contact : null }}" name="driver_contact" type="number" required placeholder=" " />
                <label>Driver's Contact</label>
            </div>
        </div>
    </div>
    
    <hr width="104%" style="margin-left: -15px; background: #bbb">

    <div class="mt-4 mb-0">
        <div class="d-grid"><button type="submit" class="btn btn-block btn-primary">Submit</button></div>
    </div>
</form>