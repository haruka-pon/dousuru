<!DOCTYPE html>
{{-- <html lang="{{ str_replace('_', '-', app()->getLocale()) }}"> --}}
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--CSRFトークン対策-->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ env('APP_NAME') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="./css/destyle.css" rel="stylesheet">
    <link href="./css/style.css" rel="stylesheet">



</head>

<body>

    <header>
        <img src="../img/DOUSURU_logo.png" class="logo" alt="DOUSURU">
    </header>

    {{-- チャットデータを繰り返し表示 --}}
    @foreach ($tweets as $tweet)
        <div id="{{ $tweet->id }}" class="tweetWrapp" value="{{ $tweet->id }}">
            {{-- <p>投稿ID：{{ $tweet->id }}</p> --}}
            <p class="title">{{ $tweet->title }}</p>
            {{-- <p class="uploadDate">投稿日：{{ $tweet->created_at->format('Y/m/d H:i') }}</p> --}}
            <p class="uploadDate">投稿日：{{ $tweet->created_at->format('Y/m/d') }}</p>

            <p class="contents">
                {!! nl2br(e($tweet->contents)) !!}
            </p>

            <div class="tweetBoxWrapp">
                @foreach ($tweetDetails as $tweetDetail)
                    @if ($tweetDetail->tweet_id === $tweet->id)
                        <div class="tweetBox">
                            <label class="selectBtn selectBtn{{ $tweet->id }}" for="{{ $tweetDetail->option }}">
                                <label class="option{{ $tweet->id }} option"
                                    for="{{ $tweetDetail->option }}">{{ $tweetDetail->option }}
                                </label>


                                <label class="count{{ $tweet->id }} countNum" value="{{ $tweetDetail->count }}"
                                    name="count" for="{{ $tweetDetail->option }}">
                                    {{-- {{ $tweetDetail->count }} --}}
                                </label>

                                <input type="radio" class="radioBtn{{ $tweet->id }}" name="{{ $tweet->id }}"
                                    value="{{ $tweetDetail->count }}" id="{{ $tweetDetail->option }}"
                                    for="{{ $tweetDetail->option }}">
                                {{-- <input type="radio" @if (session('{{ $tweet->id }}')) disabled @endif
                                    class="radioBtn{{ $tweet->id }}" name="{{ $tweet->id }}"
                                    value="{{ $tweetDetail->count }}" id="{{ $tweetDetail->option }}"
                                    for="{{ $tweetDetail->option }}"> --}}
                            </label>
                        </div>
                    @endif
                @endforeach
            </div>

            <div id="totalBox">

            </div>

        </div>
    @endforeach


    </div>


    <div id="nav-wrapper" class="nav-wrapper sp">
        <div id="js-hamburger">

            <div class="pen_btn" id="pen_btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="23.37" height="23.314" viewBox="0 0 23.37 23.314">
                    <path id="Icon_awesome-pen" data-name="Icon awesome-pen"
                        d="M13.27,4.246l5.843,5.83L6.425,22.734l-5.21.574A1.094,1.094,0,0,1,.006,22.1l.58-5.2L13.27,4.246Zm9.457-.868L19.983.641a2.2,2.2,0,0,0-3.1,0L14.3,3.216l5.843,5.83L22.727,6.47a2.183,2.183,0,0,0,0-3.092Z"
                        transform="translate(0.001 -0.001)" />
                </svg>
            </div>

            <div class="close_btn hidden" id="close_btn">
                <svg xmlns="http://www.w3.org/2000/svg" height="28" viewBox="0 96 960 960" width="48"><path d="M480 642 282 840q-14 14-33 14t-33-14q-14-14-14-33t14-33l198-198-198-198q-14-14-14-33t14-33q14-14 33-14t33 14l198 198 198-198q14-14 33-14t33 14q14 14 14 33t-14 33L546 576l198 198q14 14 14 33t-14 33q-14 14-33 14t-33-14L480 642Z"/></svg>
            </div>
            {{-- <span class="hamburger__line hamburger__line--1"></span>
            <span class="hamburger__line hamburger__line--2"></span>
            <span class="hamburger__line hamburger__line--3"></span> --}}
        </div>
        {{-- 入力フォーム --}}
        <nav>
            <ul class="sp-nav">

                <form class="tweetForm" action="/tweet" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="cp_iptxt">
                        <label>タイトル</label>
                        <input class="ef" type="text" name="title" maxlength="20" required>
                        <span class="focus_line"></span>
                    </div>

                    <div class="cp_iptxt">
                        <label>本文</label>
                        <textarea class="ef textarea" name="contents" maxlength="200" rows="6" cols="40" required></textarea>
                        <span class="focus_line"></span>
                    </div>

                    <p class="select_title">選択肢</p>
                    <div class="options" id="options_0">
                        {{-- <div class="cp_iptxt"> --}}
                        <div class="option_iptxt">
                            {{-- <label>選択肢1</label> --}}
                            <input class="" type="text" name="option1" maxlength="25" placeholder="選択肢1"
                                required>
                            {{-- <input class="ef" type="text" name="option1" maxlength="20" required> --}}
                            {{-- <input id="countVal" type="hidden" name="count" value="1"> --}}
                        </div>
                    </div>

                    <div class="options" id="options">
                        {{-- <div class="cp_iptxt"> --}}
                        <div class="option_iptxt">
                            {{-- <label>選択肢2</label> --}}
                            <input class="" type="text" name="option2" maxlength="25" placeholder="選択肢2"
                                required>
                            {{-- <input class="ef" type="text" name="option1" maxlength="20" required> --}}
                            {{-- <input id="countVal" type="hidden" name="count" value="1"> --}}
                        </div>
                    </div>

                    <button id="addOption" class="addOption">+</button>

                    {{-- 送信ボタン --}}
                    <button class="uploadBtn" type="submit"><span>書き込む</span></button>
                </form>

            </ul>
        </nav>
        <div class="black-bg" id="js-black-bg"></div>
    </div>

    <script src="./js/preview.js"></script>
    <script src="js/hamburger.js"></script>
    <script src="./js/jquery-3.6.3.min.js"></script>
    <script src="./js/main.js"></script>



</body>

</html>
