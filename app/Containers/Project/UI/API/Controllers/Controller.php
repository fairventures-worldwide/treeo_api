<?php

namespace App\Containers\Project\UI\API\Controllers;

use App\Containers\Project\UI\API\Requests\CreateProjectRequest;
use App\Containers\Project\UI\API\Requests\DeleteProjectRequest;
use App\Containers\Project\UI\API\Requests\GetAllProjectsRequest;
use App\Containers\Project\UI\API\Requests\FindProjectByIdRequest;
use App\Containers\Project\UI\API\Requests\UpdateProjectRequest;
use App\Containers\Project\UI\API\Transformers\ProjectTransformer;
use App\Ship\Parents\Controllers\ApiController;
use Apiato\Core\Foundation\Facades\Apiato;

/**
 * Class Controller
 *
 * @package App\Containers\Project\UI\API\Controllers
 * @author Sebastian Weckend <sebastian.weckend@posteo.de>
 */
class Controller extends ApiController
{
    /**
     * @param CreateProjectRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createProject(CreateProjectRequest $request)
    {
        $project = Apiato::call('Project@CreateProjectAction', [$request]);

        return $this->created($this->transform($project, ProjectTransformer::class));
    }

    /**
     * @param FindProjectByIdRequest $request
     * @return array
     */
    public function findProjectById(FindProjectByIdRequest $request)
    {
        $project = Apiato::call('Project@FindProjectByIdAction', [$request]);

        return $this->transform($project, ProjectTransformer::class);
    }

    /**
     * @param GetAllProjectsRequest $request
     * @return array
     */
    public function getAllProjects(GetAllProjectsRequest $request)
    {
        $projects = Apiato::call('Project@GetAllProjectsAction', [$request]);

        return $this->transform($projects, ProjectTransformer::class);
    }

    /**
     * @param UpdateProjectRequest $request
     * @return array
     */
    public function updateProject(UpdateProjectRequest $request)
    {
        $project = Apiato::call('Project@UpdateProjectAction', [$request]);

        return $this->transform($project, ProjectTransformer::class);
    }

    /**
     * @param DeleteProjectRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteProject(DeleteProjectRequest $request)
    {
        Apiato::call('Project@DeleteProjectAction', [$request]);

        return $this->noContent();
    }
}
