<template>
    <el-dialog v-model="dialogFormVisible"
               :title="title"
               :before-close="handleClose"
               ref="dialogRef"
    >
        <el-form :model="form" label-width="120px">
            <el-form-item label="Action" prop="action" v-if="showAction">
                <el-radio-group v-model="form.action">
                    <el-radio v-for="(item,key) in actionList" :label="key" :key="key">{{ item }}</el-radio>
                </el-radio-group>
            </el-form-item>
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
        </el-form>
        <template #footer>
            <div class="dialog-footer">
                <el-button @click="dialogFormVisible = false">关闭窗口</el-button>
                <el-button type="primary" @click="handleSubmit">
                    执行动作
                </el-button>
            </div>
        </template>
    </el-dialog>
    <button class="btn btn-primary  btn-outline" @click="dialogFormVisible = true">
        <span class="d-none d-sm-inline">{{ title }}</span>
    </button>
</template>
<script setup>
import {onMounted, ref, computed, reactive} from 'vue'
import dayjs from 'dayjs';
import {baseShortcuts} from '../../Utils/constants.js'
import {ElLoading, ElMessage, ElNotification} from "element-plus";
import {pullDateApi} from "../../Api/Index.js";

const actionList = {
    'all': "全部",
    'jl': "巨量",
    'ks': "快手",
    'tx': "腾讯",
    'uc': "UC",
    'bd': "百度",
    'vivo': "Vivo",
};

const {component, title} = defineProps(['component', 'title'])
const form = reactive({
    dateRange: [],
    action: component,
})
const loading = ref(false);
const dialogRef = ref(null);

const showAction = computed(() => {
    return !Object.keys(actionList).includes(component);
})

const handleClose = (done) => {
    if (loading.value) return;
    done();
}

const handleSubmit = async () => {
    let start = form.dateRange[0];
    let end = form.dateRange[1];
    if (!start || !end) {
        ElMessage.error("请选择日期范围");
        return;
    }


    loading.value = true;
    let loadingRef = ElLoading.service({target: dialogRef.value.dialogContentRef.$el})
    let res = await pullDateApi({
        action: component,
        start_date: dayjs(start).format('YYYY-MM-DD'),
        end_date: dayjs(end).format('YYYY-MM-DD'),
    })
    loading.value = false;
    loadingRef.close();
    console.log("res.body",res.body);

    let status = res.body?.code === 0;
    ElNotification({
        title: status ? '获取成功' : '获取失败',
        message: res.body?.message || '错误.没有返回消息',
        type: status ? 'success' : 'error',
    })
    if (status) {
        // Dcat.reload();
    }

}


const dialogFormVisible = ref(false);
onMounted(async () => {


})

</script>
<style scoped lang="less">

</style>
