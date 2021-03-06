<?php

namespace App\Containers\Plot\UI\API\Requests;

use App\Ship\Parents\Requests\Request;

/**
 * Class GetPlotsForMapRequest
 *
 * @author Sebastian Weckend <sebastian.weckend@posteo.de>
 */
class GetPlotsForMapRequest extends Request
{

    /**
     * Define which Roles and/or Permissions has access to this request.
     *
     * @var  array
     */
    protected $access = [
        'permissions' => '',
        'roles'       => 'manager',
    ];

    /**
     * @return  array
     */
    public function rules()
    {
        return [
        ];
    }

    /**
     * @return  bool
     */
    public function authorize()
    {
        return $this->check([
            'hasAccess',
        ]);
    }
}
