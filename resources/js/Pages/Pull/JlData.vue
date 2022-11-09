<template>
    <el-form :model="form" label-width="120px">
        <el-form-item label="日期范围" prop="dateRange">
            <el-date-picker
                v-model="form.dateRange"
                type="daterange"
                unlink-panels
                range-separator="到"
                start-placeholder="开始时间"
                end-placeholder="结束时间"
                :shortcuts="baseShortcuts"
            />
        </el-form-item>
        <el-form-item>
            <el-button type="primary" @click="handleSubmit">提交</el-button>
            <el-button>关闭</el-button>
        </el-form-item>
    </el-form>
</template>
<script setup>
import {reactive} from 'vue'

const form = reactive({
    dateRange: [],
})

const handleSubmit = () => {


}

</script>
<style scoped lang="less">

</style>
