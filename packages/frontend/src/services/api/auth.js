import api from './index'

export function login (data) {
  console.log('userData ==>', data)
  return api.request({
    url: '/api/auth/login',
    method: 'post',
    data
  })
}

export function logout (sessionid) {
  return api.request({
    url: '/api/auth/logout',
    method: 'post',
    data: {
      sessionid
    }
  })
}

export function register (data) {
  return api.post('/api/auth/register', data)
}
