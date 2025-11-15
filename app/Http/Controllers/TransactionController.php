<?php

namespace App\Http\Controllers;

use App\Mail\MtchEmail;
use App\Models\Branch;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\QueryException;
use Yajra\DataTables\DataTables;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Transaction::with('receiver_branch')->select('*');
            if (!Auth::user()->hasRole('Admin')) {
                $data->where('from_branch_id', Auth::user()->branch_id);
            }
            if(Auth::user()->hasRole('Staff')){
                $data->where('created_by', Auth::user()->id);
            }
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('checkbox', function ($row) {
                    return '<input type="checkbox" class="group-checkable" value="">';
                })->addColumn('sender', function ($row) {
                    $details = json_decode($row->sender_details,true);
                    return $details['sender_name'] . " (" . $details['sender_mobile'] . ")" ?? '';
                })
                ->addColumn('receiver', function ($row) {
                    $details = json_decode($row->receiver_details,true);
                    return $details['receiver_name'] . " (" . $details['receiver_mobile'] . ")" ?? '';
                })
                ->addColumn('status', function ($row) {
                    if ($row->status == 'pending') {
                        return '<span class="badge badge-warning">Pending</span>';
                    } elseif ($row->status == 'approved') {
                        return '<span class="badge badge-success">Approved</span>';
                    } elseif ($row->status == 'cancelled') {
                        return '<span class="badge badge-danger">Cancelled</span>';
                    } else {
                        return '<span class="badge badge-secondary">' . $row->status . '</span>';
                    }
                })
                ->addColumn('action', function ($row) {
                    $btn = '<div class="btn-group">
                            <button type="button" class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                Action
                              <span class="sr-only">Toggle Dropdown</span></button>
                              <div class="dropdown-menu" role="menu" style="">
                              '.(auth()->user()->hasRole('Admin') || $row->status=='pending'?'
                                <a class="dropdown-item" onClick="edit_trans(this)" data-action="' . route('transaction.edit', $row->id) . '" href="#" data-modal="add-new" data-id="' . $row->id . '"><i class="fas fa-edit"></i> Edit</a>
                                <a class="dropdown-item text-danger del_rec" href="javascript:void(0)" data-id="' . $row->id . '" data-action="' . url('transaction') . '"><i class="fas fa-trash"></i> Delete</a>
                              ':'').'
                              
                              <a class="dropdown-item" target="_blank" href="' . route('transaction.show', $row->id) . '" data-id="' . $row->id . '"><i class="fas fa-print"></i> Print Transaction</a>
                              
                              
                              </div>

                          </div>';

                    return $btn;
                })
                ->rawColumns(['action', 'checkbox', 'status'])
                ->make(true);
        }
        return view('transaction.index');
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
            'amount' => 'required',
        ], [
            'amount.required' => 'The Transaction Field is required',
        ]);
        $sender_details = json_encode($request->sender_details);
        $receiver_details = json_encode($request->receiver_details);
        DB::beginTransaction();
        $data = $request->all();
        $data=$request->except(['transaction_fee_percent']);
        $data['sender_details'] = $sender_details;
        $data['receiver_details'] = $receiver_details;
        $data['transaction_code'] = 'MTCN-' . date('Ymd') . '-' . uniqid();
        $data['from_branch_id'] = Auth::user()->branch_id;
        $data['to_branch_id'] = $request->to_branch_id;
        $data['status'] = 'pending';
        $data['created_by'] = Auth::user()->id;
        $id = $request->id;
        try {
            if ($id == 0 || $id == '') {
                $ret = Transaction::create($data);
                $transaction_code = 'MTCN-' . date('Ymd') . '-' . $ret->id;
                Transaction::where('id', $ret->id)->update(['transaction_code' => $transaction_code]);
                $details = [
                    'subject' => 'New Transaction Notification',
                    'from_branch' =>$ret->receiver_branch->name,
                    'to_branch' => $ret->sender_branch->name,
                    'message' => 'A new transaction has been initiated with amount '.$ret->amount,
                ];
                $to_email=Branch::find($request->to_branch_id)->branch_email;
                Mail::to($to_email)->send(new MtchEmail($details));
            } else {
                $ret = Transaction::where('id', $id)->update($data);
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
        $transaction = Transaction::where('id', $id)->first();
        return view('transaction.show', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $transaction = Transaction::find($id);
        return response()->json($transaction);
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
        $transaction = Transaction::find($id);
        if ($transaction->status=='pending') {
            $transaction->delete();
            return response()->json(['message' => 'Transaction deleted successfully']);
        }
        return response()->json(['message' => 'Transaction not found'], 404);
    }
    public function updateStatus($id, $status)
    {
        $transaction = Transaction::find($id);
        if (!$transaction) {
            return response()->json(['errors' => 'Transaction not found OR Pending Transaction can not be Delivered'], 422);
        }

        $transaction->status = $status;
        $transaction->save();

        return response()->json(['message' => 'Transaction status updated successfully']);
    }
    public function rec_transaction(Request $request)
    {
        if ($request->ajax()) {
            $data = Transaction::with('receiver_branch')->select('*');
            if (!Auth::user()->hasRole('Admin')) {
                $data->where('to_branch_id', Auth::user()->branch_id);
            }
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('checkbox', function ($row) {
                    return '<input type="checkbox" class="group-checkable" value="">';
                })->addColumn('sender', function ($row) {
                    $details = json_decode($row->sender_details, true);
                    return $details['sender_name'] . " (" . $details['sender_mobile'] . ")" ?? '';
                })
                ->addColumn('receiver', function ($row) {
                    $details = json_decode($row->receiver_details, true);
                    return $details['receiver_name'] . " (" . $details['receiver_mobile'] . ")" ?? '';
                })
                ->addColumn('status', function ($row) {
                    if ($row->status == 'pending') {
                        return '<span class="badge badge-warning">Pending</span>';
                    } elseif ($row->status == 'approved') {
                        return '<span class="badge badge-success">Approved</span>';
                    } elseif ($row->status == 'cancelled') {
                        return '<span class="badge badge-danger">Cancelled</span>';
                    } else {
                        return '<span class="badge badge-secondary">' . $row->status . '</span>';
                    }
                })
                ->addColumn('action', function ($row) {
                    $btn = '<div class="btn-group">
                            <button type="button" class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                Action
                              <span class="sr-only">Toggle Dropdown</span></button>
                              <div class="dropdown-menu" role="menu" style="">
                              <a class="dropdown-item" target="_blank" href="' . route('transaction.show', $row->id) . '" data-id="' . $row->id . '"><i class="fas fa-print"></i> Print Transaction</a>
                              '.(
                                ($row->status == 'pending' && !in_array($row->status, ['approved','delivered']) && (auth()->user()->hasRole('Branch Manager') || auth()->user()->hasRole('Admin')))? '
                                    <a class="dropdown-item text-success approve_rec" href="javascript:void(0)" 
                                    data-id="' . $row->id . '" 
                                    data-action="' . route('transaction.updateStatus', [$row->id, 'approved']) . '">
                                        <i class="fas fa-check"></i> Approve
                                        </a>
                                        <a class="dropdown-item text-danger approve_rec" href="javascript:void(0)" data-id="' . $row->id . '" data-action="' . route('transaction.updateStatus', [$row->id, 'cancelled']) . '"><i class="fas fa-times"></i> Cancel</a>
                                    '
                                    : ''
                                ).'
                              
                              '.(
                                    ($row->status == 'approved' && (auth()->user()->hasRole('Admin') || auth()->user()->hasRole('Branch Manager')))? '
                                        <a class="dropdown-item text-info approve_rec" href="javascript:void(0)" 
                                        data-id="' . $row->id . '" 
                                        data-action="' . route('transaction.updateStatus', [$row->id, 'delivered']) . '">
                                            <i class="fas fa-truck"></i> Delivered
                                        </a>
                                    '
                                    : ''
                                ).'

                              </div>

                          </div>';

                    return $btn;
                })
                ->rawColumns(['action', 'checkbox', 'status'])
                ->make(true);
        }
        return view('rec_transactions.index');
    }
}
