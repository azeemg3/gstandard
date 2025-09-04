<?php
namespace App\Http\Controllers;

use App\Models\StaffSalary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class StaffSalaryController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = StaffSalary::with(['branch', 'staff'])->select('*');
            $data->where('created_by',auth()->user()->id);
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
                                <a class="dropdown-item" onClick="edit_rec(this)" data-action="'.route('staff-salaries.edit',$row->id).'" href="#" data-modal="add-new" data-id="'.$row->id.'"><i class="fas fa-edit"></i> Edit</a>
                                <a class="dropdown-item text-danger del_rec" onClick="del_rec( \''.route('staff-salaries.destroy',$row->id).'\')" href="#"><i class="fas fa-trash"></i> Delete</a>

                              </div>
                            </button>
                          </div>';
                    return $btn;
                })
                ->rawColumns(['action', 'checkbox'])
                ->make(true);
        }
        return view('accounts.staff_salaries.index');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'date' => 'required',
            'amount' => 'required|numeric',
            'payment_method' => 'required',
        ]);
        DB::beginTransaction();
        $data = $request->all();
        $data['date']=date('Y-m-d',strtotime($request->date));
        $id = $request->id;
        try {
            if ($id == 0 || $id == '') {
                $ret = StaffSalary::create($data);
            } else {
                $ret = StaffSalary::where('id', $id)->update($data);
            }
            DB::commit();
            return $ret;
        } catch (\Illuminate\Database\QueryException $e) {
            dd($e);
            DB::rollBack();
        }
    }

    public function show(string $id)
    {
        $res=StaffSalary::where('id',$id)->get();
        return response()->json($res);
    }

    public function edit(string $id)
    {
        return StaffSalary::find($id);
    }

    public function destroy(string $id)
    {
        return StaffSalary::destroy($id);
    }
}
