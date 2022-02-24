import axios from 'axios'
import util from '../../libs/util'
import constant from '../../config/constant'

const token = document.head.querySelector('meta[name="csrf-token"]') || ''

const api = axios.create({
  baseURL: constant.webBaseURL,
  headers: {
    'X-Requested-With': 'XMLHttpRequest',
    'X-CSRF-TOKEN': token
  }
})

api.interceptors.request.use(
  config => {
    if (!/^https:\/\/|http:\/\//.test(config.url)) {
      const token = util.cookies.get('token')
      if (token && token !== 'undefined') {
        config.headers.Authorization = 'Bearer ' + token
      }
    }

    return config
  },
  error => {
    console.log(error)
  }
)

export default api
