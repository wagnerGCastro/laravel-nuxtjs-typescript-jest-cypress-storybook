
import AuthService from '@/services/api/auth.service'
import { AUTH_SET_USER, AUTH_SET_TOKEN } from '@/store/mutation-types'

export default {
  async loginAction ({ commit }, params) {
    return new Promise((resolve, reject) => {
      AuthService.auth(params)
        .then(data => {
          commit(AUTH_SET_USER, data.user)
          commit(AUTH_SET_TOKEN, data.token)
          resolve()
        })
        .catch(error => reject(error))
    })
  },

  getMeAction ({ commit }) {
    // commit('CHANGE_LOADING', true)

    AuthService.me()
      .then(user => {
        // console.log('user', user)
        commit(AUTH_SET_USER, user)
      })
      .catch(err => console.log('error getme', err))
      .finally(() => {
        // commit('CHANGE_LOADING', false)
      })
  },

  async logoutAction ({ commit }) {
    // commit('CHANGE_LOADING', true)

    commit(AUTH_SET_USER, {})
    commit(AUTH_SET_TOKEN, '')

    // return await AuthService.logout()
    //   .then(() => commit('LOGOUT'))
    //   .finally(() => commit('CHANGE_LOADING', false))
  },

  checkTokenAction ({ dispatch, state }) {
    if (state.token) {
      return Promise.resolve(state.token)
    }

    const token = false // storage.getToken()

    if (!token) {
      return Promise.reject(new Error('[107] - actionCheckToken: Token Inválido'))
    }

    return dispatch('actionLoadSession', token)
  }
}
