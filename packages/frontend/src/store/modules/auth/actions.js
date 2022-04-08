import router from '@/router'
import AuthService from '@/services/api/modules/auth.service'
import { AUTH_SET_USER, AUTH_SET_TOKEN, AUTH_LOADING, AUTH_LOADED } from '../../mutation-types'
import { DASHBOARD_1_NAME, AUTH_SIGN_IN1_NAME } from '@/router/constantes'

export default {
  async loginAction ({ commit }, params) {
    return new Promise((resolve, reject) => {
      commit(AUTH_LOADING)

      AuthService.auth(params)
        .then(data => {
          commit(AUTH_SET_USER, data.user)
          commit(AUTH_SET_TOKEN, data.token)
          router.push({ name: DASHBOARD_1_NAME })
          resolve()
          setTimeout(() => commit(AUTH_LOADED), 700)
        })
        .catch(error => {
          commit(AUTH_LOADED)
          reject(error)
        })
    })
  },

  getMeAction ({ commit }) {
    AuthService.me()
      .then(user => {
        commit(AUTH_SET_USER, user)
      })
      .catch(err => console.log('error getme', err))
  },

  async logoutAction ({ commit }) {
    commit(AUTH_SET_TOKEN, '')
    router.push({ name: AUTH_SIGN_IN1_NAME })
    setTimeout(() => commit(AUTH_SET_USER, {}), 500)
    AuthService.logout()
  },

  loadedAction ({ commit }) {
    commit(AUTH_LOADED)
  }
}
