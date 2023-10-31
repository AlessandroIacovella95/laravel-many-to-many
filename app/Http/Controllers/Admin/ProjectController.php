<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Project;
use App\Models\Type;
use App\Models\Technology;
use Illuminate\support\Str;
use Illuminate\support\Arr;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * *@return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::orderby('id', 'desc')->paginate(8);
        return view("admin.projects.index", compact("projects"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * *@return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view("admin.projects.create", compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * *@return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        $data = $request->validated();

        $project = new Project();

        $project->title = $data["title"];
        $project->description = $data["description"];
        $project->url = $data["url"];
        $project->type_id = $data["type_id"];
        $project->slug = Str::slug($project->title);

        $project->save();

        if (Arr::exists($data, "technologies")) {
            $project->technologies()->attach($data["technologies"]);
        }


        return redirect()->route("admin.projects.show", $project)
            ->with('message_type', 'success')
            ->with('message', 'Progetto creato con successo');
        ;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * *@return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view("admin.projects.show", compact("project"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * *@return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        $technologies = Technology::all();

        $technology_ids = $project->technologies->pluck("id")->toArray();
        return view('admin.projects.edit', compact('project', 'types', 'technologies', 'technology_ids'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * *@return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $data = $request->all();

        $project->title = $data["title"];
        $project->description = $data["description"];
        $project->url = $data["url"];
        $project->type_id = $data["type_id"];
        $project->slug = Str::slug($project->title);

        $project->save();

        if (Arr::exists($data, "technologies")) {
            $project->technologies()->sync($data["technologies"]);
        } else {
            $project->technologies()->detach();
        }

        return redirect()->route("admin.projects.show", $project)
            ->with('message_type', 'success')
            ->with('message', 'Progetto modificato con successo');
        ;
    }

    /**
     * soft delets the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * *@return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route("admin.projects.index")
            ->with('message_type', 'danger')
            ->with('message', 'Progetto eliminato con successo');
        ;
    }

    public function trash()
    {
        $projects = Project::orderby('id', 'desc')->onlyTrashed()->paginate(8);
        return view("admin.projects.trash.index", compact("projects"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * *@return \Illuminate\Http\Response
     */

    public function forceDestroy(int $id)
    {
        $project = Project::onlyTrashed()->findOrFail($id);
        $project->technologies()->detach();
        $project->forceDelete();
        return redirect()->route("admin.projects.trash.index");
    }


    public function restore(int $id)
    {
        $project = Project::onlyTrashed()->findOrFail($id);
        $project->restore();
        return redirect()->route("admin.projects.trash.index");
    }
}