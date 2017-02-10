
$( document ).ready(function() {


    // go to the tab that was last selected
    var lastTab = localStorage.getItem('lastTab');
    if (lastTab) { $('[href="' + lastTab + '"]').tab('show'); }

    $(".watch, .seen").unbind('click').bind('click', function() {
      var movieID = $(this).attr ( "id" );
      $(".watch, .seen").removeClass('selected-movie');
      $(this).addClass('selected-movie');
      $.get('/movieInfo',{movieID : movieID}, movieInfoCallback);
    });

    //save last tab left off on to localstorage
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
      // save the latest tab;
      localStorage.setItem('lastTab', $(this).attr('href'));
    });
    //switch seen it to watch or vice versa
    $('.movie-details').on('click', '[name=seenit]', function() {
      var id = "{{ Auth::user()->id }}";
      console.log("this is the user!!! ->>>"+id);
      var movieID = $(this).attr( "movieID" ); var movieSeen = $(this).attr( "value" );
      $.get('/movieseen', { movieID:movieID , movieSeen:movieSeen});
      //console.log($(this).attr('value'));
      location.reload();
    });

    //  if the search bar is blank get rid of previous movie details
    $('.movie-search').on('keydown', function(){
      if(!$(this).val()){
        $('#label_year').css("display","none");
        $('#label_desc').css("display","none");
        $('#year2').html("");
        $('#Movie-desc2').html("");
        $('#poster').attr('src', "");
      }
    });


});


//dynamically puts all the info of the movie in movie-details div when the LI element is clicked
function movieInfoCallback(data){
  $('.movie-details2').html("");
  $('#movie-placeholder').html("");
  var seen,watch;
  if(data[1] == "true"){
      seen = "checked";
      watch ="";
    }
    else{
      seen ="";
      watch = "checked";
    }
  var movie_see
  var arr = [];
  arr.push("<div class='row movie-title-row'><div class='col-md-12'><h1 class='movie-title'>"+data[0].title +"</h1><h3 class='movie-year'> &nbsp;- "+data[0].year+"</h3></div></div>");
  arr.push("<div class='row'><div class='col-md-6'><img src='"+data[0].poster_path+"'></div><div class='col-md-6'><h4 class='movie-descrip'>Description:</h4><p class='movie-descrip'>"
  +data[0].description+"</p><div class='movie-buttons'><div class='switch-field'></div><form action='/removemovie' method='POST'><input type='hidden' name='movieID' value='"
  +data[0].id+"'></div></div></div>");

  var i = 0;
  while(i < arr.length){
    $(".movie-details2").append(arr[i++]);
  }
  $(".movie-details2 form").append("<input type='hidden' name='_token' value='"+$('meta[name="csrf-token"]').attr('content')+"' />");
  $(".movie-details2 form").append($("<button>",{type:"submit", class: "btn btn-md btn-danger delete_button", html:"remove"}))
  $(".movie-details2 .switch-field").append("<input type='radio' id='switch_left' movieID="+data[0].id+"' name='seenit' value='false' "+watch+" /><label for='switch_left'>Watch</label>");
  $(".movie-details2 .switch-field").append("<input type='radio' id='switch_right' movieID="+data[0].id+"' name='seenit' value='true' "+seen+"/><label for='switch_right'>Seen</label>");
}
