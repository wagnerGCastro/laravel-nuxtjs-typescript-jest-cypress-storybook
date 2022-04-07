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
          commit(AUTH_LOADED)
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
    commit(AUTH_SET_USER, {})

    return AuthService.logout()
      .then(() => {
        console.log('logout com sucesso')
      })
      .catch(err => console.log('error logout', err))
  },

  loadedAction ({ commit }) {
    commit(AUTH_LOADED)
  }
}
