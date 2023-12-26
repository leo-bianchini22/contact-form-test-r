<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Http\Requests\ContactRequest;
use App\Models\Category;

class ContactController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $contacts = Contact::all();

        return view('index', compact('contacts', 'categories'));
    }

    public function confirm(ContactRequest $request)
    {
        $contact = $request->only([
            'category_id',
            'first_name',
            'last_name',
            'gender',
            'email',
            'address',
            'building',
            'detail',
            'content'
        ]);

        $tel = $request->only([
            'tel1',
            'tel2',
            'tel3'
        ]);

        $categories = $request->all();

        return view('confirm', compact('contact','tel', 'categories',));
    }

    public function store(ContactRequest $request)
    {
        $contact = $request->only([
            'category_id',
            'first_name',
            'last_name',
            'email',
            'tel',
            'address',
            'building',
            'detail',
            'content'
        ]);

        $gender = $request['gender'];
        if($gender == '男性'){
            $gender = 1;
        }elseif($gender == '女性'){
            $gender = 2;
        }elseif($gender == 'その他'){
            $gender = 3;
        }

        $category_id = $request['category_id'];
        if ($category_id == '商品のお届けについて') {
            $category_id = 1;
        } elseif ($category_id == '商品の交換について') {
            $category_id = 2;
        } elseif ($category_id == '商品トラブル') {
            $category_id = 3;
        } elseif ($category_id == 'ショップへのお問い合わせ') {
            $category_id = 4;
        }

        $contact['category_id'] = $category_id;
        $contact['gender'] = $gender;
        Contact::create($contact);

        return view('thanks');
    }
}
