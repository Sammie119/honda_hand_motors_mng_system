<form action="store_supply" method="POST" autocomplete="off">
    @csrf
    @isset($supply)
        <input type="hidden" name="id" value="{{ $supply->supply_id }}" />
    @endisset
    <div class="row mb-3">
        <div class="col-10">
            <div class="form-floating mb-3 mb-md-0">
                <input type="text" placeholder="Select items" value="{{ (isset($supply)) ? $supply->item_name->item : null }}" list="items_list" class="form-control form-control-border bg-white" name="item" id="items" required>
                <datalist id="items_list">
                    @foreach ($items as $item)
                        <option value="{{ $item->item }}">
                    @endforeach
                  </datalist>
                <label>Item</label>
            </div>                
        </div>
        <div class="col-2">
            <div class="form-floating mb-3 mb-md-0">
                <input class="form-control" value="{{ (isset($supply)) ? $supply->old_stock : null }}" name="old_stock" id="old_stock" type="text" readonly placeholder=" " />
                <label>Stock</label>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-3">
            <div class="form-floating mb-3 mb-md-0">
                <input class="form-control" value="{{ (isset($supply)) ? $supply->new_stock : null }}" name="new_stock" type="number" min="1" required placeholder=" " />
                <label>Restock Quantity</label>
            </div>
        </div>
        <div class="col-9">
            <div class="form-floating mb-3 mb-md-0">
                <select class="form-control" name="supplier_id" required >
                    <option value="" disabled selected>Supplier Name</option>
                    @foreach (App\Models\Supplier::orderBy('supplier_name')->get() as $supplier)
                        <option @if(isset($supply) && ($supply->supplier_id === $supplier->supplier_id)) selected @endif value="{{ $supplier->supplier_id }}">{{ $supplier->supplier_name }}</option>
                    @endforeach
                </select>
                <label>Supplier Name</label>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-4">
            <div class="form-floating mb-3 mb-md-0">
                <input class="form-control" value="{{ (isset($supply)) ? $supply->amount : null }}" name="amount" id="amount" type="number" step="0.01" min="1" required placeholder=" " />
                <label>Amount To Pay</label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-floating">
                <input class="form-control" value="{{ (isset($supply)) ? $supply->paid : null }}" name="amount_paid" id="amount_paid" type="number" step="0.01" min="0" required placeholder=" " />
                <label>Amount Paid</label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-floating">
                <input class="form-control" value="{{ (isset($supply)) ? $supply->amount - $supply->paid : null }}" name="balance" id="balance" type="text" readonly placeholder=" " />
                <label>Balance</label>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <div class="form-floating mb-3 mb-md-0">
                <input class="form-control" value="{{ (isset($supply)) ? $supply->receipt_no : null }}" name="receipt_no" type="number" required placeholder=" " />
                <label>Receipt Number</label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-floating">
                <input class="form-control" value="{{ (isset($supply)) ? $supply->sup_date : date('Y-m-d') }}" max="{{ date('Y-m-d') }}" name="sup_date" type="date" required placeholder=" " />
                <label>Date</label>
            </div>
        </div>
    </div>
    
    <hr width="104%" style="margin-left: -15px; background: #bbb">

    <div class="mt-4 mb-0">
        <div class="d-grid"><button type="submit" class="btn btn-block btn-primary">Submit</button></div>
    </div>
</form>

{{-- {{ $item_array }} --}}
<script>

    $('#items').bind('change',function(){ 
        // alert('Yes')
        var arr = <?= $item_array ?>;

        var k = String($(this).val());
        
        $('#old_stock').val(arr[k]);
        // console.log(arr[k]); 
    });

    $('#amount_paid').bind('change',function(){ 
        var amount = parseFloat($('#amount').val());
        var amount_paid = parseFloat($(this).val());

        $('#balance').val((amount - amount_paid).toFixed(2));
        
        // console.log(arr[k]); 
    });

</script>