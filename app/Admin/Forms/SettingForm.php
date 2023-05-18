<?php

namespace App\Admin\Forms;

use Dcat\Admin\Widgets\Form;

class SettingForm extends Form
{
    /**
     * Handle the form request.
     *
     * @param array $input
     *
     * @return mixed
     */
    public function handle(array $input)
    {

        admin_setting($input);
        return $this
            ->response()
            ->success('配置保存成功!')
            ->refresh();
    }

    /**
     * Build a form here.
     */
    public function form()
    {

        $this->divider('自动拉取部分');
        $this->switch('PULL_REPORT_JL', 'JL自动拉取数据');
        $this->switch('PULL_REPORT_KS', 'KS自动拉取数据');
        $this->switch('PULL_REPORT_TX', 'TX自动拉取数据');
        $this->switch('PULL_REPORT_BD', 'BD自动拉取数据');
        $this->switch('PULL_REPORT_VIVO', 'VIVO自动拉取数据');
        $this->switch('PULL_REPORT_UC', 'UC自动拉取数据');

        $this->divider('巨量数据发送钉钉配置');
        $this->switch('JL_DD_ROBOT_ENABLE','启用钉钉机器人');
        $this->text('JL_DD_ROBOT_URL','钉钉机器人WB_URL');

        $this->disableResetButton();

    }

    /**
     * The data of the form.
     *
     * @return array
     */
    public function default()
    {
        return admin_setting()->toArray();
    }
}
