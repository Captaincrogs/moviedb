@include('header')
<link href="css/movie.css" rel="stylesheet" />

<h1 style="padding-top:10%;"><center>Top 10 newest and best rated movies <center></h1>
@if (Auth::user())
    <h4 style=:20px;><center><strong> Welkom Back {{ Auth::user()->name }}</strong><center></h4>
@endif

@foreach($movies as $m)
<div class="movie_card" id="bright">

    <div class="info_section">
      <div class="movie_header">
          {{-- get poster from tmdb --}}
            <img src="https://image.tmdb.org/t/p/w500/{{$m->poster_path}}" alt="poster" class="locandina">
        <h2>{{$m->title }}</h2>
        <h4>{{$m->release_date}}, {{$m->tagline}}</h4>
        <span class="minutes">{{$m->runtime}} min</span>
        <p class="type">{{$m->genres}}</p>
      </div>
      <div class="movie_desc">
        <p class="text">
            {{ Str::limit($m->overview, 222)}}
        </p>
      </div>
      <div class="movie_social">
        <ul>
         
        </ul>
      </div>
    </div>
    <div class="blur_back bright_back">
        <img src="https://image.tmdb.org/t/p/w780/{{$m->backdrop_path}}" alt="poster" class="locandina">

    </div>
  </div>
  @endforeach
    
@include('footer')