<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;

use Validator;
use Response;
use Session;


class MovieController extends Controller
{


    protected $redirectPath = '/login';

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getMoiveList(Request $request){

      //echo Auth::id();
      $movies1 = [];
      $movies2 = [];
      $i = 0;
      $user = User::find(Auth::User()->id);
      foreach ($user->movies as $movie) {
        if($movie->pivot->haswatched == "true"){
          $movies2[$i++] = $movie;
        }
        else{
          $movies1[$i++] = $movie;

        }
      }


      //$movies1 = Movie::where('seen','false')->orderBy('created_at', 'desc')->paginate(5, ['*'], 'watch'); // movies to watch
      //$movies2 = Movie::where('seen','true')->orderBy('created_at', 'desc')->paginate(5, ['*'], 'seen'); // movies seen already

      return view('practicehome')->withMovies1($movies1)->withMovies2($movies2);

    }


    public function addMovie(Request $request){


      $this->validate($request, array(
            'title'         => 'required|max:60',
            'year'          => 'required|integer',
            'description'   => 'required',
            'poster_path'   => 'required|url',
            'seen'          => 'required'
        ));

      //TODO:: FIX so that movies cant be inserted twice into the same list for the user
      $movieid  = Movie::where('poster_path', $request->poster_path)->exists();
      if($movieid != null){
        $movieid  = Movie::where('poster_path', $request->poster_path)->first()->id;
        if(DB::table('movie_user')->where('user_id', Auth::User()->id)->where('movie_id', $movieid)->exists()){
          Session::flash('message','The moive '.$request->title.' already exists in your list!');
          return redirect('/');
        }

      }

      if (Movie::where('poster_path', $request->poster_path)->exists()) {
          $movieid  = Movie::where('poster_path', $request->poster_path)->first()->id;
          $userid =  Auth::User()->id;

          DB::table('movie_user')->insert(
          array('user_id' => $userid,
                'movie_id' => $movieid,
                'haswatched' => $request->seen,)
          );
          Session::flash('success','The moive '.$request->title.' has been added to your list!');
          return redirect('/');

      }
      else{
        $movie = new Movie;
        $movie->title = $request->title;
        $movie->year = $request->year;
        $movie->description = $request->description;
        $movie->poster_path = $request->poster_path;
        $movie->seen = $request->seen;
        $movie->save();

        $movieid  = $movie->id;
        $userid =  Auth::User()->id;

        DB::table('movie_user')->insert(
        array('user_id' => $userid,
              'movie_id' => $movieid,
              'haswatched' => $request->seen,)
        );

        Session::flash('success','The moive '.$request->title.' has been added to your list!');
        return redirect('/');
      }

    }


    public function getMovieInfo(Request $request){
       $movieID = $request->movieID;
       $haswatched = DB::table('movie_user')->where('user_id', Auth::User()->id)->where('movie_id', $movieID)->pluck('haswatched');
       $movie = Movie::where('id',$movieID)->get();
       $movie[1] = $haswatched[0];
       return Response::json($movie);
    }


    public function deleteMovie(Request $request){
      $movieID = $request->movieID;
      DB::table('movie_user')->where('user_id', Auth::User()->id)->where('movie_id', $movieID)->delete();
      return redirect('/');
    }

    public function setMovieSeen(Request $request){
      $movieID = $request->movieID;
      $movieSeen = $request->movieSeen;
      DB::table('movie_user')->where('user_id', Auth::User()->id)->where('movie_id', $movieID)->update(array('haswatched' => $movieSeen));
    }

}
