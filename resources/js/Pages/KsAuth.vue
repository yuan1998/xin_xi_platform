<template>
    <el-button @click="authUrl" size="small">复制授权链接</el-button>
</template>
<script setup>
import copy from 'copy-to-clipboard';
import {ElMessage} from "element-plus";

const {app, baseUrl} = defineProps(['app', 'baseUrl']);

const authUrl = () => {
    let dataJson = JSON.stringify({
        app_id: app.app_id
    });
    let redirectUri = `${baseUrl}/api/auth/ks`;
    let url = `https://developers.e.kuaishou.com/tools/authorize?app_id=${app.app_id}&scope=%5B%22ad_query%22%2C%22ad_manage%22%2C%22report_service%22%2C%22account_service%22%2C%22public_dmp_service%22%2C%22public_agent_service%22%2C%22public_account_service%22%5D&redirect_uri=${redirectUri}&state=${dataJson}&oauth_type=advertiser`;

    if (copy(url)) {
        ElMessage({
            message: '复制成功!',
            type: 'success',
        });
        return;
    }
    ElMessage({
        message: '复制失败!',
        type: 'error',
    });
}


</script>
<style scoped lang="less">

</style>
