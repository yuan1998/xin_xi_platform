<template>
    <el-button @click="authUrl" size="small">复制授权链接</el-button>
</template>
<script setup>
import copy from 'copy-to-clipboard';
import {ElMessage} from "element-plus";

const {app, redirectUri} = defineProps(['app', 'redirectUri']);

const authUrl = () => {
    let url = `https://open-ad.vivo.com.cn/OAuth?clientId=${app.client_id}&redirectUri=${redirectUri}`;

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
