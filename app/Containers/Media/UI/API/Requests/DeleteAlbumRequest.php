<?php

namespace App\Containers\Media\UI\API\Requests;

use App\Ship\Parents\Requests\Request;

/**
 * Class DeleteAlbumRequest.
 *
 * @author Sebastian Weckend <sebastian.weckend@posteo.de>
 */
class DeleteAlbumRequest extends Request
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
         'nursery_id',
         'hotspot_id',
    ];

    /**
     * @return  array
     */
    public function rules()
    {
        return [
            'id'            => 'required|exists:media,id',
            'nursery_id'    => 'required_without:hotspot_id|exists:nurseries,id',
            'hotspot_id'    => 'required_without:nursery_id|exists:hotspots,id',
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
