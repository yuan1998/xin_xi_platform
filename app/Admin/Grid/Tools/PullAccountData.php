<?php
namespace App\Admin\Grid\Tools;

use Dcat\Admin\Admin;
use Dcat\Admin\Grid\Tools\AbstractTool;

class PullAccountData extends AbstractTool {

    public $action;

    public function __construct($title= '',$action = '')
    {
        $this->action = $action;
        parent::__construct($title);
    }

    public function render(): string
    {
        return \Inertia\Inertia::render('Pull/Index', [
            'component' => $this->action,
            'title' => $this->title
        ])
            ->rootView('admin.ib-app')
            ->toResponse(request())
            ->content();
    }
}
