<template>
   <div id="loaderstyle1" :style="show ? '' : 'display: none'">
    <div class="modal-backdrop fade show"></div>
    <div class="modal-backdrop-loader">
      <div class="d-flex justify-content-center">
        <button class="btn btn-primary loader-btn" type="button" disabled>
          <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
          Aguarde... {{ text }}
        </button>
      </div>
    </div>
  </div>
</template>
<script>
/* eslint-disable */

export default {
  name: 'LoaderStyle1',
  props: {
    show: { type: Boolean, default: false },
    text: { type: String , default: '' }
  }
}
</script>

<style scoped>

  #loaderstyle1 .modal-backdrop-loader {
    position: fixed;
    top: 0;
    left: 0;
    z-index: 1040;
    width: 100vw;
    height: 100vh;
  }

   #loaderstyle1 .modal-backdrop {
    position: fixed;
    top: 0;
    left: 0;
    z-index: 1040;
    width: 100vw;
    height: 100vh;
    background-color: #000;
  }

   #loaderstyle1 .modal-open .modal {
    overflow-x: hidden;
    overflow-y: auto;
  }

  #loaderstyle1 .fade {
    transition: opacity .15s linear;
  }

  #loaderstyle1 .modal-backdrop.show {
    opacity: .5;
  }

   #loaderstyle1 .loader-btn{
    position: fixed; top: 49%;
    background: #fff !important;
    color: #000 !important;
    border-color: #fff !important;
    border-radius: 22px !important;
    padding: 6px 30px !important;
    opacity: initial !important;
    font-weight: 500 !important;
  }
</style>
