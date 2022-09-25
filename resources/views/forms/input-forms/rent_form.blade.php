<form action="store_rent" method="POST" autocomplete="off">
    @csrf
    @isset($rent)
        <input type="hidden" name="id" value="{{ $rent->rent_id }}" />
        @php
            $month_year = explode(", ", $rent->month_year);
        @endphp
    @endisset
    
    <div class="row mb-3">
        <div class="col-12">
            <div class="form-floating mb-3 mb-md-0">
                <select class="form-control" name="master_id" required placeholder=" ">
                    <option value="" selected disabled>--Select Master--</option>
                    @foreach (\App\Models\Staff::select('name', 'staff_id')->orderBy('name')->where('position', 'Master')->get() as $value)
                        <option value="{{ $value->staff_id }}" @if ((isset($rent)) && $rent->master_id == $value->staff_id) selected @endif>{{ $value->name }}</option>                        
                    @endforeach
                </select>
                <label>Master</label>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-3">
            <div class="form-floating mb-3 mb-md-0">
                <input class="form-control" value="{{ (isset($rent)) ? $rent->amount : null }}" name="amount" type="number" step="0.01" min="0" required placeholder=" " />
                <label>Amount</label>
            </div>
        </div>
        <div class="col-3">
            <div class="form-floating mb-3 mb-md-0">
                <select class="form-control" name="month" required placeholder=" ">
                    <option value="" selected disabled>--Select Month--</option>
                    <option {{ ((isset($rent)) && $month_year[0] === 'January') ? 'selected' : null }}>January</option>
                    <option {{ ((isset($rent)) && $month_year[0] === 'February') ? 'selected' : null }}>February</option>
                    <option {{ ((isset($rent)) && $month_year[0] === 'March') ? 'selected' : null }}>March</option>
                    <option {{ ((isset($rent)) && $month_year[0] === 'April') ? 'selected' : null }}>April</option>
                    <option {{ ((isset($rent)) && $month_year[0] === 'May') ? 'selected' : null }}>May</option>
                    <option {{ ((isset($rent)) && $month_year[0] === 'June') ? 'selected' : null }}>June</option>
                    <option {{ ((isset($rent)) && $month_year[0] === 'July') ? 'selected' : null }}>July</option>
                    <option {{ ((isset($rent)) && $month_year[0] === 'August') ? 'selected' : null }}>August</option>
                    <option {{ ((isset($rent)) && $month_year[0] === 'September') ? 'selected' : null }}>September</option>
                    <option {{ ((isset($rent)) && $month_year[0] === 'October') ? 'selected' : null }}>October</option>
                    <option {{ ((isset($rent)) && $month_year[0] === 'November') ? 'selected' : null }}>November</option>
                    <option {{ ((isset($rent)) && $month_year[0] === 'December') ? 'selected' : null }}>December</option>
                </select>
                <label>Month</label>
            </div>
        </div>
        <div class="col-3">
            <div class="form-floating mb-3 mb-md-0">
                <select name="year" class="form-control" required>
                    <option value="" selected disabled>--Select Year--</option>
                    <?php 
                       for($i = 2022 ; $i <= date('Y'); $i++){
                            $thisYear = ((isset($rent)) && $month_year[1] == $i) ? 'selected' : null;
                            echo "<option ". $thisYear .">$i</option>";
                        }
                    ?>
                </select>
                <label>Year</label>
            </div>
        </div>
        <div class="col-3">
            <div class="form-floating mb-3 mb-md-0">
                <input class="form-control" value="{{ (isset($rent)) ? $rent->rent_date : date('Y-m-d') }}" name="rent_date" type="date" max="{{ date('Y-m-d') }}" required placeholder=" " />
                <label>Date</label>
            </div>
        </div>
    </div>
    
    <hr width="104%" style="margin-left: -15px; background: #bbb">

    <div class="mt-4 mb-0">
        <div class="d-grid"><button type="submit" class="btn btn-block btn-primary">Submit</button></div>
    </div>
</form>