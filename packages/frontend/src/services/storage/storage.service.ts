import ls from '../../libs/secure-ls'
import { TOKEN_KEY, REFRESH_TOKEN_KEY, VUE_APP_KEY_STORE } from '@/config/api'

export const storageService = {
  getToken () {
    const storageApp = JSON.parse(ls.get(VUE_APP_KEY_STORE))
    console.log('storageApp?.aut?.token', storageApp?.auth.token)
    return storageApp?.auth?.token
  },

  saveToken (accessToken: string) {
    ls.set(TOKEN_KEY, accessToken)
  },

  removeToken () {
    ls.remove(TOKEN_KEY)
  },

  getRefreshToken () {
    return localStorage.getItem(REFRESH_TOKEN_KEY)
  },

  saveRefreshToken (refreshToken: string) {
    localStorage.setItem(REFRESH_TOKEN_KEY, refreshToken)
  },

  removeRefreshToken () {
    localStorage.removeItem(REFRESH_TOKEN_KEY)
  }

}
