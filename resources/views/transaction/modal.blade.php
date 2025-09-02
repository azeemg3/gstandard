<div class="modal fade" id="add-new">
    <div class="modal-dialog modal-lg">
        <div class="modal-content rounded-0">
            <x-modal-title title="Send Money Transaction" />
            <form id="form">
                <input type="hidden" name="id" value="0">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Receiver Branch <x-text-danger /></label>
                                <select class="select2 form-control form-control-sm" onchange="fetch_trans_fee(this)" name="to_branch_id">
                                    <option value="">Select Branch</option>
                                    {!! App\Models\Branch::dropdown() !!}
                                </select>
                            </div>
                        </div>
                        <!--col-->
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Transaction Fee %</label>
                                <input type="text" class="form-control form-control-sm"
                                    placeholder="0.00" name="transaction_fee_percent">
                            </div>
                        </div>
                        <!--col-->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Transaction Amount <x-text-danger /></label>
                                <input type="text" class="form-control form-control-sm"
                                    placeholder="Enter Transaction Amount" name="amount" id="transaction_amount">
                            </div>
                        </div>
                        <!--col-->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Transaction Fee <x-text-danger /></label>
                                <input type="text" class="form-control form-control-sm"
                                    placeholder="Enter Transaction Fee" name="transaction_fee" id="transaction_fee">
                            </div>
                        </div>
                        <!--col-->
                    </div>
                    <!--row-->
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Currency</label>
                                <select class="select2 form-control form-control-sm" name="currency_id">
                                    <option value="">Select Currency</option>
                                    {!! App\Models\Currency::dropdown() !!}
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Conversion Rate</label>
                                <input type="text" class="form-control form-control-sm"
                                    placeholder="Conversion Rate" name="conversion_rate">
                            </div>
                        </div>
                    </div>
                    <!--row-->
                    <h5>Sender Details:</h5>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Sender Name <x-text-danger /></label>
                                <input type="text" class="form-control form-control-sm sender_name"
                                    placeholder="Enter Sender Name" name="sender_details[sender_name]">
                            </div>
                        </div>
                        <!--col-->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Sender Mobile</label>
                                <input type="text" class="form-control form-control-sm sender_mobile"
                                    placeholder="Enter Sender Mobile" name="sender_details[sender_mobile]">
                            </div>
                        </div>
                        <!--col-->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Sender Location</label>
                                <input type="text" class="form-control form-control-sm sender_location"
                                    placeholder="Enter Sender Location" name="sender_details[sender_location]">
                            </div>
                        </div>
                        <!--col-->
                    </div>
                    <!--row-->
                    <h5>Receiver Details:</h5>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Receiver Name <x-text-danger /></label>
                                <input type="text" class="form-control form-control-sm receiver_name"
                                    placeholder="Enter Receiver Name" name="receiver_details[receiver_name]">
                            </div>
                        </div>
                        <!--col-->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Receiver Mobile</label>
                                <input type="text" class="form-control form-control-sm receiver_mobile"
                                    placeholder="Enter Receiver Mobile" name="receiver_details[receiver_mobile]">
                            </div>
                        </div>
                        <!--col-->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Receiver Location</label>
                                <input type="text" class="form-control form-control-sm receiver_location"
                                    placeholder="Enter Receiver Location" name="receiver_details[receiver_location]">
                            </div>
                        </div>
                        <!--col-->
                        <div class="col-md-12">
                        <textarea
                            class="form-control form-control-sm" rows="3" placeholder="Enter any additional notes"
                            name="notes"></textarea>
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
