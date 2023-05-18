<?php

namespace App\Admin\Controllers;

use App\Admin\Forms\SettingForm;
use App\Http\Controllers\Controller;
use Dcat\Admin\Admin;
use Dcat\Admin\Layout\Column;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Layout\Row;
use Dcat\Admin\Widgets\Card;

class HomeController extends Controller
{
    public function index(Content $content)
    {
        return $content
            ->header('Dashboard')
            ->description('Description...')
            ->body(function (Row $row) {
                $row->column(6, function (Column $column) {
                    $params = [
                        'greeting' =>greetOfNowCn(),
                        'username' => Admin::user()->name,
                        'avatar' => Admin::user()->getAvatar(),
                    ];
                    $title = view('admin::dashboard.title',$params);
                    $column->row($title);
//                    $column->row(new Examples\Tickets());
                });
//
//                $row->column(6, function (Column $column) {
//                    $column->row(function (Row $row) {
//                        $row->column(6, new Examples\NewUsers());
//                        $row->column(6, new Examples\NewDevices());
//                    });
//
//                    $column->row(new Examples\Sessions());
//                    $column->row(new Examples\ProductOrders());
//                });
            });
    }

    public function setting(Content $content) {
        return $content
            ->header('系统后台配置值')
            ->description('Description...')
            ->body(new Card(new SettingForm()));
    }
}
