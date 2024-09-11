<?php

namespace App\Http\Controllers\Apis\site\Instructor;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use  App\Http\Requests\Apis\{InstractorRegesteration ,SaveBankDetails} ;
use Symfony\Component\HttpFoundation\Response;
use App\Models\InstractorDetails ;
use App\Traits\ResponseJson;

class InsteractorRegesterationController extends Controller
{
    use  ResponseJson ;

    public function store(InstractorRegesteration $instractorRegesteration):\Illuminate\Http\JsonResponse
    {
        try {
          $instructorresterationRequest = auth()->user()->instractorDetails()->create($instractorRegesteration->validated()) ;
          return $this->responseJson(['messages' => 'Your Data Has Been Saved successfully'] , Response::HTTP_OK) ;
        } catch (Exception $e) {
            return $this->sendError('Validation Error  .', 'Something Wrong Happen');
        }
    }

   public  function  savebankdetails(SaveBankDetails $SaveBankDetails)
   {
       try {
           auth()->user()->bankdetails()->create($SaveBankDetails->validated()) ;
           return $this->responseJson(['messages' => 'Your Data Has Been Saved successfully'] , Response::HTTP_OK) ;
       }
       catch (\Exception $e)
       {
           dd($e) ;
           return $this->sendError('Validation Error' ,  'Something Went Wrong') ;
       }


   }

}
