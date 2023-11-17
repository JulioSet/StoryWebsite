<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
   <div class="modal-content">
      <div class="modal-header">
         <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Feed</h1>
         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
         
         <form action="{{ route('edit-feed') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
               <label class="form-label">Thumbnail</label>
               <input type="file" class="form-control" name="image" id="image" disabled>
            </div>

            <div class="mb-3">
               <label class="form-label">Title</label>
               <input type="text" class="form-control" name="title" id="title" placeholder="Title" value="">
               <span style="color: red;">{{ $errors->first('title') }}</span>
            </div>
            
            <div class="mb-3">
               <label class="form-label">Duration</label>
               <input type="text" class="form-control" name="duration" id="duration" placeholder="Duration(Minutes)" value="" disabled>
            </div>
            
            <div class="mb-3">
               <label class="form-label">Description</label>
               <textarea class="form-control" name="description" id="description" rows="3" placeholder="Description"></textarea>
               <span style="color: red;">{{ $errors->first('description') }}</span>
            </div>
            
            <div class="mb-3">
               <label class="form-label">Content</label>
               <textarea class="form-control" name="story" id="story" rows="5" placeholder="Story" disabled></textarea>
            </div>

            <button type="submit" class="btn btn-primary mt-1" name="id" id="id" value="">Save changes</button>
         </form>
      
      </div>
   </div>
   </div>
</div>