import ls from '../secure-ls'
import { TOKEN_KEY, REFRESH_TOKEN_KEY } from '@/config/constants'

export const auth = {
  getToken () {
    const token = ls.get(TOKEN_KEY)
    return token
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
