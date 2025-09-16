<?php

namespace App\Http\Controllers;

use App\Models\Poll;
use App\Models\PollOption;
use App\Models\PollVote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PollController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->only(['store']);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'question' => 'required|string|max:255',
            'options' => 'required|array|min:2',
            'options.*' => 'required|string|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $slug = Str::slug(substr($request->question, 0, 50)) . '-' . Str::random(6);

        $poll = Auth::user()->polls()->create([
            'question' => $request->question,
            'slug' => $slug,
        ]);

        foreach ($request->options as $text) {
            $poll->options()->create(['text' => $text]);
        }

        return response()->json(['poll' => $poll->load('options')], 201);
    }

    public function show(Poll $poll)
    {
        return response()->json($poll->load('options'));
    }

    public function vote(Request $request, Poll $poll)
    {
        $validator = Validator::make($request->all(), [
            'poll_option_id' => 'required|exists:poll_options,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $option = PollOption::where('poll_id', $poll->id)
            ->where('id', $request->poll_option_id)
            ->firstOrFail();

        $userId = Auth::id();
        $ip = $request->ip();

        if ($userId) {
            $existing = PollVote::where('poll_id', $poll->id)->where('user_id', $userId)->first();
            if ($existing) {
                return response()->json(['error' => 'You have already voted'], 409);
            }
        }

        PollVote::create([
            'poll_id' => $poll->id,
            'poll_option_id' => $option->id,
            'user_id' => $userId,
            'voter_ip' => $ip,
        ]);

        return response()->json(['message' => 'Vote recorded']);
    }

    public function results(Poll $poll)
    {
        $poll->load('options');
        $totals = [];
        $sum = 0;
        foreach ($poll->options as $opt) {
            $count = PollVote::where('poll_id', $poll->id)->where('poll_option_id', $opt->id)->count();
            $totals[] = ['id' => $opt->id, 'text' => $opt->text, 'votes' => $count];
            $sum += $count;
        }

        return response()->json(['poll' => $poll, 'totals' => $totals, 'total_votes' => $sum]);
    }

    public function mine()
    {
        $this->middleware('auth:api');
        $polls = Auth::user()->polls()->withCount(['options as votes_count' => function ($q) {
            $q->select(\DB::raw('0')); // placeholder; counts are computed via votes relation normally
        }])->latest()->get();
        return response()->json($polls);
    }
}
