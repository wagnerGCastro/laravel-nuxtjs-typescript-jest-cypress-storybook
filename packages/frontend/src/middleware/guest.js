export default function guest ({ next, router, store }) {
  // if (store.getters.auth.loggedIn) {
  //   return next({
  //     name: 'dashboard'
  //   })
  // }

  // console.log('middleware auth test', router)
  // console.log('middleware auth test', store)

  return next()
}
