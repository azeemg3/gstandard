@extends('layout.master')
@section('mytitle', 'Business Settings')
@section('content')
@php
$breadcrumb[] = ['title' => 'Home'];
$breadcrumb[] = ['title' => 'Settings'];
$breadcrumb[] = ['title' => __('settings.all_permission')];
@endphp
<x-content-header :breadcrumb="$breadcrumb" />
<section class="content">
    <div class="container-fluid">
        <div class="card card-primary card-outline">
            <div class="card-body">
                <div class="col-md-12">
                    @if(Session::has('message'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-check"></i> Alert!</h5>
                        {{ Session::get('message') }}
                    </div>
                </div>
                @endif
                <div class="card-header">
                    <h3>Role:{{ $role }}</h3>
                </div>
                <div class="row">
                    <div class="table-responsive">
                        <form method="POST" action="{{ route('permission.store') }}">
                            @CSRF
                            <input type="hidden" name="role_id" value="{{ $id }}">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>{{ __('settings.modules') }}</th>
                                        <th>{{ __('settings.select_all') }}</th>
                                        <th>{{ __('settings.permission') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Application Settings</td>
                                        <td>
                                            <div class="form-group clearfix">
                                                <div class="icheck-primary d-inline select_all">
                                                    <input type="checkbox" id="application_setting_all">
                                                    <label for="application_setting_all">Select All</label>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group clearfix selected_all">
                                                <div class="icheck-warning d-inline">
                                                    <input name="permission[]" type="checkbox"
                                                        id="application_setting_view" value="application_setting_view" @if(in_array('application_setting_view',$permissions)) checked @endif>
                                                    <label for="application_setting_view">View</label>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('settings.user') }}</td>
                                        <td>
                                            <div class="form-group clearfix select_all">
                                                <div class="icheck-primary d-inline">
                                                    <input type="checkbox" id="user_select_all">
                                                    <label for="user_select_all">{{ __('settings.select_all') }}</label>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group clearfix selected_all">
                                                <div class="icheck-primary d-inline">
                                                    <input name="permission[]" type="checkbox" id="user_add" value="user_add" @if(in_array('user_add',$permissions)) checked @endif>
                                                    <label for="user_add">Add</label>
                                                </div>
                                                <div class="icheck-primary d-inline">
                                                    <input name="permission[]" type="checkbox" id="user_edit" value="user_edit" @if(in_array('user_edit',$permissions)) checked @endif>
                                                    <label for="user_edit">Edit</label>
                                                </div>
                                                <div class="icheck-warning d-inline">
                                                    <input name="permission[]" type="checkbox" id="user_view" value="user_view" @if(in_array('user_view',$permissions)) checked @endif>
                                                    <label for="user_view">View</label>
                                                </div>
                                                <div class="icheck-danger d-inline">
                                                    <input name="permission[]" type="checkbox" id="user_delete" value="user_delete" @if(in_array('user_delete',$permissions)) checked @endif>
                                                    <label for="user_delete">Delete</label>
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('settings.role') }}</td>
                                        <td>
                                            <div class="form-group clearfix">
                                                <div class="icheck-primary d-inline select_all">
                                                    <input type="checkbox" id="role_select_all">
                                                    <label for="role_select_all">Select All</label>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group clearfix selected_all">
                                                <div class="icheck-primary d-inline">
                                                    <input name="permission[]" type="checkbox" id="role_add" value="role_add" @if(in_array('role_add',$permissions)) checked @endif>
                                                    <label for="role_add">Add</label>
                                                </div>
                                                <div class="icheck-primary d-inline">
                                                    <input name="permission[]" type="checkbox" id="role_edit" value="role_edit" @if(in_array('role_edit',$permissions)) checked @endif>
                                                    <label for="role_edit">Edit</label>
                                                </div>
                                                <div class="icheck-warning d-inline">
                                                    <input name="permission[]" type="checkbox" id="role_view" value="role_view" @if(in_array('role_view',$permissions)) checked @endif>
                                                    <label for="role_view">View</label>
                                                </div>
                                                <div class="icheck-danger d-inline">
                                                    <input name="permission[]" type="checkbox" id="role_delete" value="role_delete" @if(in_array('role_delete',$permissions)) checked @endif>
                                                    <label for="role_delete">Delete</label>
                                                </div>
                                                <div class="icheck-success d-inline">
                                                    <input name="permission[]" type="checkbox"
                                                        id="role_assign_permission" value="role_assign_permission" @if(in_array('role_assign_permission',$permissions)) checked @endif>
                                                    <label for="role_assign_permission">Assign Permission</label>
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Transaction Fee</td>
                                        <td>
                                            <div class="form-group clearfix">
                                                <div class="icheck-primary d-inline select_all">
                                                    <input type="checkbox" id="mtms_select_all">
                                                    <label for="mtms_select_all">Select All</label>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group clearfix selected_all">
                                                <div class="icheck-primary d-inline">
                                                    <input name="permission[]" type="checkbox" id="transaction_fee_add" value="transaction_fee_add" @if(in_array('transaction_fee_add',$permissions)) checked @endif>
                                                    <label for="transaction_fee_add">Add</label>
                                                </div>
                                                <div class="icheck-primary d-inline">
                                                    <input name="permission[]" type="checkbox" id="transaction_fee_edit" value="transaction_fee_edit" @if(in_array('transaction_fee_edit',$permissions)) checked @endif>
                                                    <label for="transaction_fee_edit">Edit</label>
                                                </div>
                                                <div class="icheck-warning d-inline">
                                                    <input name="permission[]" type="checkbox" id="transaction_fee_view" value="transaction_fee_view" @if(in_array('transaction_fee_view',$permissions)) checked @endif>
                                                    <label for="transaction_fee_view">View</label>
                                                </div>
                                                <div class="icheck-danger d-inline">
                                                    <input name="permission[]" type="checkbox" id="transaction_fee_delete" value="transaction_fee_delete" @if(in_array('transaction_fee_delete',$permissions)) checked @endif>
                                                    <label for="transaction_fee_delete">Delete</label>
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Transaction</td>
                                        <td>
                                            <div class="form-group clearfix">
                                                <div class="icheck-primary d-inline select_all">
                                                    <input type="checkbox" id="mtms_select_all">
                                                    <label for="mtms_select_all">Select All</label>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group clearfix selected_all">
                                                <div class="icheck-primary d-inline">
                                                    <input name="permission[]" type="checkbox" id="transaction_add" value="transaction_add" @if(in_array('transaction_add',$permissions)) checked @endif>
                                                    <label for="transaction_add">Add</label>
                                                </div>
                                                <div class="icheck-primary d-inline">
                                                    <input name="permission[]" type="checkbox" id="transaction_edit" value="transaction_edit" @if(in_array('transaction_edit',$permissions)) checked @endif>
                                                    <label for="transaction_edit">Edit</label>
                                                </div>
                                                <div class="icheck-warning d-inline">
                                                    <input name="permission[]" type="checkbox" id="transaction_view" value="transaction_view" @if(in_array('transaction_view',$permissions)) checked @endif>
                                                    <label for="transaction_view">View</label>
                                                </div>
                                                <div class="icheck-danger d-inline">
                                                    <input name="permission[]" type="checkbox" id="transaction_delete" value="transaction_delete" @if(in_array('transaction_delete',$permissions)) checked @endif>
                                                    <label for="transaction_delete">Delete</label>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Reports</td>
                                        <td>
                                            <div class="form-group clearfix">
                                                <div class="icheck-primary d-inline select_all">
                                                    <input type="checkbox" id="mtms_select_all">
                                                    <label for="mtms_select_all">Select All</label>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group clearfix selected_all">
                                                <div class="icheck-primary d-inline">
                                                    <input name="permission[]" type="checkbox" id="profit_report" value="profit_report" @if(in_array('profit_report',$permissions)) checked @endif>
                                                    <label for="profit_report">Profit Report</label>
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Business Setup</td>
                                        <td>
                                            <div class="form-group clearfix select_all">
                                                <div class="icheck-primary d-inline">
                                                    <input type="checkbox" id="business_setup_all">
                                                    <label for="business_setup_all">Select All</label>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group clearfix selected_all">
                                                <div class="icheck-primary d-inline">
                                                    <input type="checkbox" name="permission[]" id="bs_add" value="bs_add" @if(in_array('bs_add',$permissions)) checked @endif>
                                                    <label for="bs_add">Add</label>
                                                </div>
                                                <div class="icheck-primary d-inline">
                                                    <input type="checkbox" name="permission[]" id="bs_edit" value="bs_edit" @if(in_array('bs_edit',$permissions)) checked @endif>
                                                    <label for="bs_edit">Edit</label>
                                                </div>
                                                <div class="icheck-warning d-inline">
                                                    <input type="checkbox" name="permission[]" id="bs_view" value="bs_view" @if(in_array('bs_view',$permissions)) checked @endif>
                                                    <label for="bs_view">View</label>
                                                </div>
                                                <div class="icheck-danger d-inline">
                                                    <input type="checkbox" name="permission[]" id="bs_delete" value="bs_delete" @if(in_array('bs_delete',$permissions)) checked @endif>
                                                    <label for="bs_delete">Delete</label>
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('settings.country') }}</td>
                                        <td>
                                            <div class="form-group clearfix select_all">
                                                <div class="icheck-primary d-inline">
                                                    <input type="checkbox" id="country_select_all">
                                                    <label
                                                        for="country_select_all">{{ __('settings.select_all') }}</label>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group clearfix selected_all">
                                                <div class="icheck-primary d-inline">
                                                    <input type="checkbox" name="permission[]" id="country_add" value="country_add" @if(in_array('country_add',$permissions)) checked @endif>
                                                    <label for="country_add">Add</label>
                                                </div>
                                                <div class="icheck-primary d-inline">
                                                    <input type="checkbox" name="permission[]" id="country_edit" value="country_edit" @if(in_array('country_edit',$permissions)) checked @endif>
                                                    <label for="country_edit">Edit</label>
                                                </div>
                                                <div class="icheck-warning d-inline">
                                                    <input type="checkbox" name="permission[]" id="country_view" value="country_view" @if(in_array('country_view',$permissions)) checked @endif>
                                                    <label for="country_view">View</label>
                                                </div>
                                                <div class="icheck-danger d-inline">
                                                    <input type="checkbox" name="permission[]"
                                                        id="country_delete" value="country_delete" @if(in_array('country_delete',$permissions)) checked @endif>
                                                    <label for="country_delete">Delete</label>
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>City</td>
                                        <td>
                                            <div class="form-group clearfix select_all">
                                                <div class="icheck-primary d-inline">
                                                    <input type="checkbox" id="city_select_all">
                                                    <label
                                                        for="city_select_all">{{ __('settings.select_all') }}</label>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group clearfix selected_all">
                                                <div class="icheck-primary d-inline">
                                                    <input type="checkbox" name="permission[]" id="city_add" value="city_add" @if(in_array('city_add',$permissions)) checked @endif>
                                                    <label for="city_add">Add</label>
                                                </div>
                                                <div class="icheck-primary d-inline">
                                                    <input type="checkbox" name="permission[]" id="city_edit" value="city_edit" @if(in_array('city_edit',$permissions)) checked @endif>
                                                    <label for="city_edit">Edit</label>
                                                </div>
                                                <div class="icheck-warning d-inline">
                                                    <input type="checkbox" name="permission[]" id="city_view" value="city_view" @if(in_array('city_view',$permissions)) checked @endif>
                                                    <label for="city_view">View</label>
                                                </div>
                                                <div class="icheck-danger d-inline">
                                                    <input type="checkbox" name="permission[]" id="city_delete" value="city_delete" @if(in_array('city_delete',$permissions)) checked @endif>
                                                    <label for="city_delete">Delete</label>
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Staff Salaries</td>
                                        <td>
                                            <div class="form-group clearfix select_all">
                                                <div class="icheck-primary d-inline">
                                                    <input type="checkbox" id="staff_salary_select_all">
                                                    <label for="staff_salary_select_all">{{ __('settings.select_all') }}</label>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group clearfix selected_all">
                                                <div class="icheck-primary d-inline">
                                                    <input type="checkbox" name="permission[]" id="staff_salary_add" value="staff_salary_add" @if(in_array('staff_salary_add',$permissions)) checked @endif>
                                                    <label for="staff_salary_add">Add</label>
                                                </div>
                                                <div class="icheck-primary d-inline">
                                                    <input type="checkbox" name="permission[]" id="staff_salary_edit" value="staff_salary_edit" @if(in_array('staff_salary_edit',$permissions)) checked @endif>
                                                    <label for="staff_salary_edit">Edit</label>
                                                </div>
                                                <div class="icheck-warning d-inline">
                                                    <input type="checkbox" name="permission[]" id="staff_salary_view" value="staff_salary_view" @if(in_array('staff_salary_view',$permissions)) checked @endif>
                                                    <label for="staff_salary_view">View</label>
                                                </div>
                                                <div class="icheck-danger d-inline">
                                                    <input type="checkbox" name="permission[]" id="staff_salary_delete" value="staff_salary_delete" @if(in_array('staff_salary_delete',$permissions)) checked @endif>
                                                    <label for="staff_salary_delete">Delete</label>
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Expenses</td>
                                        <td>
                                            <div class="form-group clearfix select_all">
                                                <div class="icheck-primary d-inline">
                                                    <input type="checkbox" id="expense_select_all">
                                                    <label for="expense_select_all">{{ __('settings.select_all') }}</label>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group clearfix selected_all">
                                                <div class="icheck-primary d-inline">
                                                    <input type="checkbox" name="permission[]" id="expense_add" value="expense_add" @if(in_array('expense_add',$permissions)) checked @endif>
                                                    <label for="expense_add">Add</label>
                                                </div>
                                                <div class="icheck-primary d-inline">
                                                    <input type="checkbox" name="permission[]" id="expense_edit" value="expense_edit" @if(in_array('expense_edit',$permissions)) checked @endif>
                                                    <label for="expense_edit">Edit</label>
                                                </div>
                                                <div class="icheck-warning d-inline">
                                                    <input type="checkbox" name="permission[]" id="expense_view" value="expense_view" @if(in_array('expense_view',$permissions)) checked @endif>
                                                    <label for="expense_view">View</label>
                                                </div>
                                                <div class="icheck-danger d-inline">
                                                    <input type="checkbox" name="permission[]" id="expense_delete" value="expense_delete" @if(in_array('expense_delete',$permissions)) checked @endif>
                                                    <label for="expense_delete">Delete</label>
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-success float-right"><i class="fa fa-save"></i> Save</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.container-fluid -->
</section>
@include('settings.permission.js_func')
@endsection