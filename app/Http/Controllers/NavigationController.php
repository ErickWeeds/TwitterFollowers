<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Abraham\TwitterOAuth\TwitterOAuth;
class NavigationController extends Controller
{
    public function index(){
      $user = session('tw_user');
      if(is_null($user)){
        return redirect()->to('login/twitter');
      }
      return view('welcome')->with('user',$user);
    }
    /**
    * Open a Twitter API instance to get all data
    */
    public function followers(Request $r){
      $user = session('tw_user');
      if(is_null($user)){
        return redirect()->to('login/twitter');
      }
      $connection = $this->getConnectionWithAccessToken(session('auth_token'), session('auth_token_secret'));
      $content1 = null;
      $content2 = null;
      if($r->has('next_following')){
        $next_following = $r->input('next_following');
        if($next_following!=0){
          $content2 = $connection->get("friends/list",["count"=>200,"cursor"=>$next_following]);
        }else{
          $content2 = $connection->get("friends/list",["count"=>200]);
        }
      }else{
        $content2 = $connection->get("friends/list",["count"=>200]);
      }
      if($r->has('next_followers')){
        $next_following = $r->input('next_followers');
        if($next_following!=0){
          $content1 = $connection->get("followers/ids",["stringify_ids" => true,"count"=>5000]);
        }else{
          $content1 = $connection->get("followers/ids",["stringify_ids" => true,"count"=>5000]);
        }
      }else{
        $content1 = $connection->get("followers/ids",["stringify_ids" => true,"count"=>5000]);
      }
      $followers = $content1->ids; //People following to the current User
      $following = $content2->users;//Returns a cursored collection of user objects for every user the specified user is following (otherwise known as their “friends”).
      $next_cursor_friends = $content2->next_cursor;
      $back_cursor_friends = $content2->previous_cursor;
      $friends= array();
      $cursor = array(
        "previous_followers"=>$content1->previous_cursor,
        "next_followers"=>$content1->next_cursor,
        "previous_following"=>$content2->previous_cursor,
        "next_following"=>$content2->next_cursor
      );
      foreach($following as $f){
          foreach($followers as $ids){
            if($f->id_str == "".$ids){
              $friends[] = $f;
            }
          }
      }
      return view('table')->with('friends',$friends)->with('cursor',$cursor)->with('user',$user);
    }
    public function getConnectionWithAccessToken($oauth_token, $oauth_token_secret) {
      $connection = new TwitterOAuth(env('TWITTER_CLIENT'), env('TWITTER_SECRET'), $oauth_token, $oauth_token_secret);
      return $connection;
    }
}
