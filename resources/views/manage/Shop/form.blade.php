<div class="modal fade bd-example-modal-lg" id="formModel" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <form id="formSubmit">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="title"><i class="ti-marker-alt m-r-10"></i> Add new </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                  <div class="col-md-4">
                                        <div class="form-group">
                                            <label>{{trans('main.name_ar') }}</label>
                                            <input type="text" name="name_ar" id="name_ar" required class="form-control" placeholder="{{trans('main.name_ar') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="example-email">{{trans('main.name_en') }}</label>
                                            <input type="text" id="name_en" name="name_en" class="form-control"  required placeholder="{{trans('main.name_en') }}">
                                        </div>
                                    </div>
                                   
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="example-email">{{trans('main.location') }}</label>
                                            <input type="text" id="location" name="location" autocomplete="off" class="form-control"  required placeholder="{{trans('main.location') }}">
                                        </div>
                                    </div>
                                    <input type="hidden" name="lat" id="latInput">
                                    <input type="hidden" name="lang" id="lngInput">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{trans('main.desc_ar') }}</label>
                                            <textarea type="text" name="desc_ar" id="desc_ar" required class="form-control" placeholder="{{trans('main.desc_ar') }}">

                                            </textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-email">{{trans('main.desc') }}</label>
                                            <textarea type="text" name="desc_en" id="desc" required class="form-control" placeholder="{{trans('main.desc') }}">

                                            </textarea>
                                        </div>
                                    </div>
                                  <input type="hidden" name="client_id" value="{{$client_id}}" id="client_id">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>{{trans('main.subcity_id')}}</label>
                                            <select class="custom-select col-12" id="city_id" name="city_id" required>
                                                <option value="">{{trans('main.subcity_id')}}</option>
                                                @foreach($city as $row)
                                                    <option value="{{$row->id}}">{{$row->name_ar}} / {{$row->name_en}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>{{trans('main.status')}}</label>
                                            <select class="custom-select col-12" id="status" name="status" required>
                                                <option value="1">{{trans('main.Active')}}</option>
                                                <option value="0">{{trans('main.inActive')}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="example-email">{{trans('main.numOFContract') }}</label>
                                            <input type="text" id="numOFContract" name="numOFContract" class="form-control"   >
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="example-email">{{trans('main.dateEnd') }}</label>
                                            <input type="date" id="date" name="date" class="form-control"   >
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>{{trans('main.parent_id')}}</label>
                                            <select class="custom-select col-12" id="mainCatId" onchange="getCat()" name="mainCatId" >
                                                <option value="">{{trans('main.parent_id')}}</option>
                                            @foreach($Cat as $row)
                                             <option value="{{$row->id}}">{{$row->name_ar}} / {{$row->name_en}}</option>
                                             @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>{{trans('main.categoriesid')}}</label>
                                            <select class="custom-select col-12" id="subCat"  name="subCat" >
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="example-email">{{trans('main.phone') }}</label>
                                            <input type="text" id="phone" name="phone" class="form-control"  required placeholder="{{trans('main.phone') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>{{trans('main.type')}}</label>
                                            <select class="custom-select col-12" id="type" onchange="showPackage()" name="type" required>
                                                <option value="0">{{trans('main.freeOnlu')}}</option>
                                                <option value="1">{{trans('main.peruiumOnly')}}</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4" id="package" style="display : none">
                                        <div class="form-group">
                                            <label>{{trans('main.package_id')}}</label>
                                            <select class="custom-select col-12" id="package_id" onchange="showSocial()" name="package_id" >
                                                <option value="">{{trans('main.package_id')}}</option>
                                                @foreach($package as $row)
                                                    <option value="{{$row->id}}">{{$row->name_ar}} / {{$row->name_en}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div id="social" class="row" style="display : none">
                                        <div class="social col-md-4" >
                                            <div class="form-group">
                                                <label for="example-email">{{trans('main.facebook') }}</label>
                                                <input type="text" id="facebook" name="facebook" class="form-control" >
                                            </div>
                                        </div>
                                        <div class="social col-md-4">
                                            <div class="form-group">
                                                <label for="example-email">{{trans('main.snap') }}</label>
                                                <input type="text" id="snap" name="snap" class="form-control"   >
                                            </div>
                                        </div>
                                        <div class="social col-md-4">
                                            <div class="form-group">
                                                <label for="example-email">{{trans('main.instagram') }}</label>
                                                <input type="text" id="instagram" name="instagram" class="form-control"   >
                                            </div>
                                        </div>
                                        <div class="social col-md-4">
                                            <div class="form-group">
                                                <label for="example-email">{{trans('main.website') }}</label>
                                                <input type="text" id="website" name="website" class="form-control"   >
                                            </div>
                                        </div>
                                        <div class="social col-md-4">
                                            <div class="form-group">
                                                <label for="example-email">{{trans('main.whatsapp') }}</label>
                                                <input type="text" id="whatsapp" name="whatsapp" class="form-control"   >
                                            </div>
                                        </div>
                                        <div class="social col-md-4">
                                            <div class="form-group">
                                                <label for="example-email">{{trans('main.twitter') }}</label>
                                                <input type="text" id="twitter" name="twitter" class="form-control"   >
                                            </div>
                                        </div>

                                    </div>
                                    <div class="video col-md-6" style="display: none">
                                        <div class="form-group">
                                            <label for="example-email">{{trans('main.video_url') }}</label>
                                            <input type="file" id="video_url" name="video_url" class="form-control"   >
                                        </div>
                                    </div>
                                    <div class="logo col-md-6">
                                        <div class="form-group">
                                            <label for="example-email">{{trans('main.icon') }}</label>
                                            <input type="file" id="file" name="file" class="form-control"   >
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div id="err"></div>
                            <input type="hidden" name="id" id="id">
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('main.close')}}</button>
                                <button type="submit" id="save" class="btn btn-success"><i class="ti-save"></i> {{trans('main.save')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>



























            <div class="modal fade bd-example-modal-lg" id="FacilityModel" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <form id="faSubmit">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="title"><i class="ti-marker-alt m-r-10"></i> Add new </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row" id="fa">


                                </div>
                            </div>
                            <div id="err"></div>
                            <input type="hidden" name="shop_id" id="shop_id2">
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('main.close')}}</button>
                                <button type="submit" class="btn btn-success"><i class="ti-save"></i> {{trans('main.save')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>







<div class="modal fade bd-example-modal-lg" id="BrandModel" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <form id="BrandSubmit">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="title"><i class="ti-marker-alt m-r-10"></i> Add new </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row" id="ba">


                                </div>
                            </div>
                            <div id="err"></div>
                            <input type="hidden" name="shop_id" id="shop_id3">
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('main.close')}}</button>
                                <button type="submit" class="btn btn-success"><i class="ti-save"></i> {{trans('main.save')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
