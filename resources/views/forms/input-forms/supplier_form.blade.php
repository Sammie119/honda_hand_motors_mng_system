<form action="store_supplier" method="POST" autocomplete="off">
    @csrf
    @isset($supplier)
        <input type="hidden" name="id" value="{{ $supplier->supplier_id }}" />
    @endisset
    <div class="row mb-3">
        <div class="col-12">
            <div class="form-floating mb-3 mb-md-0">
                <input class="form-control" value="{{ (isset($supplier)) ? $supplier->supplier_name : null }}" name="supplier_name" type="text" required placeholder=" " />
                <label>Supplier Name</label>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <div class="form-floating mb-3 mb-md-0">
                <input class="form-control" value="{{ (isset($supplier)) ? $supplier->contact : null }}" name="contact" type="number" required placeholder=" " />
                <label>Contact</label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-floating">
                <input class="form-control" value="{{ (isset($supplier)) ? $supplier->address : null }}" name="address" type="text" required placeholder=" " />
                <label>Address</label>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-12">
            <div class="form-floating mb-3 mb-md-0">
                <input class="form-control" value="{{ (isset($supplier)) ? $supplier->item_supply : null }}" name="item_supply" type="text" required placeholder=" " />
                <label>Item Supplied</label>
            </div>
        </div>
    </div>
    
    <hr width="104%" style="margin-left: -15px; background: #bbb">

    <div class="mt-4 mb-0">
        <div class="d-grid"><button type="submit" class="btn btn-block btn-primary">Submit</button></div>
    </div>
</form>