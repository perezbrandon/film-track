<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Film Track</title></title>

        <!-- Fonts -->
        <link href="/favicon.ico" rel="icon" type="image/x-icon" />
        <!-- Styles -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="/css/home.css">
        <link rel="stylesheet" href="/css/radiobuttons.css">

        <!-- JS -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.10.4/typeahead.bundle.min.js"></script>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/handlebars.js/2.0.0/handlebars.min.js"></script>
        <script src="/js/home.js"></script>
    </head>

    <body>
      @if(Auth::check())
          <script>
              var userID = "{{ Auth::user()->id }}";
          </script>
      @endif
      <div class="row">
        <div class="col-md-12">
          <h1 class="title">Film Track</h1>
        </div>

        <div class="row">
          <div class="col-md-12">

              @if(Session::has('message'))
                <div class="alert-danger alertmsg">
                    <p class="alert">{{ Session::get('message') }}</p>
                    <script type="text/javascript">
                      $('div.alertmsg').delay(3000).slideUp(300);
                    </script>
                </div>
              @elseif(Session::has('success'))
                <div class="alert-success alertmsg">
                  <p class="alert">{{ Session::get('success') }}</p>
                  <script type="text/javascript">
                    $('div.alertmsg').delay(3000).slideUp(300);
                  </script>
                </div>
              @endif

            </div>
          </div>
        </div>

        <hr>

      </div>
      <div class="container">
      <div class="row">
        <div class="col-md-4"><button class="btn btn-lg btn-success add-movie">Welcome, {{Auth::user()->name}}</button></div>
        <div class="col-md-4"><button type="button" class="btn btn-primary btn-lg add-movie"name="button" data-toggle="modal" data-target="#myModalHorizontal">Add Movie</button></div>
        <div class="col-md-4">
          <form class="" action="logout" method="post">
            {{ csrf_field() }}
            <button type="submit" class="btn btn-primary btn-lg add-movie"name="button" >Logout</button></div></form>
      </div>
      </div>
    <div class="content">
    <div class="row">
      <div class="col-md-4">
          <div id="exTab2" class="">
          <ul class="nav nav-tabs">
          			<li class="active"><a class="watch-tab" href="#watch" data-toggle="tab">Watch</a></li>
          			<li><a class="seen-tab" href="#seen" data-toggle="tab">Seen</a></li>
          		</ul>
          			<div class="tab-content ">
          			  <div class="tab-pane active" id="watch">
                    <ul class="list-group">
                      @foreach ($movies1 as $movie)
                      <li class="list-group-item watch" id="{{$movie->id}}">{{ $movie->title }}<span class="rating pull-right">{{$movie->year}}</span></li>
                      @endforeach
                    </ul>
          				</div>
          				<div class="tab-pane" id="seen">
                    <ul class="list-group">
                      @foreach ($movies2 as $movie)
                      <li class="list-group-item seen" id="{{$movie->id}}">{{ $movie->title }}<span class="rating pull-right">{{$movie->year}}</span></li>
                      @endforeach
                    </ul>
          				</div>
          			</div>
            </div>
      </div>
      <div class="col-md-8">
        <div class="movie-details">
          <div class="movie-details2">

          </div>

        </div>
      </div>
    </div>
    </div>


    <!-- Modal -->
<div class="modal fade" id="myModalHorizontal" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close"
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    Find a Movie
                </h4>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
              <form action="/movies" method="post">
              <div class="form-group">
                <label class="movie-search-label"for="">&nbsp;</label>
                <input type="text" class="form-control movie-search" name="title" placeholder="Search for movie.">
              </div>
              <div class="form-group yeargroup">
                <label id="label_year" style="display:none">Year</label>
                <p id="year2"></p>
                <input type="hidden" id="year" name="year" value="">
              </div>
              <div class="form-group">
                <img id="poster" src="" alt="">
                <input type="hidden" id="poster-path" name="poster_path" value="">
              </div>
              <div class="form-group">
                <label id="label_desc" style="display:none">Description</label>
                <p id="Movie-desc2"></p>
                <textarea style="display:none"class="form-control" name="description" id="Movie-desc" rows="3"></textarea>
              </div>

              <fieldset class="form-group">
                <legend>Please Select</legend>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="seen" id="optionsRadios1" value="false" checked>
                    Watch
                  </label>
                </div>
                <div class="form-check">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="seen" id="optionsRadios2" value="true">
                    Seen
                  </label>
                </div>
              </fieldset>
              {{ csrf_field() }}
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>


            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default"
                        data-dismiss="modal">
                            Close
                </button>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="myModalNorm" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close"
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    Search for a movie.
                </h4>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
              <form>
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
  </div>
  <div class="form-group">
    <label for="exampleSelect1">Example select</label>
    <select class="form-control" id="exampleSelect1">
      <option>1</option>
      <option>2</option>
      <option>3</option>
      <option>4</option>
      <option>5</option>
    </select>
  </div>
  <div class="form-group">
    <label for="exampleSelect2">Example multiple select</label>
    <select multiple class="form-control" id="exampleSelect2">
      <option>1</option>
      <option>2</option>
      <option>3</option>
      <option>4</option>
      <option>5</option>
    </select>
  </div>
  <div class="form-group">
    <label for="exampleTextarea">Example textarea</label>
    <textarea class="form-control" id="exampleTextarea" rows="3"></textarea>
  </div>
  <div class="form-group">
    <label for="exampleInputFile">File input</label>
    <input type="file" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp">
    <small id="fileHelp" class="form-text text-muted">This is some placeholder block-level help text for the above input. It's a bit lighter and easily wraps to a new line.</small>
  </div>
  <fieldset class="form-group">
    <legend>Radio buttons</legend>
    <div class="form-check">
      <label class="form-check-label">
        <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios1" value="option1" checked>
        Option one is this and that&mdash;be sure to include why it's great
      </label>
    </div>
    <div class="form-check">
    <label class="form-check-label">
        <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios2" value="option2">
        Option two can be something else and selecting it will deselect option one
      </label>
    </div>
    <div class="form-check disabled">
    <label class="form-check-label">
        <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios3" value="option3" disabled>
        Option three is disabled
      </label>
    </div>
  </fieldset>
  <div class="form-check">
    <label class="form-check-label">
      <input type="checkbox" class="form-check-input">
      Check me out
    </label>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>


            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default"
                        data-dismiss="modal">
                            Close
                </button>

            </div>
        </div>
    </div>
</div>










</body>
<script src="/js/moviesearch.js"></script>
</html>
