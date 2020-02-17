@section('confirm-styles')
div#confirmModal div.modal-content{border:none;box-shadow:0 0.25rem 0.5rem rgba(0,0,0,.5);}
div#confirmModal div.modal-header{border-bottom:none;}
div#confirmModal div.modal-footer{border-top:none;padding:0.35rem}
div#confirmModal div.modal-footer > button{text-transform:uppercase;color:#6c757d;transition: box-shadow .2s cubic-bezier(.4,0,1,1),background-color .2s cubic-bezier(.4,0,.2,1),color .2s cubic-bezier(.4,0,.2,1);will-change:box-shadow,transform;}
div#confirmModal div.modal-footer > button:active {background-size: 100%;transition: background 0s;}
div#confirmModal div.modal-footer > button:hover{background-color:hsla(0,0%,60%,.2);}
div#confirmModal div.modal-footer > button#confirmButton{color:#622c84;}
@endsection
@section('confirm')
<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header pb-0">
        <h5 class="modal-title" id="confirmModalLabel">{{$title}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>{{$text}}</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn" id="confirmButton">Aceptar</button>
      </div>
    </div>
  </div>
</div>
@endsection
