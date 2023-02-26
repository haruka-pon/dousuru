<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Tweet;
use App\Models\TweetDetail;
use Illuminate\Console\Application;

class TweetController extends Controller
{

    public function index(Request $request)
    {
        // データーベースの件数を取得
        $length = Tweet::all()->count();

        // 画面に表示する件数を代入
        // $display = 5;

        // 最新のチャットを画面に表示する分だけ取得して変数に代入
        // $tweets = Tweet::offset($length - $display)->limit($display)->get();
        $tweets = Tweet::all()->sortByDesc("id");

        $tweetDetails = TweetDetail::all();

        // チャットデータをビューに渡して表示
        return view('tweet/index', compact('tweets', 'tweetDetails'));
    }
    // 
    //view_countを一つカウントアップする


    public function countUp(Request $request)

    {
        // セッションにボタンが押されたことを保存
        $id  = $request->input('id');
        $request->session()->put($id, true);


        $name  = $request->input('name');
        $count = $request->input('count');

        var_dump($name);
        var_dump($count);


        // 更新
        TweetDetail::where('option', $name)->update([
            'count' => $count,
        ]);

        return response()->json([
            'message' => 'Update successful.',
        ]);

        // return redirect('/tweet');
    }


    public function store(Request $request)
    {

        $tweet = new Tweet();
        $form = $request->all();
        $tweet->fill($form)->save();
        $last_insert_id = $tweet->id;


        // for ($i = 1; $form['count'] >= $i; $i++) {
        //     TweetDetail::create([
        //         'tweet_id' => $last_insert_id,
        //         'option' => $form['option' . $i],
        //         'count' => 0
        //     ]);
        // }

        foreach ($form as $key => $value) {
            if (strpos($key, 'option') !== false) {
                TweetDetail::create([
                    'tweet_id' => $last_insert_id,
                    'option' => $value,
                    'count' => 0
                ]);
            }
        }

        // 最初の画面にリダイレクト
        return redirect('/tweet');
    }
}