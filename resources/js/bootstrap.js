import axios from 'axios';
window.axios = axios;


window.axios.defaults.baseURL = location.origin;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
