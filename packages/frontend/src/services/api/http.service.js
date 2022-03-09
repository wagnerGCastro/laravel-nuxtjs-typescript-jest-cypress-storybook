import axios from 'axios'
import { storageService } from '../storage'

import { URL_API, TOKEN_KEY } from '../../config/api'

export default class Http {
  constructor (status) {
    const token = storageService.getToken(TOKEN_KEY)

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
