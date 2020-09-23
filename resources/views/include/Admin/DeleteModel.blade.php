<div class="modal fade" id="DeleteModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{trans('main.DeleteContact')}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" style="text-align:center;">
          <img class="rounded-circle" src="/manage/assets/images/trash.png" width="45">
          <h5 style="padding: 20px;">{{trans('main.sureDelete')}}</h5>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('main.no')}}</button>
          <button type="button" class="btn btn-danger" id="deleteYse" onclick="yesDelete()">{{trans('main.yes')}}</button>
        </div>
      </div>
    </div>
  </div>








  <div class="modal fade" id="DeleteModel2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{trans('main.DeleteContact')}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" style="text-align:center;">
          <img class="rounded-circle" src="/manage/assets/images/trash.png" width="45">
          <h5 style="padding: 20px;">{{trans('main.sureDelete')}}</h5>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('main.no')}}</button>
          <button type="button" class="btn btn-danger" id="deleteYse" onclick="yesDelete2()">{{trans('main.yes')}}</button>
        </div>
      </div>
    </div>
  </div>