<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.auth');
    }

    /**
     * Handle an incoming authentication request.
     */
  public function store(Request $request)
{
    $request->validate([
        'login' => 'required|string',
        'password' => 'required|string',
    ]);

    // detect login field (email or phone)
    $field = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

    if (!Auth::attempt([$field => $request->login, 'password' => $request->password], $request->boolean('remember'))) {
        return back()
            ->withErrors(['login' => 'Invalid credentials.'])
            ->withInput()
            ->with('tab', 'login');     // <<< keeps login tab open after failure
    }

    $request->session()->regenerate();
    return redirect()->intended('dashboard');
}


  /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
