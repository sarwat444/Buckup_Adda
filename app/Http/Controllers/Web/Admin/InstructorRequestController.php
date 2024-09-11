<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Requests\Web\Admin\Instructor\UpdateInstructorStatus;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Exceptions\Exception;
use App\Http\Controllers\Controller;
use App\Models\InstructorRequest;
use App\Traits\ResponseJson;

class InstructorRequestController extends Controller
{
    use ResponseJson;

    public function __construct(private readonly InstructorRequest $instructorRequest)
    {
    }
    public function index(): \Illuminate\View\View
    {
        return view('admins.instructors-requests.index');
    }
    /**
     * @throws Exception
     */
    public function instructorRequestDatatables(): \Illuminate\Http\JsonResponse
    {
        $instructorRequest = $this->instructorRequest->with(['user', 'media']);


        return datatables()->eloquent($instructorRequest)
            ->addIndexColumn()
            ->addColumn('actions', function ($instructorRequest) {
                return view('admins.instructors-requests.datatable.actions', compact('instructorRequest'))->render();
            })->addColumn('View_Details', function ($instructorRequest) {
                return '<a href='.route('dashboard.instructors.requests.view-details' ,$instructorRequest).' class="btn btn-primary" target="_blank">Details</a>';
            })->addColumn('attachment', function ($instructorRequest) {
                return '<a href="' . $instructorRequest->getFirstMediaUrl('instructors-request-attachment') . '" class="btn btn-primary" target="_blank">Attachment</a>';
            })->rawColumns(['actions', 'View_Details' , 'attachment' ])->toJson();
    }

    public function updateStatus(UpdateInstructorStatus $updateInstructorStatus, InstructorRequest $instructorRequest): \Illuminate\Http\JsonResponse
    {
        $instructorRequest->update($updateInstructorStatus->validated());
        return $this->responseJson(['type' => 'success', 'message' => 'request status updated successfully'], Response::HTTP_OK);
    }
    public  function instractorDetails($id=null): \Illuminate\View\View
    {
        $instractorData = $this->instructorRequest->with(['user' , 'user.instractorDetails' , 'user.bankdetails'])->where(['id'=>$id])->first() ;
        return view('admins.instructors-requests.instractor_details' , with(compact('instractorData')));
    }
}
