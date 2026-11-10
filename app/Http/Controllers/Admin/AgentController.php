<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    public function index()
    {
        $agents = Agent::latest()->paginate(15);

        return view(
            'admin.agents.index',
            compact('agents')
        );
    }

    public function create()
    {
        return view('admin.agents.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:50',
            'photo' => 'nullable|image|max:2048',
            'bio' => 'nullable|string',
            'status' => 'required|string',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request
                ->file('photo')
                ->store('agents', 'public');
        }

        Agent::create($validated);

        return redirect()
            ->route('admin.agents.index')
            ->with('success', 'Agent created successfully.');
    }

    public function show(Agent $agent)
    {
        $agent->load('properties');

        return view(
            'admin.agents.show',
            compact('agent')
        );
    }

    public function edit(Agent $agent)
    {
        return view(
            'admin.agents.edit',
            compact('agent')
        );
    }

    public function update(
        Request $request,
        Agent $agent
    ) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:50',
            'photo' => 'nullable|image|max:2048',
            'bio' => 'nullable|string',
            'status' => 'required|string',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request
                ->file('photo')
                ->store('agents', 'public');
        }

        $agent->update($validated);

        return redirect()
            ->route('admin.agents.index')
            ->with('success', 'Agent updated successfully.');
    }

    public function destroy(Agent $agent)
    {
        $agent->delete();

        return redirect()
            ->route('admin.agents.index')
            ->with('success', 'Agent deleted successfully.');
    }
}
