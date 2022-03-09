import { AUTH_SET_USER, AUTH_SET_TOKEN, AUTH_SET_EXPIRES } from '@/store/mutation-types'

export default {
  [AUTH_SET_TOKEN] (state, token) {
    state.token = token
  },

  [AUTH_SET_USER] (state, payload) {
    state.user = payload
  },

  [AUTH_SET_EXPIRES] (state, payload) {
    state.expires = payload
  }
}
