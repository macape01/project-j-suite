<?php
namespace App\Http\Controllers;

use App\Mail\TestMail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SendEmailController extends Controller
{
    public function ship(Request $request)
    {
        $valueArray = [
        	'name' => 'John',
        ];
        
        try {
            \Mail::to('example@gmail.com')->send(new TestMail($valueArray));
            echo 'Mail send successfully';
        } catch (\Exception $e) {
            echo 'Error - '.$e;
        }
    }
}