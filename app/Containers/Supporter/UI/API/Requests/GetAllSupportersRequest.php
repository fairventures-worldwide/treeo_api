<?php

namespace App\Containers\Supporter\UI\API\Requests;

use App\Ship\Parents\Requests\Request;

/**
 * Class GetAllSupportersRequest.
 *
 * @author Sebastian Weckend <sebastian.weckend@posteo.de>
 */
class GetAllSupportersRequest extends Request
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
