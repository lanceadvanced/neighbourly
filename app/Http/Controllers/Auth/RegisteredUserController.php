<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{

    /**
     * Display the registration view.
     *
     * @return View
     */
    public function create(): View
    {
        return view('register');
    }
    /**
     * Handle an incoming registration request.
     *
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phone' => [ 'string', 'max:255', 'nullable'],
            'contact-email' => [ 'string', 'max:255', 'nullable'],
        ]);

        $user = [
            'name' => $request->get('email'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password'))
        ];

        $user = User::create($user);

        $account = [
            'firstname' => $request->get('firstname'),
            'lastname' => $request->get('lastname'),
            'color' => '#'.str_pad(dechex(rand(0, 255)), 2, "0", STR_PAD_LEFT).str_pad(dechex(rand(0, 255)), 2, "0", STR_PAD_LEFT).str_pad(dechex(rand(0, 255)), 2, "0", STR_PAD_LEFT),
            'phone' => $request->get('phone'),
            'email' => $request->get('email'),
            'fk_userID' => $user->getKey()
        ];

        Account::create($account);

        event(new Registered($user));

        Auth::login($user);

        return redirect('/');
    }
}
