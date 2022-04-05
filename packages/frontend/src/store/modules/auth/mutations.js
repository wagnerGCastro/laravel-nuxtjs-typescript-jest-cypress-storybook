import {
  AUTH_SET_USER,
  AUTH_SET_TOKEN,
  AUTH_SET_EXPIRES,
  AUTH_LOADING,
  AUTH_LOADED
} from '../../mutation-types'

export default {
  [AUTH_SET_TOKEN] (state, token) {
    state.token = token
  },

  [AUTH_SET_USER] (state, payload) {
    state.user = payload
  },

  [AUTH_SET_EXPIRES] (state, payload) {
    state.expires = payload
  },

  [AUTH_LOADING] (state) {
    state.loading = true
  },

  [AUTH_LOADED] (state) {
    state.loading = false
  }
}
