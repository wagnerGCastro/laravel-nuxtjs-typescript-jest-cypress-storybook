import axios from 'axios'
import { storageService } from '../storage'

import { URL_API } from '../../config/api'

console.log('URL_API', URL_API)

export default class Http {
  constructor (status) {
    const token = storageService.getToken()
    // console.log('token', token)

    const headers = status.auth ? {
      Authorization: `Bearer ${token}`,
      'X-Requested-With': 'XMLHttpRequest',
      'X-CSRF-TOKEN': token
    } : {}

    this.instance = axios.create({
      baseURL: URL_API,
      headers: headers
    })

    return this.instance
  }
}
