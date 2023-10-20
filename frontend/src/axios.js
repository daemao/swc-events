import axios from 'axios';
const baseURL = 'http://localhost:8000';

var axiosInstance = axios.create({ baseURL });

axiosInstance.addToken = (token, type = 'Bearer') => {
    const authorizationHeaderValue = `${type} ${token}`;
    // axiosInstance.defaults.withCredentials=true;
    axiosInstance.defaults.headers.common['Authorization'] =
        authorizationHeaderValue;
    return authorizationHeaderValue;
};
const token =localStorage.getItem('token');
const token_type=  localStorage.getItem('token_type');
if(token && token_type){
    axiosInstance.addToken(token,token_type)
}
export default axiosInstance;
