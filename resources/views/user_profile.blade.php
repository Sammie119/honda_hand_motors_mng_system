<div class="modal fade" id="getProfile" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">User Profile</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{ route('user_profile') }}" method="POST" autocomplete="off">
            @csrf
            <input type="hidden" value="{{ Auth()->user()->user_id }}" name="id">
            <div class="form-floating mb-3">
                <input class="form-control" value="{{ Auth()->user()->name }}" name="name" type="text" required placeholder=" " />
                <label>Name</label>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="form-floating mb-3 mb-md-0">
                        <input class="form-control" value="{{ Auth()->user()->username }}" name="username" type="text" required @if(isset($user)) readonly @endif placeholder=" " />
                        <label>Username</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <select class="form-control" name="user_level" required >
                            <option selected>{{ Auth()->user()->user_level }}</option>
                        </select>
                        <label>User Level</label>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="form-floating mb-3 mb-md-0">
                        <select class="form-control" name="department" required placeholder=" " >
                            <option selected>{{ Auth()->user()->department }}</option>
                        </select>
                        <label>Department</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating mb-3 mb-md-0">
                        <input class="form-control" value="{{ Auth()->user()->mobile_no }}" type="number" name="mobile_no" required placeholder=" " />
                        <label>Personal Contact</label>
                    </div>
                  </div>
                </div>
  
                <div class="row mb-3">
                    <div class="col-md-6">
                      <div class="form-floating mb-3 mb-md-0">
                          <input class="form-control" type="password" name="password" placeholder=" " />
                          <label>Password</label>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-floating mb-3 mb-md-0">
                          <input class="form-control" type="password" name="confirm_password" placeholder=" " />
                          <label>Confirm Password</label>
                      </div>
                    </div>
                </div>
    
            </div>
        
            <div class="mt-1 mb-4 round-0">
                <div class="d-grid"><button type="submit" class="btn btn-block btn-primary rounded-0">Submit</button></div>
            </div>
          </form>
        </div>
        {{-- <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div> --}}
      </div>
    </div>
  </div>