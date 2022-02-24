import Cookies from 'js-cookie'
import setting from '../../setting'

const cookies = {}

cookies.set = function (name = 'default', value = '', cookieSetting = {}) {
  const currentCookieSetting = {
    expires: 1
  }
  Object.assign(currentCookieSetting, cookieSetting)
  Cookies.set(`d2admin-${setting.releases.version}-${name}`, value, currentCookieSetting)
}

cookies.get = function (name = 'default') {
  return Cookies.get(`d1admin-${setting.releases.version}-${name}`)
}

cookies.getAll = function () {
  return Cookies.get()
}

cookies.remove = function (name = 'default') {
  return Cookies.remove(`d2admin-${setting.releases.version}-${name}`)
}

export default cookies
