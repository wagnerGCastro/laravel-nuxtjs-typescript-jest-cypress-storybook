import BaseService from '../base.service'
import { storageService } from '../../storage/index'

export default class AuthService extends BaseService {
  static async auth (params) {
    return new Promise((resolve, reject) => {
      this.request().post('/auth/login', params)
        .then(res => {
          storageService.saveToken(res.data.token)
          resolve(res.data)
        })
        .catch(error => reject(error))
    })
  }

  static async me () {
    const token = storageService.getToken()

    if (!token) {
      return Promise(reject => reject('Token Not Found'))
    }

    return new Promise((resolve, reject) => {
      this.request({ auth: true }).get('/auth/me')
        .then(res => {
          resolve(res.data.user)
        })
        .catch(error => {
          storageService.removeToken()
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
          storageService.removeToken()
        })
    })
  }
}
