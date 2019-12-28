<template>
  <md-card>
      <md-card-actions>
        <div class="md-subhead">
          <span>Loop Mode / Infinite Loop</span>
          <span>（</span>
          <span>无限循环模式</span>
          <span>）</span>
        </div>
        <md-button class="md-icon-button"
                   target="_blank"
                   href="https://github.com/surmon-china/vue-awesome-swiper/blob/master/examples/20-infinite-loop.vue">
          <md-icon>code</md-icon>
        </md-button>
      </md-card-actions>
      <md-card-media>
    <swiper :options="swiperOption" ref="mySwiper">
      <swiper-slide v-for="(carousel, index) in carousels" v-bind:key="index">
        <section class="hero is-medium is-primary is-bold">
          <div class="hero-body">
            <div class="container">
              <h1 class="title" v-text="carousel.name"></h1>
              <h2 class="subtitle">
                subtitle on advert
              </h2>
              <p v-text="carousels.sypnosis"></p>
            </div>
          </div>
        </section>
            <div class="swiper-pagination" slot="pagination"></div>
            <div class="swiper-button-prev" slot="button-prev"></div>
            <div class="swiper-button-next" slot="button-next"></div>
    </swiper>
  </md-card-media>
</md-card>
</template>

<script>

import 'swiper/dist/css/swiper.css'
import { swiper, swiperSlide } from 'vue-awesome-swiper'

  export default {
    name: 'carrousel',
      components: {
          swiper,
          swiperSlide
      },

      data () {
          return {
            carousels: '',
            swiperOption: {
                slidesPerView: 1,
                spaceBetween: 30,
                loop: true,
                pagination: {
                  el: '.swiper-pagination',
                  clickable: true
                },
                navigation: {
                  nextEl: '.swiper-button-next',
                  prevEl: '.swiper-button-prev'
                }
            },
          }
      },

      mounted () {
          axios.get('api/advertisements')
              .then(response => this.carousels = response.data);

        console.log('this is current swiper instance object', this.swiper)
        this.swiper.slideTo(3, 1000, false) 
      },

      computed: {
      swiper() {
        return this.$refs.mySwiper.swiper
      },


    },
  }
</script>





<script>

  export default {
      data() {
          return {
              carousels: '',
          }
      },

      mounted () {
          axios.get('api/advertisements')
              .then(response => this.carousels = response.data);
      },
  }
</script>