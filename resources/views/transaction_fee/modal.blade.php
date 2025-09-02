<div class="modal fade" id="add-new">
    <div class="modal-dialog">
        <div class="modal-content rounded-0">
            <x-modal-title title="Transaction Fee" />
            <form id="form">
                <input type="hidden" name="id" value="0">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Branch <x-text-danger /></label>
                                <select class="select2 form-control form-control-sm" name="branch_id">
                                    <option value="">Select Branch</option>
                                    {!! App\Models\Branch::dropdown() !!}
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Transaction Fee <x-text-danger /></label>
                                <input type="text" class="form-control form-control-sm"
                                    placeholder="5%" name="name">
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
