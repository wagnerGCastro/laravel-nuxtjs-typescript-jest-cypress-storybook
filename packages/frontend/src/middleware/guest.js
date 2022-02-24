export default function guest ({ next, router }) {
  // if (store.getters.auth.loggedIn) {
  //   return next({
  //     name: 'dashboard'
  //   })
  // }

  console.log('middleware auth test')

  return next()
}
