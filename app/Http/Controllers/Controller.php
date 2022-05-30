<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function userRole()
    {
        $user = Auth::user();
        return $user->getRoleNames() ? $user->getRoleNames()[0] : null;
    }

    public function passwordCheck($password)
    {
        // Validate password strength
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number = preg_match('@[0-9]@', $password);

        if (!$uppercase || !$lowercase || !$number || strlen($password) < 8) {
            return false;
        } else {
            return true;
        }
    }

    public function allLocales()
    {
        return [
            [
                'code' => 'id',
                'name' => 'Bahasa Indonesia',
            ],
            [
                'code' => 'en',
                'name' => 'English',
            ],
            [
                'code' => 'cn',
                'name' => 'chinese',
            ],
        ];
    }
}
