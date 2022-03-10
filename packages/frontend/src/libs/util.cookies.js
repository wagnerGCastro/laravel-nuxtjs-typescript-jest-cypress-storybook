import Cookies from 'js-cookie'
import setting from '../../setting'

const cookies = {}
const namecookie = `frontend-${setting.releases.version}-${name}`

cookies.set = function (name = 'default', value = '', cookieSetting = {}) {
  const currentCookieSetting = {
    expires: 1
  }

  Object.assign(currentCookieSetting, cookieSetting)
  Cookies.set(namecookie)
}

cookies.get = function (name = 'default') {
  return Cookies.get(namecookie)
}

cookies.getAll = function () {
  return Cookies.get()
}

cookies.remove = function (name = 'default') {
  return Cookies.remove(namecookie)
}

export default cookies
