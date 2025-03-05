@extends('layouts.app')

@section('title', 'Discover')

@section('content')
<div class="container">
    <h1 class="mb-4 text-center">Discover Your Next Adventure</h1>
    <p class="text-center">おすすめの旅行先を発見しよう！</p>

    @guest
        <div class="alert alert-info text-center">
            <p>旅行を計画するには <a href="{{ route('login') }}">ログイン</a> してください。</p>
        </div>
    @endguest

    <div class="row justify-content-center">
        <div class="col-md-3">
            <div class="card custom-card">
                <img src="{{ asset('images/beach.jpg') }}" class="card-img-top" alt="Beach">
                <div class="card-body">
                    <h5 class="card-title">ビーチリゾート</h5>
                    <p class="card-text">美しいビーチでリラックスしましょう。</p>
                    <a href="#" class="btn btn-primary">詳細を見る</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card custom-card">
                <img src="{{ asset('images/city.jpg') }}" class="card-img-top" alt="City">
                <div class="card-body">
                    <h5 class="card-title">都市探索</h5>
                    <p class="card-text">文化やグルメを楽しむ旅行。</p>
                    <a href="#" class="btn btn-primary">詳細を見る</a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card custom-card">
                <img src="{{ asset('images/nature.jpg') }}" class="card-img-top" alt="Nature">
                <div class="card-body">
                    <h5 class="card-title">自然の冒険</h5>
                    <p class="card-text">ハイキングやキャンプを楽しもう。</p>
                    <a href="#" class="btn btn-primary">詳細を見る</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
