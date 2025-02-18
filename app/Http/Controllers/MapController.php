<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Facility;
use App\Models\Trip;
use App\Models\Planning;


class MapController extends Controller
{
    public function index(Request $request)
    {
        $facility = Facility::all();
        $Addres = $request->query("Addres");

        return view('map/index', compact('facility', 'Addres'));
    }

    public function reserve(Request $request)
    {
        $facility = Facility::all();
        $Addres = $request->query("Addres");

        // クエリパラメータから施設情報を取得
        $facilities = [];
        $facilityNames = $request->query('facility', []);

        // クエリパラメータから施設情報を配列に格納
        foreach ($facilityNames as $facility) {
            $facilities[] = [
                'name' => $facility['name'],
                'price' => $facility['price'],
                'lat' => $facility['lat'],
                'lng' => $facility['lng']
            ];
        }

        // 合計金額の計算
        $totalPrice = $request->query('totalPrice', 0);

        // 予約ページのビューにデータを渡す
        return view("map/reserve", compact('facility', 'Addres', 'facilities', 'totalPrice'));
    }

    public function checkout(Request $request)
    {
        $facility = Facility::all();
        $Addres = $request->query("Addres");

        // クエリパラメータから施設情報を取得
        $facilities = [];
        $facilityNames = $request->query('facility', []);

        // クエリパラメータから施設情報を配列に格納
        foreach ($facilityNames as $facility) {
            $facilities[] = [
                'name' => $facility['name'],
                'price' => $facility['price'],
                'lat' => $facility['lat'],
                'lng' => $facility['lng']
            ];
        }

        // 合計金額の計算
        $totalPrice = $request->query('totalPrice', 0);

        // 予約ページのビューにデータを渡す
        return view("map/checkout", compact('facility', 'Addres', 'facilities', 'totalPrice'));
    }

    public function submit(Request $request)
    {
        \Log::info('Request Data:', $request->all());
        
        // クエリパラメータから施設情報を取得
        $facilities = $request->input('facility', []);
        
        if (empty($facilities)) {
            return back()->with('error', '施設情報がありません');
        }
        
        // 最初と最後の施設を取得
        $start_point = $facilities[0]['name'] ?? null;
        $end_point = end($facilities)['name'] ?? null;
        $departureDate = $request->input('departureDate');
        $returnDate = $request->input('returnDate');
        
        // 新規の trip を作成
        $trip = new Trip();
        $trip->start_point = $start_point; // ここで start_point を設定
        $trip->end_point = $end_point; // 必要なら end_point も設定
        $trip->user_id = 1; // 必要なら user_id も設定
        $trip->save();
        $tripId = $trip->id; // 作成した trip の ID を取得
        
        // 日付のフォーマットが不正な場合、修正を行います
        $startDate = \Carbon\Carbon::parse($departureDate); // 出発日を Carbon インスタンスに変換
        $endDate = \Carbon\Carbon::parse($returnDate); // 返却日を Carbon インスタンスに変換
        
        // 出発日と返却日が同じ場合、1つの日付として格納
        if ($startDate->equalTo($endDate)) {
            $sequence = $startDate->format('Y-m-d'); // 1つの日付だけを格納
        } else {
            $sequence = $startDate->format('Y-m-d') . ',' . $endDate->format('Y-m-d'); // 異なる日付ならカンマ区切りで格納
        }
        
        // planning テーブルにデータを挿入
        $planning = new Planning();
        $planning->trip_id = $tripId; // 作成した trip_id を設定
        $planning->sequence = $sequence; // 作成した日付のシーケンスを設定
        $planning->save();
        
        
        return redirect('/mypage')->with('success', '旅行情報を登録しました！');
    }
    
    

    

}
