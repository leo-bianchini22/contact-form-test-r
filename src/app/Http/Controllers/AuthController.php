<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function admin(Request $request)
    {
        $contacts = Contact::paginate(10);

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
        $contacts = Contact::with('category')->GenderSearch($request->gender)->CategorySearch($request->category_id)->CreatedSearch($request->created_at)->KeywordSearch($request->keyword)->paginate(10);

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

    public function downloadCsv()
    {
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename=contact.csv',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        $callback = function () {
            $createCsvFile = fopen('php://output', 'w');

            $columns = [
                'id',
                'category_id',
                'お名前',
                '',
                '性別',
                'メールアドレス',
                '電話番号',
                '住所',
                '建物名',
                'お問い合わせ内容',
            ];

            mb_convert_variables('SJIS-win', 'UTF-8', $columns);

            fputcsv($createCsvFile, $columns);

            $contact = DB::table('contacts');

            $contacts = $contact
                ->select(['id', 'category_id', 'first_name', 'last_name', 'gender', 'email', 'tel', 'address', 'building', 'detail'])
                ->get();

            foreach ($contacts as $contact) {
                $csv = [
                    $contact->id,
                    $contact->category_id,
                    $contact->first_name,
                    $contact->last_name,
                    $contact->gender,
                    $contact->email,
                    $contact->tel,
                    $contact->address,
                    $contact->building,
                    $contact->detail,
                ];

                mb_convert_variables('SJIS-win', 'UTF-8', $csv);

                fputcsv($createCsvFile, $csv);
            }
            fclose($createCsvFile);
        };
        return response()->stream($callback, 200, $headers);
    }

    public function reset(Request $request)
    {
        $request->input('reset') == 'reset';
        return redirect('/admin');
    }

    public function destroy(Request $request)
    {
        Contact::find($request->id)->delete();
        return redirect('/admin');
    }
}
