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

        foreach($contacts as $contact){
            if($contact['gender'] == 1){
                $contact['gender'] = '男性';
            }elseif($contact['gender'] == 2){
                $contact['gender'] = '女性';
            } elseif ($contact['gender'] == 3) {
                $contact['gender'] = 'その他';
            }
        }

        $categories = Category::all();

        return view('admin', compact('contacts', 'categories',));
    }

    public function search(Request $request)
    {
        $contacts = Contact::with('category')->CategorySearch($request->gender)->KeywordSearch($request->keyword)->get();

        foreach ($contacts as $contact) {
            if ($contact['gender'] == 1) {
                $contact['gender'] = '男性';
            } elseif ($contact['gender'] == 2) {
                $contact['gender'] = '女性';
            } elseif ($contact['gender'] == 3) {
                $contact['gender'] = 'その他';
            }
        }

        $categories = Category::all();

        return view('admin', compact('contacts', 'categories'));
    }

}
