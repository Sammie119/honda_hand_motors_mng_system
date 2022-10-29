<form action="store_staff" method="POST" autocomplete="off">
    @csrf
    @isset($staff)
        <input type="hidden" name="id" value="{{ $staff->staff_id }}" />
    @endisset
    <div class="row mb-3">
        <div class="col-12">
            <div class="form-floating mb-3 mb-md-0">
                <input class="form-control" value="{{ (isset($staff)) ? $staff->name : null }}" name="name" type="text" required placeholder=" " />
                <label>Name</label>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <div class="form-floating mb-3 mb-md-0">
                <input class="form-control" value="{{ (isset($staff)) ? $staff->mobile : null }}" name="mobile" type="number" required placeholder=" " />
                <label>Phone</label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-floating">
                <select class="form-control" name="position" required >
                    <option value="" disabled selected>Position</option>
                    <option value="Master" @if(isset($staff) && ($staff->position === 'Master')) selected @endif >Master</option>
                    <option value="Associate Master" @if(isset($staff) && ($staff->position === 'Associate Master')) selected @endif >Associate Master</option>
                    <option value="Apprentice" @if(isset($staff) && ($staff->position === 'Apprentice')) selected @endif >Apprentice</option>
                </select>
                <label>Position</label>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-12">
            <div class="form-floating mb-3 mb-md-0">
                <input class="form-control" value="{{ (isset($staff)) ? $staff->address : null }}" name="address" type="text" required placeholder=" " />
                <label>Address</label>
            </div>
        </div>
    </div>
    
    <hr width="104%" style="margin-left: -15px; background: #bbb">

    <div class="mt-4 mb-0">
        <div class="d-grid"><button type="submit" class="btn btn-block btn-primary">Submit</button></div>
    </div>
</form>