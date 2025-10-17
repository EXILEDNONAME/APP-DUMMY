<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse|JsonResponse
    {
        $request->validate(['email' => 'required|email']);

        $email = $request->email;

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($request->expectsJson() || $request->ajax()) {
            if ($status === Password::RESET_LINK_SENT) {
                return response()->json(['status' => __($status)], 200);
            } else {
                return response()->json([
                    'errors' => ['email' => [__($status)]],
                ], 422);
            }
        }

        if ($status === Password::RESET_LINK_SENT) {
            return back()->with([
                'status' => __($status),
                'email' => $email
            ]);
        }

    }
}
