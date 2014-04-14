<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title">Provide details of the new frontpages item</h4>
  </div>
  <div class="modal-body">
    <div class="form-group">
        <label for="title" class="col-lg-2 control-label">Title</label>
        <div class="col-lg-10">
          {{ Form::select('title', $posts, null, array('class'=>'form-control'))}}
        </div>
    </div>
 </div>
 <div class="modal-footer">
   <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
   <button type="submit" class="btn btn-primary">Create</button>
 </div>