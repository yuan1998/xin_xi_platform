<template>
  <el-button @click="copyText">{{text}}</el-button>
</template>
<script setup>
import copy from 'copy-to-clipboard';
import {ElMessage} from "element-plus";

const {url , text = '复制'} = defineProps(['url' , 'text'])

const copyText =() => {
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
