<template>
  <ValidationObserver ref="form" v-slot="{ handleSubmit }">
    <form class="mt-4" novalidate @submit.prevent="handleSubmit(onSubmit)">
      <ValidationProvider vid="email" name="E-mail" rules="required|email" v-slot="{ errors }">
        <div class="form-group">
          <label for="emailInput">Email address</label>
          <input type="email" :class="'form-control mb-0' +(errors.length > 0 ? ' is-invalid' : '')"
                 id="emailInput" aria-describedby="emailHelp"
                 v-model="user.email" placeholder="Enter email" required>
          <div class="invalid-feedback">
            <span>{{ errors[0] }}</span>
          </div>
        </div>
      </ValidationProvider>
      <ValidationProvider vid="password" name="Password" rules="required" v-slot="{ errors }">
        <div class="form-group">
          <label for="passwordInput">Password</label>
          <router-link to="/auth/password-reset1" class="float-right">
            Forgot password?
          </router-link>
          <input type="password"  :class="'form-control mb-0' +(errors.length > 0 ? ' is-invalid' : '')"
                 id="passwordInput"
                 v-model="user.password" placeholder="Password" required>
          <div class="invalid-feedback">
            <span>{{ errors[0] }}</span>
          </div>
        </div>
      </ValidationProvider>
      <div class="d-inline-block w-100">
        <div class="custom-control custom-checkbox d-inline-block mt-2 pt-1">
          <input type="checkbox" class="custom-control-input" :id="formType">
          <label class="custom-control-label" :for="formType">Remember Me</label>
        </div>
        <button type="submit" class="btn btn-primary float-right">Sign in</button>
      </div>
      <div class="sign-info">
          <span class="dark-color d-inline-block line-height-2">
            Don't have an account?
            <router-link to="/auth/sign-up1" class="iq-waves-effect pr-4">
              Sign up
            </router-link>
          </span>
        <social-login-form></social-login-form>
      </div>
    </form>
  </ValidationObserver>
</template>

<script>

import api from '../../../../services'
import firebase from 'firebase'
import SocialLoginForm from './SocialLoginForm'
import { core } from '../../../../config/pluginInit'
import { mapGetters } from 'vuex'

export default {
  name: 'SignIn1Form',
  components: { SocialLoginForm },
  props: ['formType', 'email', 'password'],
  data: () => ({
    user: {
      email: '',
      password: ''
    }
  }),
  mounted () {
    this.user.email = this.$props.email
    this.user.password = this.$props.password
  },
  computed: {
    ...mapGetters({
      stateUsers: 'Setting/usersState'
    })
  },
  methods: {
    onSubmit () {
      if (this.formType === 'passport') {
        this.passportLogin()
      } else if (this.formType === 'jwt') {
        this.jwtLogin()
      } else if (this.formType === 'firebase') {
        this.firebaseLogin()
      }
    },
    passportLogin () {
      // auth.login(this.user).then(response => {
      //   if (response.status) {
      //     localStorage.setItem('user', JSON.stringify(response.data))
      //     this.$router.push({ name: 'dashboard.home-1' })
      //   } else if (response.data.errors.length > 0) {
      //     this.$refs.form.setErrors(response.data.errors)
      //   }
      // }).finally(() => { this.loading = false })
    },
    async jwtLogin () {
      console.log('OPa entrei aqui')

      // const selectedUser = this.stateUsers.find(user => {
      //   return (user.email === this.user.email && user.password === this.user.password)
      // }) || null

      const selectedUser = {
        email: this.user.email,
        password: this.user.password
      }

      if (selectedUser) {
        console.log('selectedUser', selectedUser)

        //  const resp = await services.login({
        //   email: this.resetPass.email,
        // })

        // console.log('service', api)

        try {
          const resp = await api.auth.login(selectedUser)
          console.log('reps', JSON.stringify(resp, null, 2))
        } catch (err) {
          // console.log(JSON.stringify(err, null, 2))
          // alert(err.response.status)
          // console.log('erro', err.response.data);
          // console.log('status', err.response.status);
          // console.log(err.response.headers);

          if (err.response) {
            if (err.response.status === 400) {
              return console.log(err.response.data.data)
            }

            if (err.response.status === 500) {
              return console.log('Houve um erro inesperado, tente novamente mais tarde.')
            }
          }

          /** Network Error */
          if (err.name === 'Error') {
            if (err.message === 'Network Error') {
              return console.log('Sem conexão com o servidor.')
            }

            if (err.message === 'Request failed with status code 500') {
              return console.log('Houve um erro com o servidor.')
            }
          }
        } finally {
          // off load

        }

        // this.$store.dispatch('Setting/authUserAction', {
        //   auth: true,
        //   authType: 'jwt',
        //   user: {
        //     id: selectedUser.uid,
        //     name: selectedUser.name,
        //     mobileNo: null,
        //     email: selectedUser.email,
        //     profileImage: null
        //   }
        // })
        // localStorage.setItem('user', JSON.stringify(selectedUser))
        // localStorage.setItem('access_token', selectedUser.token)
        // this.$router.push({ name: 'dashboard.home-1' })
      }
    },
    firebaseLogin () {
      firebase.auth().signInWithEmailAndPassword(this.user.email, this.user.password).then((user) => {
        const firebaseUser = firebase.auth().currentUser.providerData[0]
        this.$store.dispatch('Setting/authUserAction', {
          auth: true,
          authType: 'firebase',
          user: {
            id: firebaseUser.uid,
            name: firebaseUser.displayName,
            mobileNo: firebaseUser.phoneNumber,
            email: firebaseUser.email,
            profileImage: firebaseUser.photoURL
          }
        })
        localStorage.setItem('user', JSON.stringify(firebaseUser))
        this.$router.push({ name: 'dashboard.home-1' })
      }).catch((err) => {
        if (err.code === 'auth/user-not-found') {
          core.showSnackbar('error', 'These credentials do not match our records.')
        } else {
          core.showSnackbar('error', err.message)
        }
      })
    }
  }
}
</script>
