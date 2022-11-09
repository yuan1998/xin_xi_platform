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
    let redirectUri = `${baseUrl}/api/auth/jl`;
    let url = `https://ad.oceanengine.com/openapi/audit/oauth.html?app_id=${app.app_id}&redirect_uri=${redirectUri}&state=${dataJson}`;

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
