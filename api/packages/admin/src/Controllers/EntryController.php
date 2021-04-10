<?php

namespace SHOP\Admin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SHOP\Admin\Models\AdminFieldCustom;

class EntryController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }

    public function fields(Request $request)
    {
        $request->validate([
            'entry' => 'required'
        ]);

        $entry = $request->input('entry');

        $fields = AdminFieldCustom::select(['display_fields'])
            ->where([
                'entry'     => $entry,
                'user_id'   => $request->user()->id
            ])
            ->first();

        return [
            'fields'         => $fields,
            'entry'          => $entry,
            'display_fields' => $fields ? $fields->display_fields : []
        ];
    }

    public function syncFields(Request $request)
    {
        $request->validate([
            'entry' => 'required',
            'display_fields' => 'required|array'
        ]);

        return AdminFieldCustom::updateOrCreate(
            [
                'user_id'   => $request->user()->id,
                'entry'     => $request->input('entry')
            ],
            ['display_fields' => $request->input('display_fields')]
        );
    }
}
