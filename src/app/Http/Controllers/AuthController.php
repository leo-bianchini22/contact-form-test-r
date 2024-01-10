<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\StreamedResponse;

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

    // public function downloadCsv()
    // {
    //     $headers = [
    //         'Content-Type' => 'text/csv',
    //         'Content-Disposition' => 'attachment; filename=contact.csv',
    //         'Pragma' => 'no-cache',
    //         'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
    //         'Expires' => '0',
    //     ];

    //     $callback = function () {
    //         $createCsvFile = fopen('php://output', 'w');

    //         $columns = [
    //             'id',
    //             'category_id',
    //             'お名前',
    //             '',
    //             '性別',
    //             'メールアドレス',
    //             '電話番号',
    //             '住所',
    //             '建物名',
    //             'お問い合わせ内容',
    //         ];

    //         mb_convert_variables('SJIS-win', 'UTF-8', $columns);

    //         fputcsv($createCsvFile, $columns);

    //         $contact = DB::table('contacts');

    //         $contacts = $contact
    //             ->select(['id', 'category_id', 'first_name', 'last_name', 'gender', 'email', 'tel', 'address', 'building', 'detail'])
    //             ->get();

    //         foreach ($contacts as $contact) {
    //             $csv = [
    //                 $contact->id,
    //                 $contact->category_id,
    //                 $contact->first_name,
    //                 $contact->last_name,
    //                 $contact->gender,
    //                 $contact->email,
    //                 $contact->tel,
    //                 $contact->address,
    //                 $contact->building,
    //                 $contact->detail,
    //             ];

    //             mb_convert_variables('SJIS-win', 'UTF-8', $csv);

    //             fputcsv($createCsvFile, $csv);
    //         }
    //         fclose($createCsvFile);
    //     };
    //     return response()->stream($callback, 200, $headers);
    // }

    public function export(Request $request)
    {
        $query = Contact::query();

        $query = $this->getSearchQuery($request, $query);

        $csvData = $query->get()->toArray();

        $csvHeader = [
            'id', 'category_id', 'first_name', 'last_name', 'gender', 'email', 'tell', 'address', 'building', 'detail', 'created_at', 'updated_at'
        ];

        $response = new StreamedResponse(function () use ($csvHeader, $csvData) {
            $createCsvFile = fopen('php://output', 'w');

            mb_convert_variables('SJIS-win', 'UTF-8', $csvHeader);

            fputcsv($createCsvFile, $csvHeader);

            foreach ($csvData as $csv) {
                $csv['created_at'] = Date::make($csv['created_at'])->setTimezone('Asia/Tokyo')->format('Y/m/d H:i:s');
                $csv['updated_at'] = Date::make($csv['updated_at'])->setTimezone('Asia/Tokyo')->format('Y/m/d H:i:s');
                fputcsv($createCsvFile, $csv);
            }

            fclose($createCsvFile);
        }, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="contacts.csv"',
        ]);

        return $response;
    }

    private function getSearchQuery($request, $query)
    {
        if (!empty($request->keyword)) {
            $query->where(function ($q) use ($request) {
                $q->where('first_name', 'like', '%' . $request->keyword . '%')
                    ->orWhere('last_name', 'like', '%' . $request->keyword . '%')
                    ->orWhere('email', 'like', '%' . $request->keyword . '%');
            });
        }

        if (!empty($request->gender)) {
            $query->where('gender', '=', $request->gender);
        }

        if (!empty($request->category_id)) {
            $query->where('category_id', '=', $request->category_id);
        }

        if (!empty($request->date)) {
            $query->whereDate('created_at', '=', $request->date);
        }

        return $query;
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
