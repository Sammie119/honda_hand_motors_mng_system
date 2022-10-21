<form action="store_item" method="POST" autocomplete="off">
    @csrf
    @isset($item)
        <input type="hidden" name="id" value="{{ $item->item_id }}" />
    @endisset
    <div class="row mb-3">
        <div class="col-12">
            <div class="form-floating mb-3 mb-md-0">
                <input class="form-control" value="{{ (isset($item)) ? $item->item : null }}" name="item" type="text" required placeholder=" " />
                <label>Item Name</label>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <div class="form-floating mb-3 mb-md-0">
                <input class="form-control" value="{{ (isset($item)) ? $item->stock : null }}" name="stock" type="number" required placeholder=" " />
                <label>Stock</label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-floating">
                <input class="form-control" value="{{ (isset($item)) ? $item->price : null }}" name="price" type="number" required placeholder=" " />
                <label>Price</label>
            </div>
        </div>
    </div>
    
    <hr width="104%" style="margin-left: -15px; background: #bbb">

    <div class="mt-4 mb-0">
        <div class="d-grid"><button type="submit" class="btn btn-block btn-primary">Submit</button></div>
    </div>
</form>