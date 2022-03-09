export default {
  userState: state => state.user,
  hasTokenState: ({ token }) => !!token
}
