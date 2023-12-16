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
        $contacts = Contact::simplePaginate(10);
        $categories = Category::all();

        return view('admin', compact('contacts', 'categories',));
    }

    public function find()
    {
        $contacts = Contact::all();
        $categories = Category::all();

        return view('admin', compact('contacts', 'categories'));
    }
    public function search(Request $request)
    {
        $contacts = Contact::with('category')->categorySearch($request->category_id)->keywordSearch($request->keyword)->get();
        $categories = Category::all();

        return view('admin', compact('contacts', 'categories'));
    }
}
