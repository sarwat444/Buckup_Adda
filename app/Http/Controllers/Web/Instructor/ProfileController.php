<?php

namespace App\Http\Controllers\Web\Instructor;

use App\Http\Requests\Web\Instructor\Profile\NewEmailForVerificationRequest;
use App\Http\Requests\Web\Instructor\Profile\UpdateInstructorProfileRequest;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Auth\Access\AuthorizationException;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Profile;

class ProfileController extends Controller
{

    public function __construct(private readonly Profile $profileModel)
    {
    }

    /**
     * @throws AuthorizationException
     */
    public function index(): \Illuminate\Contracts\View\View
    {
        $this->authorize('index', $this->profileModel);
        $rateInfo = DB::table('rates')->select(DB::raw('count(*) as total_student_rated, avg(rate) as avg_rate'))
            ->where('rates.rateable_type', 'App\Models\Course')->whereIn('rates.rateable_id', auth()->user()->courses()->pluck('id')->toArray())->first();
        return view('instructors.profile.index', compact('rateInfo'));
    }

    /**
     * @throws AuthorizationException
     */
    public function edit(): \Illuminate\Contracts\View\View
    {
        $this->authorize('edit', $this->profileModel);
        return view('instructors.profile.edit');
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

    public function update(UpdateInstructorProfileRequest $updateInstructorProfileRequest): \Illuminate\Http\RedirectResponse
    {
        if ($updateInstructorProfileRequest->filled('password')) {
            auth()->user()->update(['password' => $updateInstructorProfileRequest->validated()['password']]);
        }

        if ($updateInstructorProfileRequest->hasFile('image')) {
            auth()->user()->addMediaFromRequest('image')->toMediaCollection('profile');
        }

        return back()->with('success', 'Profile updated successfully');
    }

}
