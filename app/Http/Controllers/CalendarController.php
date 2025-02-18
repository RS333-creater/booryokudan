<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Planning;

class CalendarController extends Controller
{
    public function showCalendar()
    {
        // データベースから `sequence` カラムを取得
        $planningData = Planning::pluck('sequence'); // 'sequence' カラムのみ取得

        // 色のリスト（足りない場合は追加可能）
        $colors = ['highlight-blue', 'highlight-green', 'highlight-red', 'highlight-yellow', 'highlight-purple'];
        $colorIndex = 0; // 色の割り当てインデックス

        // 開始日～終了日のペアを作成
        $highlightedDates = $planningData
            ->map(function ($sequence) use (&$colorIndex, $colors) {
                $dates = explode(',', $sequence);
                if (count($dates) === 2) {
                    $color = $colors[$colorIndex % count($colors)]; // 色を順番に割り当て
                    $colorIndex++; // 次の色に進む

                    return [
                        'start' => trim($dates[0]),
                        'end'   => trim($dates[1]),
                        'color' => $color,
                    ];
                }
                return null;
            })
            ->filter() // null を削除
            ->values() // インデックスを整理
            ->toArray();

        return view('mypage', compact('highlightedDates'));
    }
}
