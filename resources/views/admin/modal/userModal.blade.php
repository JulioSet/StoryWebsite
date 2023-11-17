<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
   <div class="modal-content">
      <div class="modal-header">
         <h1 class="modal-title fs-5" id="exampleModalLabel">Edit User</h1>
         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

         <form action="{{ route('edit-user') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
               <label class="form-label">Profile</label>
               <input type="file" class="form-control" name="profile" id="profile" disabled>
            </div>

            <div class="mb-3">
               <label class="form-label">Julukan</label>
               <input type="text" class="form-control" name="title" id="title">
               <span style="color: red;">{{ $errors->first('title') }}</span>
            </div>

            <div class="mb-3">
               <label class="form-label">Username</label>
               <input type="text" class="form-control" name="username" id="username" value="">
               <span style="color: red;">{{ $errors->first('username') }}</span>
            </div>

            <div class="mb-3">
               <label class="form-label">Email</label>
               <input type="email" class="form-control" name="email" id="email" value="" disabled>
            </div>

            <div class="mb-3">
               <label class="form-label">Password</label>
               <input type="password" class="form-control" name="password" id="password" value="" disabled>
            </div>

            <div class="mb-3">
               <label class="form-label">Gender</label> <br>
               <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="gender" id="genderM" value="m" disabled>
                  <label class="form-check-label" for="inlineRadio1">Male</label>
               </div>
               <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="gender" id="genderF" value="f" disabled>
                  <label class="form-check-label" for="inlineRadio2">Female</label>
               </div> <br>
            </div>

            <div class="mb-3">
               <label class="form-label">Birthday</label>
               <input type="date" class="form-control" name="bod" id="bod" value="" disabled>
            </div>

            <div class="mb-3">
               <label class="form-label">Description</label>
               <textarea type="text" class="form-control" name="description" id="description"></textarea>
               <span style="color: red;">{{ $errors->first('description') }}</span>
            </div>

            <button type="submit" class="btn btn-primary" name="id" id="id" value="">Save changes</button>
         </form>

      </div>
   </div>
   </div>
</div>
