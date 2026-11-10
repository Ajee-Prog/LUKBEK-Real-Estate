<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    /**
     * Display active agents.
     */
    public function index()
    {
        $agents = Agent::where('status', 'active')
            ->latest()
            ->paginate(12);

        return view(
            'frontend.agents.index',
            compact('agents')
        );
    }

    /**
     * Display one agent.
     */
    public function show($id)
    {
        $agent = Agent::where('id', $id)
            ->where('status', 'active')
            ->firstOrFail();

        $properties = $agent->properties()
            ->where('status', 'available')
            ->latest()
            ->paginate(8);

        return view(
            'frontend.agents.show',
            compact('agent', 'properties')
        );
    }
}
