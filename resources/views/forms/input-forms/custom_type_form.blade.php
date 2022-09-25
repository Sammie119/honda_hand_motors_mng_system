<form action="store_custom" method="POST" autocomplete="off">
    @csrf
    @isset($custom)
        <input type="hidden" name="id" value="{{ $custom->id }}" />
    @endisset
    <div class="row mb-3">
        <div class="col-md-6">
            <div class="form-floating mb-3 mb-md-0">
                <input class="form-control" value="{{ (isset($custom)) ? $custom->custom_name : null }}" name="custom_name" type="text" required placeholder=" " />
                <label>Description</label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-floating">
                <select class="form-control" name="custom_type" required >
                    <option value="" disabled selected>Custom Type</option>
                    <option value="Portfolio" @if(isset($custom) && ($custom->custom_type === 'Portfolio')) selected @endif >Portfolio</option>
                    <option value="Item In Car" @if(isset($custom) && ($custom->custom_type === 'Item In Car')) selected @endif >Item In Car</option>
            
                </select>
                <label>Custom Type</label>
            </div>
        </div>
    </div>
    
    <hr width="104%" style="margin-left: -15px; background: #bbb">

    <div class="mt-4 mb-0">
        <div class="d-grid"><button type="submit" class="btn btn-block btn-primary">Submit</button></div>
    </div>
</form>