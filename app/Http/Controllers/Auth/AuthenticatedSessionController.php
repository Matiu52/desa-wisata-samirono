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
        return view('auth.login');
    }

    public function createAdmin(): View
    {
        return view('auth.login-admin');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        return $this->handleLogin($request, 'user');
    }

    public function storeAdmin(LoginRequest $request): RedirectResponse
    {
        return $this->handleLogin($request, 'admin');
    }

    /**
     * Handle login logic for both user and admin.
     */
    private function handleLogin(LoginRequest $request, string $type): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        if ($type === 'admin' && Auth::user()->role_id !== 1) {
            Auth::logout();
            return redirect()->route('admin.login')->withErrors([
                'email' => 'Anda tidak memiliki akses sebagai admin.',
            ]);
        }

        if ($type === 'user' && Auth::user()->role_id === 1) {
            Auth::logout();
            return redirect()->route('login')->withErrors([
                'email' => 'Admin tidak dapat login melalui halaman ini.',
            ]);
        }

        return $type === 'admin'
            ? redirect()->route('dashboard')
            : redirect()->intended(route('dashboard', absolute: false));
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
