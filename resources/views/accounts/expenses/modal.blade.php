<div class="modal fade" id="add-new">
    <div class="modal-dialog">
        <div class="modal-content rounded-0">
            <x-modal-title title="Expenses" />
            <form id="form">
                <input type="hidden" name="id" value="0">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Date</label>
                                <input type="text" autocomplete="off" class="form-control form-control-sm date"
                                    placeholder="Date" name="date">
                            </div>
                        </div>
                        <!--col-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Branch <x-text-danger /></label>
                                <select class="select2 form-control form-control-sm"  name="branch_id">
                                    <option value="">Select Branch</option>
                                    {!! App\Models\Branch::branches() !!}
                                </select>
                            </div>
                        </div>
                        <!--col-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Expense Name</label>
                                <input type="text" class="form-control form-control-sm"
                                    placeholder="Expense Name" name="name">
                            </div>
                        </div>
                        <!--col-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Payment Method <x-text-danger /></label>
                                <select class="select2 form-control form-control-sm"  name="payment_method">
                                    <option value="">Select Payment Method</option>
                                    {!! Helpers::payment_method() !!}
                                </select>
                            </div>
                        </div>
                        <!--col-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label> Amount</label>
                                <input type="text" class="form-control form-control-sm"
                                    placeholder="Amount" name="amount">
                            </div>
                        </div>
                    </div>
                    <!--row-->
                    <div class="row">
                        <div class="col-md-12">
                            <label>Notes</label>
                            <textarea
                                class="form-control form-control-sm" rows="3" placeholder="Enter any additional notes"
                            name="note"></textarea>
                    </div>
                    </div>
                    <!--row-->
                </div>
                
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" id="submitBtn" class="btn btn-primary save">Save changes
                        <span id="spinner" class="spinner-border spinner-border-sm" style="display:none;"></span>
                    </button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
