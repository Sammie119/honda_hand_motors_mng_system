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