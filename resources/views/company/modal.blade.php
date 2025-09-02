<div class="modal fade" id="add-new">
    <div class="modal-dialog">
        <div class="modal-content rounded-0">
            <x-modal-title title="{{ __('settings.company_details') }}" />
            <form id="form">
                <input type="hidden" name="id" value="0">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>{{ __('settings.company_name') }} <x-text-danger /></label>
                                <input type="text" class="form-control form-control-sm"
                                    placeholder="{{ __('company_name') }}" name="name">
                            </div>
                        </div>
                    </div>
                    <!--row-->
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary save">Save changes</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
