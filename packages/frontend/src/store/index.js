import Vue from 'vue'
import Vuex from 'vuex'
import createPersistedState from 'vuex-persistedstate'
import { APP_KEY_STORE } from '../config/constants'
import ls from '../libs/secure-ls'

// modules
import auth from './modules/auth/index'
import Setting from './modules/Setting/index'
import Ecommerce from './modules/Ecommerce/index'

Vue.use(Vuex)

const debug = process.env.NODE_ENV !== 'production'

export default new Vuex.Store({
  modules: {
    auth,
    Setting,
    Ecommerce
  },
  state: {
  },
  mutations: {
  },
  actions: {
  },
  getters: {
  },
  strict: debug,
  plugins: [createPersistedState({
    key: APP_KEY_STORE,
    paths: ['auth', 'Setting', 'Ecommerce'],
    storage: {
      getItem: (key) => ls.get(key),
      setItem: (key, value) => ls.set(key, value),
      removeItem: (key) => ls.remove(key)
    }
  })]
})

if (ls.get(APP_KEY_STORE) && debug) {
  const storageApp = JSON.parse(ls.get('front-app'))
  console.log('app_storage', storageApp)
}
