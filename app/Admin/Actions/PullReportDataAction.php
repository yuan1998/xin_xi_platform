<?php

namespace App\Admin\Actions;

use App\Models\JLAccount;

use Dcat\Admin\Actions\Action;
use Illuminate\Http\Request;

class PullReportDataAction extends Action
{
    public $name = '拉取数据';

    protected $selector = '.excel-upload';

    /**
     * ExcelUpload constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }


    public function render()
    {
        return \Inertia\Inertia::render('Pull/Index', [
            'component' => '',
        ])
            ->toResponse(request())
            ->content();
    }

}
