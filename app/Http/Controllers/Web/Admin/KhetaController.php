<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Web\Admin\kheta\UpdateKhetaRequest;
use App\Http\Requests\Web\Admin\kheta\StoreKhetaRequest;
use App\Models\Kheta ;
use App\Models\Execution_year ;
use App\Traits\ResponseJson;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class KhetaController extends Controller
{
    use ResponseJson ;
    public function __construct(private readonly Kheta $khetaModel)
    {}
    public  function  index()
    {
        if(Auth::guard('admin')->user()->supper_admin  != 1  )
        {
            $kheta_id = Auth::guard('admin')->user()->kheta_id ;
            $ketas = $this->khetaModel->where('id' ,$kheta_id)->withCount('objectives')->get();
        }
        else
        {
            $ketas = $this->khetaModel->withCount('objectives')->get();
        }
        return view('admins.kehta.index', compact('ketas'));
    }
    public function create(): \Illuminate\View\View
    {
        return view('admins.kheta.create');
    }
    public function store(StoreKhetaRequest  $StoreKhetaRequest): \Illuminate\Http\JsonResponse
    {


        $kheta = new Kheta() ;
        $kheta->name = $StoreKhetaRequest->name ;
        if(!empty( $StoreKhetaRequest->image))
        {
            $file = $StoreKhetaRequest->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();

            // Concatenate directory path with filename to get the full path
            $fullPath = 'uploads/kheta/' . $fileName;

            $file->move(public_path('uploads/kheta'), $fileName);

            // Now you can use $fullPath to store the full path in your database or elsewhere
            // For example, you can store it in the 'image' column of your Kheta model:
            $kheta->image = $fullPath;
        }
        $kheta->save() ;

        /** Store Execution Year  */
        foreach($StoreKhetaRequest['outer-group'] as $group)
        {
            foreach($group as $sub_group)
            {
                foreach($sub_group as $year)
                {
                    $excution_year  = new Execution_year() ;
                    $excution_year->year_name = $year['years'];
                    $excution_year->kheta_id = $kheta->id;
                    $excution_year->save() ;
                }
            }
        }



        return $this->responseJson(['type' => 'success', 'message' => ' تم أضافه الخطه  بنجاح'], Response::HTTP_CREATED);
    }

    public function destroy( $kheta_id = null  ): \Illuminate\Http\RedirectResponse
    {

        $kheta = Kheta::find($kheta_id) ;
        $kheta->delete();
        return redirect()->route('dashboard.kheta.index')->with('success', ' تم  حذف الخطه  بنجاح');
    }

    public function edit($kheta_id): \Illuminate\Http\JsonResponse
    {
        $kheta = Kheta::find($kheta_id) ;
        return $this->responseJson(['data' => $kheta], Response::HTTP_OK);
    }

    public function update(UpdateKhetaRequest $UpdateKhetaRequest, $kheta_id): \Illuminate\Http\RedirectResponse
    {
        $kheta = Kheta::find($kheta_id);

        // Check if a new image is provided in the request
        if (!empty($UpdateKhetaRequest->image)) {
            // Delete the old image (optional step depending on your requirements)
            if (!empty($kheta->image)) {
                // Delete the old image file from the server
                $oldImagePath = public_path('uploads/kheta/' . $kheta->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // Upload and store the new image
            $file = $UpdateKhetaRequest->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();

            // Concatenate directory path with filename to get the full path
            $fullPath = 'uploads/kheta/' . $fileName;

            $file->move(public_path('uploads/kheta'), $fileName);

            // Now you can use $fullPath to store the full path in your database or elsewhere
            // For example, you can store it in the 'image' column of your Kheta model:
            $kheta->image = $fullPath;
        }

        // Update other attributes using validated data
        $kheta->name  = $UpdateKhetaRequest->name ;
        $kheta->save() ;
        return redirect()->route('dashboard.kheta.index')->with('success', 'تم تعديل الخطة بنجاح');
    }
}
