import {ref} from "vue";
import axiosInstance from "@/axios";

export default  ()=>{
    const item = ref({});
    const getItem = (id)=>{
        axiosInstance.get(`/api/events/${id}`).then(res=>{
            item.value= res.data.result;
        })
    }
    return {
        item,
        getItem,
    }
}