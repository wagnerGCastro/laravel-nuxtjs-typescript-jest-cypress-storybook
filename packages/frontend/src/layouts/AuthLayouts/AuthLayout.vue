<template>
  <div>
    <Loader />
    <LoaderStyle1 :show="isLoading.status" :text="isLoading.message" />
    <section class="sign-in-page">
      <b-container class="bg-white mt-5 p-0">
        <!-- Loader Principal -->
        <div class="row no-gutters">
          <div class="col-sm-6 align-self-center">
            <div class="sign-in-from">
              <router-view></router-view>
            </div>
          </div>
          <div class="col-sm-6 text-center">
            <div class="sign-in-detail text-white" :style="'background: url('+bgImageURL+') no-repeat 0 0; background-size: cover;'">
              <a class="sign-in-logo mb-5" href="#"><img :src="logo" class="img-fluid" alt="logo"></a>
              <Swiper :options="options">
                <SwiperSlide class="item">
                  <img :src="require('../../assets/images/login/login-1.png')" class="img-fluid mb-4" alt="logo">
                  <h4 class="mb-1 text-white">Manage your orders 3</h4>
                  <p>It is a long established fact that a reader will be distracted by the readable content.</p>
                </SwiperSlide>
                <SwiperSlide class="item">
                  <img :src="require('../../assets/images/login/login-1.png')" class="img-fluid mb-4" alt="logo">
                  <h4 class="mb-1 text-white">Manage your orders</h4>
                  <p>It is a long established fact that a reader will be distracted by the readable content.</p>
                </SwiperSlide>
                <SwiperSlide class="item">
                  <img :src="require('../../assets/images/login/login-1.png')" class="img-fluid mb-4" alt="logo">
                  <h4 class="mb-1 text-white">Manage your orders</h4>
                  <p>It is a long established fact that a reader will be distracted by the readable content.</p>
                </SwiperSlide>
              </Swiper>
            </div>
          </div>
        </div>
      </b-container>
    </section>
  </div>
</template>
<script>
import { mapGetters } from 'vuex'
import Loader from '@/components/core/loader/Loader'
import LoaderStyle1 from '@/components/core/loader/LoaderStyle1'
import logo from '@/assets/images/logo-white.png'
import { core } from '@/config/pluginInit'
import bgImage from '@/assets/images/login/login-2.jpg'
import Swiper from '@/components/core/slider/Swiper'
import SwiperSlide from '@/components/core/slider/SwiperSlide'

export default {
  name: 'AuthLayout',
  components: {
    Loader,
    Swiper,
    SwiperSlide,
    LoaderStyle1
  },
  mounted () {
    core.index()
  },
  data () {
    return {
      options: {
        slidesPerView: 1,
        loop: true
      },
      logo: logo,
      bgImageURL: bgImage
    }
  },
  computed: {
    ...mapGetters({
      isLoading: 'auth/loadingState'
    })
  }
}
</script>
<style>
  @import url("../../assets/css/custom.css");
</style>
