<form action="store_expenditure" method="POST" autocomplete="off">
    @csrf
    @isset($expenditure)
        <input type="hidden" name="id" value="{{ $expenditure->exp_id }}" />
    @endisset
    
    <div class="row mb-3">
        <div class="col-12">
            <div class="form-floating mb-3 mb-md-0">
                <input class="form-control" value="{{ (isset($expenditure)) ? $expenditure->details : null }}" name="details" type="text" required placeholder=" " />
                <label>Expenditure Details</label>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-6">
            <div class="form-floating mb-3 mb-md-0">
                <select class="form-control" name="engineer" required placeholder=" ">
                    <option value="" selected disabled>Engineer in Charge</option>
                    @foreach (\App\Models\Staff::orderBy('name')->where('position', 'Master')->get('name') as $value)
                        <option @if ((isset($expenditure)) && $expenditure->engineer === $value->name) selected @endif>{{ $value->name }}</option>                        
                    @endforeach
                </select>
                <label>Engineer in Charge</label>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-floating mb-3 mb-md-0">
                <input class="form-control" value="{{ (isset($expenditure)) ? $expenditure->car_no : null }}" name="car_no" id="car_no" type="text" placeholder=" " />
                <label>Car Number</label>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-floating mb-3 mb-md-0">
                <input class="form-control" value="{{ (isset($expenditure->car_no)) ? \App\Models\Customer::select('car_model')->where('car_no', $expenditure->car_no)->first()->car_model : null }}" type="text" id="car_model" readonly placeholder=" " />
                <label>Car Model</label>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-4">
            <div class="form-floating mb-3 mb-md-0">
                <select class="form-control" name="portfolio" required placeholder=" ">
                    <option value="" selected disabled>--Select Portfolio--</option>
                    @foreach (\App\Models\CustomSetup::orderBy('custom_name')->where('custom_type', 'Portfolio')->get('custom_name') as $value)
                        <option @if ((isset($expenditure)) && $expenditure->portfolio == $value->custom_name) selected @endif>{{ $value->custom_name }}</option>                        
                    @endforeach
                </select>
                <label>Portfolio</label>
            </div>
        </div>
        <div class="col-4">
            <div class="form-floating mb-3 mb-md-0">
                <input class="form-control" value="{{ (isset($expenditure)) ? $expenditure->amount : null }}" name="amount" type="number" step="0.01" min="0" required placeholder=" " />
                <label>Amount</label>
            </div>
        </div>
        <div class="col-4">
            <div class="form-floating mb-3 mb-md-0">
                <input class="form-control" value="{{ (isset($expenditure)) ? $expenditure->exp_date : date('Y-m-d') }}" name="exp_date" type="date" max="{{ date('Y-m-d') }}" required placeholder=" " />
                <label>Date</label>
            </div>
        </div>
    </div>
    
    <hr width="104%" style="margin-left: -15px; background: #bbb">

    <div class="mt-4 mb-0">
        <div class="d-grid"><button type="submit" class="btn btn-block btn-primary">Submit</button></div>
    </div>
</form>