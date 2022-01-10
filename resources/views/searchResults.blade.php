<html>
	<head> 
	 <meta charset="UTF-8"> 
	 <title>Movie|Search</title> 
	 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"> 
	 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css"> 
	 <link rel="stylesheet" href="{{asset('css/movie.css')}}">
	<link rel="stylesheet" href="{{asset('css/searchResults.css')}}">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> 
	 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> 
	 <style type="text/css">
	   .modal-content iframe{
		   margin: 0 auto;
		   display: block;
		   /* make a round border */
	   }
   </style> 
	</head>
<br><br>
<header>
    <div class="wrap">
		{{-- href button --}}
		<a href="{{route('movies')}}" class="logo">
      <button href="{{route('home')}}" class="button">Go back</button>
	</a>

    </div>
</header>


{{-- display searched for keyword --}}
{{-- no results go back --}}

@if(count($movies) == 0)
	<h1 style="color:red;"><center>No results found try again<center></h1>
@else	
<div class="search-results">
	only display first 1 result
	<h1 style="color:red;"><center>Search reslults for:<center></h1>
</div>
@endif

@foreach($movies as $m)
<div class="movie_card" id="bright">
    <div class="info_section">
      <div class="movie_header">
          {{-- get poster from tmdb --}}
            <img src="https://image.tmdb.org/t/p/w500/{{$m->poster_path}}" alt="poster" class="locandina">
        <h2>{{$m->title }}</h2>
        <h4>{{$m->release_date}}</h4>
        <span class="minutes">min</span>
        <p class="type">hgh</p>
      </div>
	  
      <div class="movie_desc">
        <p class="text">
            {{ Str::limit($m->overview, 222)}}
        </p>
      </div>
	
      <div class="movie_social">
        <ul>
			<li><i class="material-icons">share</i></li>
			<li><i class="material-icons">thumb_up</i></li>
			<li><i class="material-icons">favorite_border</i></li>
			<li><i class="material-icons">bookmark_border</i></li>
			<li><a href="#myModal" class="btn btn-danger" data-toggle="modal">Watch trailer</a> </li>
			<li><a href="{{route('movies/stream')}}" class="btn btn-danger">Stream movie</a> </li>
        </ul>
      </div>
    </div>
    <div class="blur_back bright_back">
        <img src="https://image.tmdb.org/t/p/w780/{{$m->backdrop_path}}" alt="poster" class="locandina">
    </div>
  </div>
  <div id="myModal" class="modal fade"> 
	<div class="modal-dialog"> 
		<div class="modal-content"> 
		@if(isset($m->trailer->key))
			<iframe width="853" height="505" src="https://www.youtube.com/embed/{{$m->trailer->key}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
		@endif
		</div>
	</div>
   </div>		
@endforeach


<script type="text/javascript">
$(document).ready(function(){
	$('.movie_card').click(function(){
		var id = $(this).attr('id');
		$('#modal_body').load('/movie/'+$id);
		$('#myModal').modal('show');
	});
});

</script> 
  
</html>

 
