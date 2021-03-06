<?php

namespace App\Containers\Media\UI\API\Requests;

use App\Ship\Parents\Requests\Request;

/**
 * Class OrderAlbumRequest.
 *
 * @author Sebastian Weckend <sebastian.weckend@posteo.de>
 */
class OrderAlbumRequest extends Request
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
        'nursery_id',
        'hotspot_id',
        'album.*',
    ];

    /**
     * @return  array
     */
    public function rules()
    {
        return [
            'nursery_id'    => 'required_without:hotspot_id|exists:nurseries,id',
            'hotspot_id'    => 'required_without:nursery_id|exists:hotspots,id',
            'album'         => 'nullable|required|array',
            'album.*'       => 'nullable|exists:media,id',
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
