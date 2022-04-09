import BaseService from '../base.service'
import { auth as authStorage } from '../../../libs/localStorage'

export default class AuthService extends BaseService {
  static async auth (params) {
    return new Promise((resolve, reject) => {
      this.request().post('/auth/login', params)
        .then(res => {
          authStorage.saveToken(res.data.token)
          resolve(res.data)
        })
        .catch(error => reject(error))
    })
  }

  static async me () {
    const token = authStorage.getToken()

    if (!token) {
      return Promise(reject => reject('Token Not Found'))
    }

    return new Promise((resolve, reject) => {
      this.request({ auth: true }).get('/auth/me')
        .then(res => {
          resolve(res.data.user)
        })
        .catch(error => {
          authStorage.removeToken()
          reject(error.response)
        })
    })
  }

  static async logout () {
    return new Promise((resolve, reject) => {
      this.request({ auth: true }).post('/auth/logout', {}, { timeout: 1000 * 5 })
        .then(() => {
          resolve()
        })
        .catch(error => reject(error.response))
        .finally(() => {
          authStorage.removeToken()
        })
    })
  }
}
