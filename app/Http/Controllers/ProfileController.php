<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Tweet;
use App\User;
use App\Comment;
use Intervention\Image\ImageManager;
use App\Tag;

class ProfileController extends Controller
{
    public function index() {

    	// Count the total amount of tweets by this user
    	$totalTweets = \Auth::user()->tweets()->count();

    	return view('profile.index', compact('totalTweets'));
    }
    public function newTweet(Request $request) {

    	$this->validate($request, [
    		'content' => 'required|min:4|max:140'
    	]);

    	$newTweet = new Tweet();

    	$newTweet->content = $request->content;
    	$newTweet->user_id = \Auth::user()->id;

    	$newTweet->save();

    	// Process the tags
    	$tags = explode('#', $request->tags);
    	$tagsFormatted = [];

    	foreach($tags as $tag){

    		// If after trimming something remains
    		if( trim($tag) ) {
    			$tagsFormatted[] = strtolower(trim($tag));
    		}

    	}

    	$allTagsIds = [];

    	// Loop over each tag
    	foreach( $tagsFormatted as $tag) {

    		// Grab the first matching reslut or insert this new unique tag
    		$theTag = Tag::firstOrCreate(['name'=>$tag]);

    		$allTagsIds[] = $theTag->id;
    	}

    	// Attach the tag ids to the tweet
    	$newTweet->tags()->attach($allTagsIds);

    	return redirect('profile');
    }
    public function show($username){

    	// Find the user
    	$user = User::where('username', '=', $username)->firstOrFail();

    	$userPosts = $user->tweets()->get();

    	return view('profile.show', compact('user', 'userPosts'));
    }
    public function newComment(Request $request) {

    	$this->validate($request, [
    		'comment'=>'required|min:4|max:140',
    		'tweet-id'=>'required|exists:tweets,id'
    	]);

    	// Create new comment
    	$comment = new Comment();

    	$comment->content = $request->comment;
    	$comment->user_id = \Auth::user()->id;
    	$comment->tweet_id = $request['tweet-id'];

    	$comment->save();

    	return back();
    }
    public function deleteTweet($id) {

    	// Find the tweet
    	$tweet = Tweet::findOrFail($id);

    	// Check that the logged in user owns this tweet
    	if($tweet->user_id != \Auth::user()->id) {
    		return 'Not your tweet';
    	}
    	return view('profile.confirm_tweet_delete', compact('tweet'));
    }
    public function destroyTweet($id) {

    	// Find the tweet
    	$tweet = Tweet::findOrFail($id);

    	if($tweet->user_id != \Auth::user()->id) {
    		return 'Not your tweet';
    	}

    	$tweet->delete();

    	return redirect('profile/'.$tweet->user->username);
    }
    public function newProfileImage( Request $request ) {

    	$this->validate($request, [
    		'photo' => 'required|image'
    	]);

    	// Create instance of Image Intervention
    	$manager = new ImageManager();

    	$profileImage = $manager->make( $request->photo );

    	$profileImage->resize(180, null, function ($constraint) {
    		$constraint->aspectRatio();
		});
		$profileImage->save( 'profiles/'.\Auth::user()->id.'.jpg', 80 );

		// Save the file name in the users table
		$user = User::find( \Auth::user()->id );

		$user->profileImage = \Auth::user()->id.'.jpg';

		$user->save();

		return redirect('profile/'.$user->username);

    }
}
















