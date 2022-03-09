import ls from '../../libs/secure-ls'
import { TOKEN_KEY, REFRESH_TOKEN_KEY } from '../../config/api'

export const storageService = {
  getToken () {
    return ls.get(TOKEN_KEY)
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
