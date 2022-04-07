export default {
  userState: state => state.user,
  hasTokenState: ({ token }) => !!token,
  loadingState: state => state.loading,
  tokenState: state => state.token
}
