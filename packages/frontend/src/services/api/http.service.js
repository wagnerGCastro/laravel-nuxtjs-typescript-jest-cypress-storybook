import axios from 'axios'
import store from '@/store'
import { auth as authStorage } from '../../libs/localStorage/auth'

import { URL_API } from '@/config/constants'

const debug = process.env.NODE_ENV !== 'production'

export default class Http {
  constructor (status) {
    const tokenState = store.getters['auth/tokenState']
    const tokenLocal = authStorage.getToken()
    const token = tokenState !== '' ? tokenState : tokenLocal

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

if (debug) {
  console.log('api_url', URL_API)
}
