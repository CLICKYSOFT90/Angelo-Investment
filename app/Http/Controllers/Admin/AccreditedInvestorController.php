<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\AccreditedApprovalMail;
use App\Models\User;
use App\Notifications\AccreditedApprovalNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class AccreditedInvestorController extends Controller
{
    public function accreditedUser()
    {
        return view('admin.accreditedUser.accredited_investor');
    }

    public function currentAccreditedInvestor(Request $request)
    {
        if ($request->ajax()) {
            $data = User::where(['accredited_investor' => 2, 'role_id' => 2]);
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('id', function ($row) {
                    return $row->id;
                })
                ->addColumn('name', function ($row) {
                    $div = '<div class="d-flex justify-content-start align-items-center user-name">
                                <div class="avatar-wrapper">
                                    <div class="avatar me-2">
                                        <img src="'.$row->image.'" alt="Avatar" class="rounded-circle">
                                    </div>
                                </div>
                                <div class="d-flex flex-column">
                                    <span class="emp_name text-truncate">'.$row->name.'</span>
                                </div>
                            </div>';
                    return $div;
                })
                ->addColumn('email', function ($row) {
                    return $row->email;
                })
                ->addColumn('date_joined', function ($row) {
                    return date('d-M-Y', strtotime($row->created_at));
                })
                ->addColumn('accredited_investor', function ($row) {
                    return $row->accredited_investor == 1 ?
                        '<span class="badge rounded-pill  bg-label-success">Yes</span>' :
                        '<span class="badge rounded-pill  bg-label-warning">No</span>';
                })
                ->addColumn('username', function ($row) {
                    return $row->username;
                })
                ->addColumn('phone', function ($row) {
                    return $row->phone ?: '-';
                })
                ->addColumn('recieve_digi_updates', function ($row) {
                    return $row->recieve_digi_updates == 1 ?
                        '<span class="badge rounded-pill  bg-label-success">Yes</span>' :
                        '<span class="badge rounded-pill  bg-label-warning">No</span>';
                })
                ->addColumn('tax_filled', function ($row) {
                    return $row->is_tax_form == 1 ?
                        '<span class="badge rounded-pill  bg-label-success">Yes</span>' :
                        '<span class="badge rounded-pill  bg-label-warning">No</span>';
                })
                ->addColumn('status', function ($row) {
                    return $row->status == 1 ?
                        '<span class="badge rounded-pill  bg-label-success">Active</span>' :
                        '<span class="badge rounded-pill  bg-label-warning">Disabled</span>';
                })
                ->addColumn('accredited_investor_approval', function ($row) {
                    if($row->accredited_investor == 1){
                        return '<span class="badge rounded-pill  bg-label-success">Yes</span>';
                    } elseif ($row->accredited_investor == 2){
                        return '<span class="badge rounded-pill  bg-label-warning">Pending</span>';
                    } else{
                        return '<span class="badge rounded-pill  bg-label-warning">No</span>';
                    }
                })
                ->addColumn('action', function ($row) {
                    return '<div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                              <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu" style="">
                              <a class="dropdown-item" href="' . route('admin.accredited.view', $row->id) . '"><i class="bx bx-street-view me-1"></i> View</a>
                            </div>
                          </div>';
                })
                ->rawColumns(['id', 'name', 'email', 'username', 'date_joined', 'accredited_investor', 'recieve_digi_updates', 'tax_filled', 'status', 'accredited_investor_approval', 'action'])
                ->make(true);
        }
    }

    public function view($user_id)
    {
        $user = User::where('id', $user_id)->with('userDocs')->first();
        return view('admin.accreditedUser.viewAccreditedInvestor')->with('user', $user);
    }

    public function storeApproval(Request $request)
    {
        $user = User::findorfail($request->user_id);
        $user->accredited_investor = isset($request->approve_disapprove) == 'on' ? 1 : 0;
        $user->save();

        $user->notify((new AccreditedApprovalNotification($request->all()))->delay(now()->addSecond(5)));

        $msg = isset($request->approve_disapprove) == 'on' ? 'Request Approved Successfully' : 'Request Rejected Successfully';
        Session::flash('success', $msg);
        return redirect()->route('admin.users');
    }
}
