<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\PlayerSession;
use App\Models\Session;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GameController extends Controller
{

    public function index()
    {
        return view('game.welcoming');
    }
    public function newGame()
    {
        return view('game.setting');
    }

    public function journalGame()
    {
        $games = Game::orderBy('game_player_date', 'desc')->get();
        return view('game.gamejournal', ['games' => $games]);
    }



    public function store(Request $request)
    {

        $data = [
            'game_player_session' => $request->total_session,
            'game_player_total' => $request->total_player,
            'game_player_date' => Carbon::now()
        ];

        $latestInput = Game::create($data);

        return view('game.scorelog', ['game_player_names' => $request->pemain, 'game_id' => $latestInput->id, 'game_session' => 1, 'session_data' => null]);
    }


    public function nextStore(Request $request)
    {
        $game = Game::where('id', $request->game_id)->first();
        $game_session_total = $game->game_player_session;
        $game_session_now = (int)$request->game_session;
        $game_session_next = $game_session_now + 1;

        $game_session_now_data = Session::where('game_id', $game->id)->where('session_number', $game_session_now)->first();

        $game_session_next_data = Session::where('game_id', $game->id)->where('session_number', $game_session_next)->first();

        $session_data = [
            'game_id' => $game->id,
            'session_number' => $game_session_now
        ];
        if ($game_session_now_data == null) {
            $session = Session::create($session_data);

            foreach ($request->game_player_names as $key => $player) {
                $index = 0;
                $scores = [];
                $score_total = 0;

                for ($i = ($key * 10); $i <= (($key * 10) + 9); $i++) {
                    $score = (int)$request->score_input[$i];
                    $scores[$index] = $score;
                    $score_total += $score;
                    $index++;
                }

                $player_session_data = [
                    'session_id' => $session->id,
                    'player_name' => $player,
                    'player_shot1' => $scores[0],
                    'player_shot2' => $scores[1],
                    'player_shot3' => $scores[2],
                    'player_shot4' => $scores[3],
                    'player_shot5' => $scores[4],
                    'player_shot6' => $scores[5],
                    'player_shot7' => $scores[6],
                    'player_shot8' => $scores[7],
                    'player_shot9' => $scores[8],
                    'player_shot10' => $scores[9],
                    'player_total_score' =>  $score_total
                ];

                PlayerSession::create($player_session_data);
            }
        }else{
            $player_data_on_session = PlayerSession::where('session_id', $game_session_now_data->id)->get();
            foreach($player_data_on_session as $key=>$player_session){
                $index = 0;
                $scores = [];
                $score_total = 0;

                for ($i = ($key * 10); $i <= (($key * 10) + 9); $i++) {
                    $score = (int)$request->score_input[$i];
                    $scores[$index] = $score;
                    $score_total += $score;
                    $index++;
                }

                $player_session_data = [
                    'player_shot1' => $scores[0],
                    'player_shot2' => $scores[1],
                    'player_shot3' => $scores[2],
                    'player_shot4' => $scores[3],
                    'player_shot5' => $scores[4],
                    'player_shot6' => $scores[5],
                    'player_shot7' => $scores[6],
                    'player_shot8' => $scores[7],
                    'player_shot9' => $scores[8],
                    'player_shot10' => $scores[9],
                    'player_total_score' =>  $score_total
                ];

                $player_session->update($player_session_data);
            }
        }



        if($game_session_next_data == null){
            if ($game_session_next <= $game_session_total) {
                return view('game.scorelog', ['game_player_names' => $request->game_player_names, 'game_id' => $game->id, 'game_session' => $game_session_next, 'session_data' => null]);
            }else{
                return view('game.gamefin', ['game_id' => $game->id]);
            }
        }else{
            if ($game_session_next <= $game_session_total) {
                $player_data_on_session = PlayerSession::where('session_id', $game_session_next_data->id)->get();
                return view('game.scorelog', ['game_player_names' => $request->game_player_names, 'game_id' => $game->id, 'game_session' => $game_session_next, 'session_data' => $player_data_on_session]);
                
            }else{
                return view('game.gamefin', ['game_id' => $game->id]);
            }
        }



        
    }

    public function previousStore(Request $request)
    {
        $game = Game::where('id', $request->game_id)->first();
        $game_session_now = (int)$request->game_session;
        $game_session_previous = $game_session_now - 1;

        $game_session_now_data = Session::where('game_id', $game->id)->where('session_number', $game_session_now)->first();

        $game_session_previous_data = Session::where('game_id', $game->id)->where('session_number', $game_session_previous)->first();

        $session_data = [
            'game_id' => $game->id,
            'session_number' => $game_session_now
        ];
        if ($game_session_now_data == null) {
            $session = Session::create($session_data);

            foreach ($request->game_player_names as $key => $player) {
                $index = 0;
                $scores = [];
                $score_total = 0;

                for ($i = ($key * 10); $i <= (($key * 10) + 9); $i++) {
                    $score = (int)$request->score_input[$i];
                    $scores[$index] = $score;
                    $score_total += $score;
                    $index++;
                }

                $player_session_data = [
                    'session_id' => $session->id,
                    'player_name' => $player,
                    'player_shot1' => $scores[0],
                    'player_shot2' => $scores[1],
                    'player_shot3' => $scores[2],
                    'player_shot4' => $scores[3],
                    'player_shot5' => $scores[4],
                    'player_shot6' => $scores[5],
                    'player_shot7' => $scores[6],
                    'player_shot8' => $scores[7],
                    'player_shot9' => $scores[8],
                    'player_shot10' => $scores[9],
                    'player_total_score' =>  $score_total
                ];

                PlayerSession::create($player_session_data);
            }
        }else{
            $player_data_on_session = PlayerSession::where('session_id', $game_session_now_data->id)->get();
            foreach($player_data_on_session as $key=>$player_session){
                $index = 0;
                $scores = [];
                $score_total = 0;

                for ($i = ($key * 10); $i <= (($key * 10) + 9); $i++) {
                    $score = (int)$request->score_input[$i];
                    $scores[$index] = $score;
                    $score_total += $score;
                    $index++;
                }

                $player_session_data = [
                    'player_shot1' => $scores[0],
                    'player_shot2' => $scores[1],
                    'player_shot3' => $scores[2],
                    'player_shot4' => $scores[3],
                    'player_shot5' => $scores[4],
                    'player_shot6' => $scores[5],
                    'player_shot7' => $scores[6],
                    'player_shot8' => $scores[7],
                    'player_shot9' => $scores[8],
                    'player_shot10' => $scores[9],
                    'player_total_score' =>  $score_total
                ];

                $player_session->update($player_session_data);
            }
        }



        if($game_session_previous_data == null){
            if ($game_session_previous >= 1) {
                return view('game.scorelog', ['game_player_names' => $request->game_player_names, 'game_id' => $game->id, 'game_session' => $game_session_previous, 'session_data' => null]);
            }else{
                
                $player_data_on_session = PlayerSession::where('session_id', $game_session_now_data->id)->get();
                return view('game.scorelog', ['game_player_names' => $request->game_player_names, 'game_id' => $game->id, 'game_session' => 1, 'session_data' => $player_data_on_session]);
            
            }
        }else{
            if ($game_session_previous >= 1) {
                $player_data_on_session = PlayerSession::where('session_id', $game_session_previous_data->id)->get();
                return view('game.scorelog', ['game_player_names' => $request->game_player_names, 'game_id' => $game->id, 'game_session' => $game_session_previous, 'session_data' => $player_data_on_session]);
            
            }else{
                $player_data_on_session = PlayerSession::where('session_id', $game_session_now_data->id)->get();
                return view('game.scorelog', ['game_player_names' => $request->game_player_names, 'game_id' => $game->id, 'game_session' => 1, 'session_data' => $player_data_on_session]);
            
            }
        }


    }



    public function show(string $id){
        $games = Game::with([
            'sessions' => function ($query) {
                $query->with(['playerSessions' => function ($query) {
                    $query->orderBy('player_total_score', 'desc'); 
                }]);
            }
        ])->where('id', $id)->first();
        
        return view('game.gameresult', ['game_results' => $games]);
    }
}
