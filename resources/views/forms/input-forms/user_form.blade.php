<form action="register_user" method="POST" autocomplete="off">
    @csrf
    @isset($user)
        <input type="hidden" name="id" value="{{ $user->user_id }}" />
    @endisset
    <div class="form-floating mb-3">
        <input class="form-control" value="{{ (isset($user)) ? $user->name : null }}" name="name" type="text" required placeholder=" " />
        <label>Name</label>
    </div>
    <div class="row mb-3">
        <div class="col-md-6">
            <div class="form-floating mb-3 mb-md-0">
                <input class="form-control" value="{{ (isset($user)) ? $user->username : null }}" name="username" type="text" required @if(isset($user)) readonly @endif placeholder=" " />
                <label>Username</label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-floating">
                <select class="form-control" name="user_level" required >
                    <option value="" disabled selected>User Level</option>
                    <option value="Admin" @if(isset($user) && ($user->user_level === 'Admin')) selected @endif >Admin</option>
                    <option value="User" @if(isset($user) && ($user->user_level === 'User')) selected @endif >User</option>
                </select>
                <label>User Level</label>
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-6">
            <div class="form-floating mb-3 mb-md-0">
                <select class="form-control" name="department" required placeholder=" " >
                    <option value="" disabled selected>Department</option>
                    <option value="Services" @if(isset($user) && ($user->department === 'Services')) selected @endif>Services</option>
                    <option value="Stores" @if(isset($user) && ($user->department === 'Stores')) selected @endif>Stores</option>
                </select>
                <label>Department</label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-floating mb-3 mb-md-0">
                <input class="form-control" value="{{ (isset($user)) ? $user->mobile_no : null }}" type="number" name="mobile_no" required placeholder=" " />
                <label>Personal Contact</label>
            </div>
            </div>
        </div>
    </div>

    @empty($user)
        <div class="row mb-3">
            <div class="col-md-6">
                <div class="form-floating mb-3 mb-md-0">
                    <input class="form-control" type="password" name="password" required placeholder=" " />
                    <label>Password</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating mb-3 mb-md-0">
                    <input class="form-control" type="password" name="confirm_password" required placeholder=" " />
                    <label>Confirm Password</label>
                </div>
            </div>
        </div>
    @endempty

    <hr width="104%" style="margin-left: -15px; background: #bbb">

    <div class="mt-4 mb-0">
        <div class="d-grid"><button type="submit" class="btn btn-block btn-primary">Submit</button></div>
    </div>
</form>