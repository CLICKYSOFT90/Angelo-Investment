<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MarkedCompleted;
use App\Http\Requests\StoreOfferings;
use App\Http\Requests\UpdateOfferings;
use App\Models\InvestorInvestments;
use App\Models\Offerings;
use App\Models\OfferingsDocuments;
use App\Models\OfferingsImages;
use App\Models\OfferingsVideos;
use App\Models\OfferingTypes;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserWallets;
use App\Notifications\ProfitNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\Facades\DataTables;

class OfferingsController extends Controller
{
    public function currentOffering(Request $request)
    {
        if ($request->ajax()) {
            $data = Offerings::where('offerings.is_completed', 0)->withSum('offeringInvestments','amount_invested');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('id', function ($row) {
                    return $row->id;
                })
                ->addColumn('name', function ($row) {
                    return $row->name;
                })
                ->addColumn('min_investments', function ($row) {
                    return number_format($row->min_investments);
                })
                ->addColumn('total_investments', function ($row) {
                    return number_format($row->investment_required);
                })
                ->addColumn('irr', function ($row) {
                    return $row->target_irr . '%';
                })
                ->addColumn('actual_irr', function ($row) {
                    return !empty($row->actual_irr) ? $row->actual_irr.'%' : '-';
                })
                ->addColumn('project_type', function ($row) {
                    return $row->project_type;
                })
                ->addColumn('investment_received', function ($row) {
                    return number_format($row->offering_investments_sum_amount_invested);
                })
                ->addColumn('status', function ($row) {
                    return $row->status == 1 ?
                        '<span class="badge rounded-pill  bg-label-success">Active</span>' :
                        '<span class="badge rounded-pill  bg-label-danger">Deactive</span>';
                })
                ->addColumn('completed', function ($row) {
                    return $row->investment_required == $row->offering_investments_sum_amount_invested ?
                        '<span class="badge rounded-pill  bg-label-success">Fully Funded</span>' :
                        '<span class="badge rounded-pill  bg-label-danger">Not Funded</span>';
                })
                ->addColumn('action', function ($row) {
                    $investment_link = '<a class="dropdown-item" href="' . route('admin.offerings.investments', $row->id) . '"><i class="bx bx-dollar-circle me-1"></i> Investments</a>';
                    $div = $row->is_completed == 0 ? '<a class="dropdown-item" href="' . route('admin.offerings.edit', $row->id) . '"><i class="bx bx-edit-alt me-1"></i> Edit</a>' : '';
                    $div .= $row->investment_required == $row->offering_investments_sum_amount_invested ?
                        '<a class="dropdown-item" href="'. route('admin.offerings.marked.completed', $row->id) .'"><i class="bx bx-check-double"></i> Marked As Completed</a>' :
                        '';
                    return '<div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                              <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu" style="">
                              <a class="dropdown-item" href="' . route('admin.offerings.view', $row->id) . '"><i class="bx bx-street-view me-1"></i> View</a>
                              '.$div.$investment_link.'
                            </div>
                          </div>';
                })
                ->rawColumns(['id', 'name', 'min_investments', 'total_investments', 'irr', 'actual_irr',  'project_type', 'investment_received', 'status', 'completed', 'action'])
                ->make(true);
        }
    }

    public function completedOffering(Request $request)
    {
        if ($request->ajax()) {
            $data = Offerings::where('offerings.is_completed', 1)->withSum('offeringInvestments','amount_invested');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('id', function ($row) {
                    return $row->id;
                })
                ->addColumn('name', function ($row) {
                    return $row->name;
                })
                ->addColumn('min_investments', function ($row) {
                    return number_format($row->min_investments);
                })
                ->addColumn('total_investments', function ($row) {
                    return number_format($row->investment_required);
                })
                ->addColumn('irr', function ($row) {
                    return $row->target_irr . '%';
                })
                ->addColumn('actual_irr', function ($row) {
                    return $row->actual_irr . '%';
                })
                ->addColumn('project_type', function ($row) {
                    return $row->project_type;
                })
                ->addColumn('investment_received', function ($row) {
                    return number_format($row->offering_investments_sum_amount_invested);
                })
                ->addColumn('status', function ($row) {
                    return $row->status == 1 ?
                        '<span class="badge rounded-pill  bg-label-success">Active</span>' :
                        '<span class="badge rounded-pill  bg-label-danger">Deactive</span>';
                })
                ->addColumn('completed', function ($row) {
                    return $row->is_completed == 1 ?
                        '<span class="badge rounded-pill  bg-label-success">Completed</span>' :
                        '<span class="badge rounded-pill  bg-label-danger">Not Completed</span>';
                })
                ->addColumn('action', function ($row) {
                    $investment_link = '<a class="dropdown-item" href="' . route('admin.offerings.investments', $row->id) . '"><i class="bx bx-dollar-circle me-1"></i> Investments</a>';
                    return '<div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                              <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu" style="">
                              <a class="dropdown-item" href="' . route('admin.offerings.view', $row->id) . '"><i class="bx bx-street-view me-1"></i> View</a>
                              '.$investment_link.'
                            </div>
                          </div>';
                })
                ->rawColumns(['id', 'name', 'min_investments', 'total_investments', 'irr', 'actual_irr', 'project_type', 'investment_received', 'status', 'completed', 'action'])
                ->make(true);
        }
    }

    public function offerings()
    {
        return view('admin.offerings.offerings');
    }

    public function create()
    {
        $types = OfferingTypes::where('status', 1)->get();
        return view('admin.offerings.createOfferings')->with('types', $types);
    }

    public function save(StoreOfferings $request)
    {
        $offering = new Offerings();
        $offering->slug = \Str::slug($request->name);
        $offering->name = $request->name;
        $offering->investment_type = $request->investment_type;
        $offering->project_type = $request->project_type;
        $offering->offering_types = $request->offering_type;
        $offering->min_investments = $request->min_investment;
        $offering->hold_period = $request->hold_period;
        $offering->target_irr = $request->irr;
        $offering->est_construction_completion = $request->est_completion;
        $offering->preferred_rate = $request->preferred_rate;
        $offering->investment_required = $request->total_investment;
        $offering->no_of_shares = $request->no_of_shares;
        $offering->price_per_share = $request->price_per_share;
        $offering->no_of_units = $request->no_of_units;
        $offering->address = $request->address;
        $offering->short_desc = strip_tags($request->short_desc);
        $offering->long_desc = strip_tags($request->long_desc);
        $offering->disclaimer = strip_tags($request->disclaimer);
        $offering->status = $request->status == "on" ? 1 : 0;
        $offering->created_at = Carbon::now();
        $offering->updated_at = Carbon::now();

        //Saving Offering Banner
        if ($request->hasFile('banner_img')) {
            $image = $request->file('banner_img');
            $bannername = 'offering-banner-' . uniqid() . '.' . $image->getClientOriginalExtension();
            $location = public_path('offerings/banner/' . $bannername);

            Image::make($image)->resize(1920, 648)->save($location, 60);
            $offering->offering_bg = $bannername;
        }
        $offering->save();

        //Saving Offering Gallery Images
        if ($request->hasFile('offering_images')) {
            foreach ($request->offering_images as $key => $offering_image) {
                $original_name = $offering_image->getClientOriginalName();
                $imagename = 'gallery-image-' . uniqid() . '.' . $offering_image->getClientOriginalExtension();
                $location = public_path('offerings/gallery/' . $imagename);
                Image::make($offering_image)->resize(420, 266)->save($location, 60);
                $images_data = [
                    'offerings_id' => $offering->id,
                    'image' => $imagename,
                    'image_name' => $original_name,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
                OfferingsImages::insert($images_data);
            }
        }
        //Saving Offering Videos
        if ($request->hasFile('offering_videos')) {
            foreach ($request->offering_videos as $key => $offering_video) {
                $original_name_video = $offering_video->getClientOriginalName();
                $videoName = 'video-' . uniqid() . '.' . $offering_video->extension();
                $offering_video->move(public_path('offerings/videos/'), $videoName);
                $videos_data = [
                    'offerings_id' => $offering->id,
                    'video' => $videoName,
                    'video_name' => $original_name_video,
                    'thumbnail' => '',
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
                OfferingsVideos::insert($videos_data);
            }
        }
        //Saving Offering Documents
        if ($request->hasFile('offering_docs')) {
            foreach ($request->offering_docs as $key => $offering_doc) {
                $original_name_doc = $offering_doc->getClientOriginalName();
                $docName = 'doc-' . uniqid() . '.' . $offering_doc->extension();
                $offering_doc->move(public_path('offerings/docs/'), $docName);
                $docs_data = [
                    'offerings_id' => $offering->id,
                    'documents' => $docName,
                    'document_name' => $original_name_doc,
                    'is_required' => isset($request->doc_required[$key]) == 'on' ? 1 : 0,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
                OfferingsDocuments::insert($docs_data);
            }
        }
        Session::flash('success', 'Offering Created Successfully.');
        return redirect()->back();
    }

    public function view($offering_id)
    {
        $types = OfferingTypes::where('status', 1)->get();
        $offering = Offerings::with('offeringImages', 'offeringVideos', 'offeringDocuments')->findorfail($offering_id);
        return view('admin.offerings.viewOfferings')
            ->with('types', $types)
            ->with('offering', $offering);
    }

    public function edit($offering_id)
    {
        $investments = InvestorInvestments::where('offering_id', $offering_id)->get();
        if(count($investments) > 0){
            Session::flash('alert', 'You cannot edit live offering');
            return redirect()->back();
        }
        $types = OfferingTypes::where('status', 1)->get();
        $offering = Offerings::with('offeringImages', 'offeringVideos', 'offeringDocuments')->findorfail($offering_id);
        return view('admin.offerings.editOfferings')
            ->with('types', $types)
            ->with('offering', $offering);
    }

    public function update(UpdateOfferings $request)
    {
        $offering = Offerings::findorfail($request->offering_id);
        $offering->slug = \Str::slug($request->name);
        $offering->name = $request->name;
        $offering->investment_type = $request->investment_type;
        $offering->project_type = $request->project_type;
        $offering->offering_types = $request->offering_type;
        $offering->min_investments = $request->min_investment;
        $offering->hold_period = $request->hold_period;
        $offering->target_irr = $request->irr;
        $offering->est_construction_completion = $request->est_completion;
        $offering->preferred_rate = $request->preferred_rate;
        $offering->investment_required = $request->total_investment;
        $offering->no_of_shares = $request->no_of_shares;
        $offering->price_per_share = $request->price_per_share;
        $offering->no_of_units = $request->no_of_units;
        $offering->address = $request->address;
        $offering->short_desc = strip_tags($request->short_desc);
        $offering->long_desc = strip_tags($request->long_desc);
        $offering->disclaimer = strip_tags($request->disclaimer);
        $offering->status = $request->status == "on" ? 1 : 0;
        $offering->updated_at = Carbon::now();

        //Saving Offering Banner
        if ($request->hasFile('banner_img')) {
            //Unlink the image from directory
            $file_path = public_path('/offerings/banner/') . $offering->offering_bg;
            if (file_exists($file_path)) {
                unlink($file_path);
            }
            $image = $request->file('banner_img');
            $bannername = 'offering-banner-' . uniqid() . '.' . $image->getClientOriginalExtension();
            $location = public_path('offerings/banner/' . $bannername);

            Image::make($image)->resize(1920, 648)->save($location, 60);
            $offering->offering_bg = $bannername;
        }
        $offering->save();

        //Saving Old Offering Gallery Images
        if ($request->hasFile('offering_images_old')) {
            foreach ($request->offering_images_old as $key => $offering_image) {
                $image = OfferingsImages::findorfail($request->image_ids[$key]);
                if ($image) {
                    $image_file_path = public_path('offerings/gallery/') . $image->image;
                    if (file_exists($image_file_path)) {
                        unlink($image_file_path);
                    }
                }

                $original_name = $offering_image->getClientOriginalName();
                $imagename = 'gallery-image-' . uniqid() . '.' . $offering_image->getClientOriginalExtension();
                $location = public_path('offerings/gallery/' . $imagename);
                Image::make($offering_image)->resize(420, 266)->save($location, 60);
                $images_data = [
                    'image' => $imagename,
                    'image_name' => $original_name,
                    'updated_at' => now(),
                ];
                $image->update($images_data);
            }
        }
        //Saving New Offering Gallery Images
        if ($request->hasFile('offering_images')) {
            foreach ($request->offering_images as $key => $offering_image) {
                $original_name = $offering_image->getClientOriginalName();
                $imagename = 'gallery-image-' . uniqid() . '.' . $offering_image->getClientOriginalExtension();
                $location = public_path('offerings/gallery/' . $imagename);
                Image::make($offering_image)->resize(420, 266)->save($location, 60);
                $images_data = [
                    'offerings_id' => $offering->id,
                    'image' => $imagename,
                    'image_name' => $original_name,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
                OfferingsImages::insert($images_data);
            }
        }
        //Saving Old Offering Videos
        if ($request->hasFile('offering_videos_old')) {
            foreach ($request->offering_videos_old as $key => $offering_video) {
                $video = OfferingsVideos::findorfail($request->video_ids[$key]);
                if ($video) {
                    $video_file_path = public_path('offerings/videos/') . $video->video;
                    if (file_exists($video_file_path)) {
                        unlink($video_file_path);
                    }
                }
                $original_name_video = $offering_video->getClientOriginalName();
                $videoName = 'video-' . uniqid() . '.' . $offering_video->extension();
                $offering_video->move(public_path('offerings/videos/'), $videoName);
                $videos_data = [
                    'video' => $videoName,
                    'video_name' => $original_name_video,
                    'updated_at' => now(),
                ];
                $video->update($videos_data);
            }
        }
        //Saving New Offering Videos
        if ($request->hasFile('offering_videos')) {
            foreach ($request->offering_videos as $key => $offering_video) {
                $original_name_video = $offering_video->getClientOriginalName();
                $videoName = 'video-' . uniqid() . '.' . $offering_video->extension();
                $offering_video->move(public_path('offerings/videos/'), $videoName);
                $videos_data = [
                    'offerings_id' => $offering->id,
                    'video' => $videoName,
                    'video_name' => $original_name_video,
                    'thumbnail' => '',
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
                OfferingsVideos::insert($videos_data);
            }
        }

        //Saving Old Offering Documents
        if ($request->hasFile('offering_docs_old')) {
            foreach ($request->offering_docs_old as $key => $offering_doc) {
                $doc = OfferingsDocuments::findorfail($request->doc_ids[$key]);
                if ($doc) {
                    $doc_file_path = public_path('offerings/docs/') . $doc->documents;
                    if (file_exists($doc_file_path)) {
                        unlink($doc_file_path);
                    }
                }
                $original_name_doc = $offering_doc->getClientOriginalName();
                $docName = 'doc-' . uniqid() . '.' . $offering_doc->extension();
                $offering_doc->move(public_path('offerings/docs/'), $docName);
                $docs_data = [
                    'documents' => $docName,
                    'document_name' => $original_name_doc,
                    'is_required' => isset($request->doc_required_old[$key]) == 'on' ? 1 : 0,
                    'updated_at' => now(),
                ];
                $doc->update($docs_data);
            }
        }
        //Saving New Offering Documents
        if ($request->hasFile('offering_docs')) {
            foreach ($request->offering_docs as $key => $offering_doc) {
                $original_name_doc = $offering_doc->getClientOriginalName();
                $docName = 'doc-' . uniqid() . '.' . $offering_doc->extension();
                $offering_doc->move(public_path('offerings/docs/'), $docName);
                $docs_data = [
                    'offerings_id' => $offering->id,
                    'documents' => $docName,
                    'document_name' => $original_name_doc,
                    'is_required' => isset($request->doc_required[$key]) == 'on' ? 1 : 0,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
                OfferingsDocuments::insert($docs_data);
            }
        }
        Session::flash('success', 'Offering Updated Successfully.');
        return redirect()->back();
    }

    public function delete(Request $request)
    {
        try {
            $offering = Offerings::with('offeringImages', 'offeringVideos', 'offeringDocuments')->findorfail($request->id);
            if ($offering) {

                $file_path = app_path() . '/images/news/' . $offering->offeringImages;
                unlink($file_path);
                dd("asdasd");
                $offering->delete();
                return response()->json([
                    'status' => true,
                    'message' => "Offering Successfully Deleted"
                ], 200);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => "Something went wrong"
                ], 402);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function deleteAttachments(Request $request)
    {
        try {
            if ($request->type == "image") {
                $images = OfferingsImages::find($request->id);
                //Unlink the image from directory
                $file_path = public_path('offerings/gallery/') . $images->image;
                if (file_exists($file_path)) {
                    unlink($file_path);
                }
                $images->delete();
                return response()->json([
                    'status' => true,
                    'message' => "Image Deleted Successfully"
                ], 200);
            } else if ($request->type == "video") {
                $video = OfferingsVideos::find($request->id);
                //Unlink the image from directory
                $file_path = public_path('offerings/videos/') . $video->video;
                if (file_exists($file_path)) {
                    unlink($file_path);
                }
                $video->delete();
                return response()->json([
                    'status' => true,
                    'message' => "Video Deleted Successfully"
                ], 200);
            } else {
                $doc = OfferingsDocuments::find($request->id);
                //Unlink the image from directory
                $file_path = public_path('offerings/docs/') . $doc->documents;
                if (file_exists($file_path)) {
                    unlink($file_path);
                }
                $doc->delete();
                return response()->json([
                    'status' => true,
                    'message' => "Document Deleted Successfully"
                ], 200);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function markedCompletedGet($offering_id)
    {
        $offering = Offerings::selectRaw('*, IFNULL(sum(investor_investments.amount_invested) / offerings.investment_required * 100, 0) as percentage, offerings.id as of_id')
            ->leftJoin('investor_investments', 'investor_investments.offering_id', '=' , 'offerings.id')
            ->find($offering_id);
        if($offering->percentage !== 100.0){
            Session::flash('alert', 'You cannot marked offering as completed until its 100%');
            return redirect()->back();
        }
        return view('admin.offerings.markedCompleted')->with('offering', $offering);
    }

    public function markedCompletedPost(MarkedCompleted $request)
    {
        $actual_irr = str_replace('%', '', $request->actual_irr);
        $offering = Offerings::findorfail($request->offering_id);
        $offering->is_completed = 1;
        $offering->actual_irr = $actual_irr;
        $offering->save();

        if ($offering) {
            $investor_investments = InvestorInvestments::selectRaw('*, sum(amount_invested) as total_amount_invested');
            $all_investors = $investor_investments->where('offering_id', $request->offering_id)
                ->groupBy('user_id')
                ->get();
            $user_ids = $investor_investments->pluck('user_id')->toArray();
            $users = User::whereIn('id', $user_ids)->get();
            foreach ($all_investors as $all_investor) {
                //Calculating Profit
                $profit = ($actual_irr / 100) * $all_investor->total_amount_invested;

                //ADDING THIS PROFIT IN INVESTOR WALLET
                $user_wallet = UserWallets::where('user_id', $all_investor->user_id)->first();
                $user_wallet->amount = $user_wallet->amount + $profit + $all_investor->total_amount_invested;
                $user_wallet->save();

                //Adding This Profit To Transaction
                $transaction = new Transaction();
                $transaction->user_id = $all_investor->user_id;
                $transaction->date = Carbon::now();
                $transaction->type = 'disbursement/profit';
                $transaction->amount = $profit;
                $transaction->status = 1;
                $transaction->save();

            }
            //Sending Emails to Investors About Profit
            Notification::send($users, new ProfitNotification($offering));

        }

        Session::flash('success', 'Offering Marked as Completed');
        return redirect()->route('admin.offerings');
    }

    public function removeRequired(Request $request)
    {
        try {
            $doc = OfferingsDocuments::findorfail($request->id);
            $doc->is_required = $request->status;
            $doc->save();
            return response()->json([
                'status' => true,
                'message' => 'Changed Successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function offeringInvestments(Request $request, $offering_id)
    {
        $offering = Offerings::selectRaw('*, IFNULL(sum(investor_investments.amount_invested) / offerings.investment_required * 100, 0) as percentage, offerings.id as of_id')
            ->leftJoin('investor_investments', 'investor_investments.offering_id', '=' , 'offerings.id')
            ->find($offering_id);
        return view('admin.offerings.offering-investments')->with('offering', $offering);
    }

    public function offeringInvestmentList($offering_id)
    {
        $data = InvestorInvestments::whereHas('offering', function ($query) use ($offering_id) {
            $query->where('id', $offering_id);
        })
            ->join('users', 'investor_investments.user_id', '=', 'users.id')
            ->selectRaw("investor_investments.id, CONCAT(users.first_name, ' ', users.last_name) as name, SUM(investor_investments.amount_invested) as amount_invested, SUM(investor_investments.no_of_shares) as no_of_shares")
            ->groupBy('user_id');
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('id', function ($row) {
                return $row->id;
            })
            ->addColumn('user_id', function ($row) {
                return $row->name;
            })
            ->addColumn('amount_invested', function ($row) {
                return '$'.number_format($row->amount_invested);
            })
            ->addColumn('no_of_shares', function ($row) {
                return number_format($row->no_of_shares);
            })
            ->rawColumns(['id', 'user_id', 'amount_invested', 'no_of_shares'])
            ->make();
    }

}
