import getters from './getters'
import actions from './actions'
import mutations from './mutations'

const state = {
  user: {},
  token: '',
  expires: '',
  loading: {
    status: false,
    message: ''
  },
  isError: false
}

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
}
