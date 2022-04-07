import store from '../store'
import {
  AUTH_SIGN_IN1_PATH,
  DASHBOARD_1_NAME
} from './constantes'

function nextFactory (context, middleware, index) {
  const subsequentMiddleware = middleware[index]
  if (!subsequentMiddleware) {
    return context.next
  }
  return (...parameters) => {
    context.next(...parameters)
    const nextMiddleare = nextFactory(context, middleware, index + 1)
    subsequentMiddleware({ ...context, next: nextMiddleare })
  }
}

export default async (to, from, next) => {
  document.title = `${to.name} - Frontend Admin`

  const publicPagesNotToken = [
    '/auth/sign-in',
    '/auth/sign-up1',
    '/dark/auth/sign-in1',
    '/dark/auth/sign-up1'
  ]

  const hasToken = store.getters['auth/hasTokenState']

  /**
   * Implement middleare vue-cli
   * Learn how to work with middleware in vue-cli / vue - middleware are very powerful
   * https://www.youtube.com/watch?v=ToIVxvdpx-A
   */
  if (to.meta.middleware) {
    const context = { from, next, to, store }
    const middleware = Array.isArray(to.meta.middleware) ? to.meta.middleware : [to.meta.middleware]
    const nextMiddleware = nextFactory(context, middleware, 1)

    return middleware[0]({ ...context, next: nextMiddleware })
  }

  /** If public pages */
  if (publicPagesNotToken.includes(to.path) && hasToken) {
    return next({ name: DASHBOARD_1_NAME })
  }

  /**  If private pages */
  if (to.meta.auth && !hasToken) {
    return next(AUTH_SIGN_IN1_PATH)
  }

  if (to.path === '/') {
    return next({ name: DASHBOARD_1_NAME })
  }

  return next()
}
