<?php

namespace App\Containers\LegalStatus\UI\API\Requests;

use App\Ship\Parents\Requests\Request;

/**
 * Class UpdateLegalStatusRequest.
 *
 * @author Sebastian Weckend <sebastian.weckend@posteo.de>
 */
class UpdateLegalStatusRequest extends Request
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
     * Id's that needs decoding before applying the validation rules.
     *
     * @var  array
     */
    protected $decode = [
         'id',
    ];

    /**
     * @return  array
     */
    public function rules()
    {
        return [
             'id' => 'required|exists:legal_status',
            'name' => 'min:3|max:191'
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
