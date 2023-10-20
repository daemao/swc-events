import {ref} from "vue";
import axiosInstance from "@/axios";

export default  ()=>{
    const list = ref([]);
    const getList = ()=>{
        axiosInstance.get('/api/events').then(res=>{
            list.value= res.data.result;
        })
    }
    return {
        list,
        getList,
    }
}