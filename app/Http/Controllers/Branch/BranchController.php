<?php

namespace App\Http\Controllers\Branch;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use Illuminate\Http\Request;
use DB;
use Yajra\DataTables\DataTables;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Branch::with('company')->select('*');
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
                                <a class="dropdown-item" onClick="edit_rec(this)" data-action="'.route('branch.edit',$row->id).'" href="#" data-modal="add-new" data-id="'.$row->id.'"><i class="fas fa-edit"></i> Edit</a>
                                <a class="dropdown-item text-danger del_rec" href="#"><i class="fas fa-trash"></i> Delete</a>
                              </div>
                            </button>
                          </div>';
                    return $btn;
                })
                ->rawColumns(['action', 'checkbox'])
                ->make(true);
        }
        return view('settings.branch.index');
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
            'CID' => 'required',
            'name' => 'required',
            'branch_location' => 'required',
        ], [
            'CID.required' => 'The Country Field is required',
            'name.required' => 'The Branch Field is required',
            'branch_location.required' => 'The Branch Location Field is required',
        ]);
        DB::beginTransaction();
        $data = $request->all();
        $id = $request->id;
        try {
            if ($id == 0 || $id == '') {
                $ret = Branch::create($data);
            } else {
                $ret = Branch::where('id', $id)->update($data);
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
        $res=Branch::where('CID',$id)->get();
        return response()->json($res);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return Branch::find($id);
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
}
