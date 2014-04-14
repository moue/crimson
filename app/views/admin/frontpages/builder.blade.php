@extends('admin.layouts.default')

@section('content')
  <div class="row">
    <div class="col-md-8">  
      <div class="well">
        <p class="lead"><a href="#newModal" class="btn btn-default pull-right" data-toggle="modal"><span class="glyphicon glyphicon-plus-sign"></span> new frontpages item</a> frontpages:</p>
        <div class="dd" id="nestable">
          {{ $frontpage }}
        </div>

        <p id="success-indicator" style="display:none; margin-right: 10px;">
          <span class="glyphicon glyphicon-ok"></span> frontpages order has been saved
        </p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="well">
        <p>Top Section Layout Style</p>
        {{ Form::model($layouts, ['method'=>'POST', 'action'=>['AdminFrontpagesController@postSelect']]) }}
        <div class="form-group">
          {{ Form::radio('mixed', 'recent', (Input::old('recent') == 'recent') ? true : false, array('id'=>'recent', 'class'=>'radio')) }}
          {{ Form::radio('mixed', 'custom', (Input::old('custom') == 'custom') ? true : false, array('id'=>'custom', 'class'=>'radio')) }}
        </div>
        <!-- Form Actions -->
        <div class="form-group">
          <button type="submit" class="btn btn-success">Save</button>
        </div>

        {{ Form::close() }}
      </div>
      <div class="well">
        <p>Drag items to move them in a different order</p>
      </div>
    </div>
  </div>

  <!-- Create new item Modal -->
   <div class="modal fade" id="newModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
     <div class="modal-dialog">
       <div class="modal-content">
        {{ Form::open(array('url'=>'admin/frontpages/new','class'=>'form-horizontal','role'=>'form'))}}
          
          @include('admin.frontpages.form')
        
        {{ Form::close()}}
       </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
   </div><!-- /.modal -->
  
  <!-- Delete item Modal -->
   <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
     <div class="modal-dialog">
       <div class="modal-content">
          {{ Form::open(array('url'=>'admin/frontpages/delete')) }}
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Provide details of the new frontpages item</h4>
          </div>
          <div class="modal-body">
            <p>Are you sure you want to delete this frontpages item?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <input type="hidden" name="delete_id" id="postvalue" value="" />
            <input type="submit" class="btn btn-danger" value="Delete Item" />
          </div>
          {{ Form::close(); }}
       </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
   </div><!-- /.modal -->
@stop

@section('scripts')
{{ HTML::script('vendor/nestable/jquery.nestable.js') }}
<script type="text/javascript">
$(function() {
  $('.dd').nestable({ 
    dropCallback: function(details) {
       
       var order = new Array();
       $("li[data-id='"+details.destId +"']").find('ol:first').children().each(function(index,elem) {
         order[index] = $(elem).attr('data-id');
       });

       if (order.length === 0){
        var rootOrder = new Array();
        $("#nestable > ol > li").each(function(index,elem) {
          rootOrder[index] = $(elem).attr('data-id');
        });
       }

       $.post('{{url("admin/frontpages/")}}', 
        { source : details.sourceId, 
          destination: details.destId, 
          order:JSON.stringify(order),
          rootOrder:JSON.stringify(rootOrder) 
        }, 
        function(data) {
         // console.log('data '+data); 
        })
       .done(function() { 
          $( "#success-indicator" ).fadeIn(100).delay(1000).fadeOut();
       })
       .fail(function() {  })
       .always(function() {  });
     }
   });

  $('.delete_toggle').each(function(index,elem) {
      $(elem).click(function(e){
        e.preventDefault();
        $('#postvalue').attr('value',$(elem).attr('rel'));
        $('#deleteModal').modal('toggle');
      });
  });



});
</script>
@endsection

