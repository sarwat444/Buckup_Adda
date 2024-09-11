<?php

namespace App\Http\Controllers\Apis\site\Instructor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\Instructor\StoreInstructorRequest;
use App\Http\Requests\Web\Instructor\Profile\NewEmailForVerificationRequest;
use App\Models\InstructorRequest;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Symfony\Component\HttpFoundation\Response;
use App\Traits\ResponseJson;

class InstructorRequestController extends Controller
{
    use ResponseJson ;
    public function __construct(private readonly InstructorRequest $instructorRequest)
    {
    }
    // Store Instractor Request To Become Instractor

    public function store(StoreInstructorRequest $storeInstructorRequest): \Illuminate\Http\JsonResponse
    {
        $instructorRequest = auth()->user()->instructorRequest()->create($storeInstructorRequest->safe()->except('attachment'));
        $instructorRequest->addMediaFromRequest('attachment')->toMediaCollection('instructors-request-attachment');
        return $this->responseJson(['messages' => 'Your request has been sent successfully'] , Response::HTTP_OK) ;
    }

    public function sendNewEmailVerificationNotification(NewEmailForVerificationRequest $newEmailForVerificationRequest): \Illuminate\Http\RedirectResponse
    {
        auth()->user()->update(['email' => $newEmailForVerificationRequest->validated('email'), 'email_verified_at' => null]);
        auth()->user()->sendEmailVerificationNotification();
        return back()->with('success', 'Email verification link sent to your email address');
    }

    public function verifyEmail(EmailVerificationRequest $emailVerificationRequest): \Illuminate\Http\RedirectResponse
    {
        $emailVerificationRequest->fulfill();
        return to_route('dashboard.instructors.profile.edit')->with('success', 'Email verified successfully');
    }


}
