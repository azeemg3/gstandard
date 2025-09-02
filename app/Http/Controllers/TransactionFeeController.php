<?php

namespace App\Http\Controllers;

use App\Models\TransactionFee;
use Illuminate\Http\Request;
use DB;
use Yajra\DataTables\DataTables;

class TransactionFeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = TransactionFee::with('branch')->select('*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('checkbox', function ($row) {
                    return '<input type="checkbox" class="group-checkable" value="">';
                })
                ->addColumn('action', function ($row) {
                    $btn = '<div class="btn-group">
                            <button type="button" class="btn btn-info">Action</button>
                            <button type="button" class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                              <span class="sr-only">Toggle Dropdown</span>
                              <div class="dropdown-menu" role="menu" style="">
                                <a class="dropdown-item" onClick="edit_rec(this)" data-action="'.route('transaction-fee.edit',$row->id).'" href="#" data-modal="add-new" data-id="'.$row->id.'"><i class="fas fa-edit"></i> Edit</a>
                                <a class="dropdown-item text-danger del_rec" href="#"><i class="fas fa-trash"></i> Delete</a>
                              </div>
                            </button>
                          </div>';
                    return $btn;
                })
                ->rawColumns(['action', 'checkbox'])
                ->make(true);
        }
        return view('transaction_fee.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'branch_id' => 'required',
            'name' => 'required',
        ], [
            'branch.required' => 'The Branch Field is required',
            'name.required' => 'The Transaction Fee Field is required',
        ]);
        DB::beginTransaction();
        $data = $request->all();
        $id = $request->id;
        try {
            if ($id == 0 || $id == '') {
                $ret = TransactionFee::create($data);
            } else {
                $ret = TransactionFee::where('id', $id)->update($data);
            }
            DB::commit();
            return $ret;
        } catch (QueryException $e) {
            DB::rollBack();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $res=TransactionFee::where('CID',$id)->get();
        return response()->json($res);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return TransactionFee::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function getFeeByBranch($branchId)
    {
        $fee = TransactionFee::where('branch_id', $branchId)->first();
        if ($fee) {
            return response()->json(['fee' => $fee->name]);
        } else {
            return response()->json(['fee' => 0]);
        }
    }
}
