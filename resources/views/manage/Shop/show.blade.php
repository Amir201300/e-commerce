<div class="modal fade" id="showData" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form>
                            <div class="modal-header">
                                <h5 class="modal-title" id="createModalLabel"><i class="ti-marker-alt m-r-10"></i> {{trans('main.ShowData')}} </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    
                                    <div class="col-md-6 showDetilse">
                                        <h5><i class="fa fa-check"></i>{{trans('main.name_ar')}}</h5>
                                        <p class="name_ar valueModal">System Architect</p>
                                    </div>
                                    <div class="col-md-6 showDetilse">
                                        <h5><i class="fas fa-map-marker-alt"></i>{{trans('main.status')}}</h5>
                                        <p class="status valueModal">System Architect</p>
                                    </div>
                                    <div class="col-md-12 showDetilse">
                                        <h5><span class="btn-label"><i class="far fa-envelope"></i></span> {{trans('main.name_en')}}</h5>
                                        <p class="name_en valueModal">System Architect</p>
                                    </div>
                                  
                              

                                    <div class="col-md-6 showDetilse">
                                        <h5><i class="fas fa-user"></i>{{trans('main.created_by')}}</h5>
                                        <p class="created_by valueModal">System Architect</p>
                                    </div>

                                    <div class="col-md-6 showDetilse">
                                        <h5><i class="fas fa-user"></i>{{trans('main.updated_by')}}</h5>
                                        <p class="updated_by valueModal">System Architect</p>
                                    </div>
                                
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('main.close')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>












{{-- values --}}
<div class="modal fade" id="showvalues" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        
                            <div class="modal-header">
                                <h5 class="modal-title" id="createModalLabel"><i class="ti-marker-alt m-r-10"></i> {{trans('main.ShowData')}} </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">{{trans('main.id')}}</th>
                                                <th scope="col">{{trans('main.name')}}</th>
                                                <th scope="col">{{trans('main.from')}} / {{trans('main.to')}}</th>
                                                <th scope="col">{{trans('main.type')}}</th>
                                                <th scope="col">{{trans('main.options')}}</th>
                                            </tr>
                                        </thead>
                                        <tbody id="cats">
                                     
                                          
                                        </tbody>
                                    </table>
                                </div>
                               
                                {{-- Add Button --}}
                                <button type="button" class="btn btn-info" onclick="addNewValue()">{{trans("main.AddNewDay")}}</button>
                                <br>
                                {{-- form --}}
                                    <form action="" id="formaddNewValue" style="display : none">
                                    @csrf
                                    <div class="row">
                                  <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{trans('main.day') }}</label>
                                            <select  name="day_id" class="form-control" id="day_id"  required>
                                            </select>
                                        </div>
                                    </div>
                               

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-email">{{trans('main.type') }}</label>
                                            <select  name="type" class="form-control" id="typeD"  required>
                                        <option value="1">{{trans('main.work')}}</option>
                                        <option value="0">{{trans('main.off')}}</option>
                                    </select>
                                        </div>
                                    </div>
                               
                      
                        
                                    <div class="addInputs col-md-4" >
                                        <div class="form-group">
                                            <label>{{trans('main.from') }}</label>
                                            <input type="time"  class="form-control" placeholder="{{trans('main.from')}}" name="from" id="from">
                                        </div>
                                    </div>
                                    <div class="addInputs col-md-4" >
                                        <div class="form-group">
                                            <label for="example-email">{{trans('main.to') }}</label>
                                            <input type="time"  class="form-control" placeholder="{{trans('main.to')}}" name="to" id="to">
                                        </div>
                                    </div>
                                    <div class="addInputs col-md-4" >
                                        <div class="form-group">
                                            <label for="example-email">{{trans('main.note') }}</label>
                                            <input type="text"  class="form-control" placeholder="{{trans('main.note')}}" name="note" id="note">
                                        </div>
                                    </div>
                                     <input type="hidden" name="rowId" id="rowId">
                                     <input type="hidden" name="shop_id" id="shop_id">
                                    <button type="submit" class="btn btn-secondary" id="saveValue"><i class="fa fa-spinner fa-spin" id="loadValues" style="display:none"></i>{{trans('main.save')}}</button>

                                </form>
                            </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('main.close')}}</button>
                            </div>
                        
                    </div>
                </div>
            </div>











