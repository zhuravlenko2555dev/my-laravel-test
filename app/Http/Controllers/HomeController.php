<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    private $userRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->middleware('auth');
        $this->userRepository = $userRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $tokens = Auth::user()->tokens;
        $createdToken = \session()->get('createdToken', '');
        return view('home', compact('tokens', 'createdToken'));
    }

    /**
     * Create a new token.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createToken(Request $request)
    {
        $request->validate([
            'name' => 'string|nullable'
        ]);

        $createdToken = $this->userRepository->createToken(Auth::user(), $request->get('name', ''));
        \session()->flash('createdToken', $createdToken);
        return redirect('home');
    }

    /**
     * Remove the specified token.
     *
     * @param  int $token
     * @return \Illuminate\Http\Response
     */
    public function deleteToken(int $token)
    {
        $this->userRepository->deleteTokenById(Auth::user(), $token);

        return redirect('home');
    }
}
