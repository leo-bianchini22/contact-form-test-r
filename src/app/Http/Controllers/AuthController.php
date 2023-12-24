<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function admin(Request $request)
    {
        $contacts = Contact::all();

        $gender = $contacts['gender'];
        if ($contacts->gender == 1) {
            $gender = '男性';
        } elseif ($contacts->gender == 2) {
            $gender = '女性';
        } elseif ($contacts->gender == 3) {
            $gender = 'その他';
        }
        $contacts['gender'] = $gender;

        $categories = Category::all();

        return view('admin', compact('contacts', 'categories',));
    }

    public function search(Request $request)
    {
        $contacts = Contact::with('category')->CategorySearch($request->gender)->KeywordSearch($request->keyword)->get();
        $categories = Category::all();

        return view('admin', compact('contacts', 'categories'));
    }

}
